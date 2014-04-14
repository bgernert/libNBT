<?php
/**
 * Tag_List.php
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

namespace bgernert\libNBT;

class Tag_List implements Tag {
 
    /**
     * Stores the name of the tag
     * 
     * @var string
     */
    private $name = '';
    
    /**
     * Stores the value of the tag
     * 
     * @var array
     */
    private $value = array();
    
    private $tagID = -1;
    
    public function __construct($tagID) {
        //TODO: Check for TagID range 1..12
        $this->tagID = $tagID;
    }
    
    public function setName(&$name) {
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setValue(&$value) {
        //TODO: Check for array and tagID
        $this->value = $value;
    }
    
    public function addValue($item) {
        //TODO: Check for tagID
        array_push($this->value, $item);
    }

    public function getValue() {
        return $this->value;
    }
    
    public function getLength() {
        return count($this->value, 0);
    }

    public function __toString() {
        return "TAG_List(\"{$this->name}\") {$this->value}\n";
    }
}
