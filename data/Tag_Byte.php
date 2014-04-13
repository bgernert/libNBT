<?php
/**
 * Tag_Byte.php
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

class Tag_Byte implements Tag {
 
    /**
     * Stores the name of the tag
     * 
     * @var string
     */
    private $name = '';
    
    /**
     * Stores the value of the tag
     * 
     * @var mixed
     */
    private $value = '';
    
    public function setName(&$name) {
        //TODO: Check for byte
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setValue(&$value) {
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

    public function __toString() {
        return "TAG_Byte(\"{$this->name}\") {$this->value}\n";
    }
}
