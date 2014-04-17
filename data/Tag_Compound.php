<?php
/**
 * Tag_Compound.php
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

namespace bgernert\libNBT\data;

class Tag_Compound implements Tag {
 
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
    
    public function setName(&$name) {
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setValue(&$value) {
        //TODO: Check for array
        //TODO: Check for unique tag names
        $this->value = $value;
    }
    
    public function addValue($item) {
        //TODO: Check for tagID
        //TODO: Check for unique tag name
        array_push($this->value, $item);
    }

    public function getValue() {
        return $this->value;
    }
    
    public function getLength() {
        return count($this->value, 1);
    }

    public function __toString() {
        return "TAG_Compound(\"{$this->name}\") {$this->value}\n";
    }
}
