<?php
/**
 * TagInterface.php
 *
 * Copyright (C) 2014 Björn Gernert
 *
 * Written-by: Björn Gernert <mail@bjoern-gernert.de>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class NbtReader
{
    const TAG_END = 0;
    const TAG_BYTE = 1;
    const TAG_SHORT = 2;
    const TAG_INT = 3;
    const TAG_LONG = 4;
    const TAG_FLOAT = 5;
    const TAG_DOUBLE = 6;
    const TAG_BYTE_ARRAY = 7;
    const TAG_STRING = 8;
    const TAG_LIST = 9;
    const TAG_COMPOUND = 10;
    const TAG_INT_ARRAY = 11;
    const TAG_SHORT_ARRAY = 12;
    
    private $fileHandle;

    public function loadFile($file, $wrapper = 'compress.zlib://')
    {
        // TODO: Check filename/resource
        $this->fileHandle = fopen("{$wrapper}{$file}", 'r');
        
        return $this->decodeTags();
    }
    
    private function decodeTags()
    {
        $tagTree = array();
        
        while(($nextByte = fread($this->fileHandle, 1)) != "" || !feof($this->fileHandle))
        {
            
            $tagType = unpack('c', $nextByte)[1];

            if($tagType == self::TAG_END)
            {
                break;
            } else {
                $name = $this->readTagName();
                $value = $this->readTagType($tagType);
                array_push($tagTree, array('Name' => $name, 'Wert' => $value));
            }
        }
        
        return $tagTree;
    }
    
    private function readTagType($type = self::TAG_BYTE)
    {
        switch($type)
        {
            case self::TAG_END:
                break;
                
            case self::TAG_BYTE:
                $value = unpack('c', fread($this->fileHandle, 1));
                return $value[1];

            case self::TAG_SHORT:
                $value = unpack('n', fread($this->fileHandle, 2));
                if($value[1] >= pow(2, 15))
                {
                   $value[1] -= pow(2, 16);
                }
                return $value[1];
            
            case self::TAG_INT:
                $value = unpack('N', fread($this->fileHandle, 4));
                if($value[1] >= pow(2, 31))
                {
                    $value[1] -= pow(2, 32);
                }
                return $value[1];
                
            case self::TAG_LONG:
                $value1 = unpack('N', fread($this->fileHandle, 4));
                $value2 = unpack('N', fread($this->fileHandle, 4));
                return $value1 << 32 | $value2;
                
            case self::TAG_FLOAT:
                $value = unpack('f', strrev(fread($this->fileHandle, 4)));
                //TODO: float conversion
                return $value[1];
                
            case self::TAG_DOUBLE:
                $value = unpack('d', strrev(fread($this->fileHandle, 8)));
                //TODO: double conversion
                return $value[1];
                
            case self::TAG_BYTE_ARRAY:
                $length = $this->readTagType(self::TAG_INT);
                $value = array();
                for($i = 0; $i < $length; ++$i)
                {
                    array_push($value, $this->readTagType(self::TAG_BYTE));
                }
                return $value;
                
            case self::TAG_STRING:
                $length = $this->readTagType(self::TAG_SHORT);
                if($length <= 0)
                {
                    return "";
                } else {
                    return utf8_decode(fread($this->fileHandle, $length));
                }
               
            case self::TAG_LIST:
                $tagID = $this->readTagType(self::TAG_BYTE);
                $length = $this->readTagType(self::TAG_INT);
                $value = array();
                for($i = 0; $i < $length; ++$i)
                {
                    array_push($value, $this->readTagType($tagID));
                }
                return $value;
                
            case self::TAG_COMPOUND:
                $value = array();
                return $this->decodeTags();
                
            case self::TAG_INT_ARRAY:
                $length = $this->readTagType(self::TAG_INT);
                $value = array();
                for($i = 0; $i < $length; ++$i)
                {
                    array_push($value, $this->readTagType(self::TAG_INT));
                }
                return $value;
                
            case self::TAG_SHORT_ARRAY:
                $length = $this->readTagType(self::TAG_INT);
                $value = array();
                for($i = 0; $i < $length; ++$i)
                {
                    array_push($value, $this->readTagType(self::TAG_SHORT));
                }
                return $value;
        }
    }
    
    private function readTagName()
    {
        return $this->readTagType(self::TAG_STRING);
    }
}