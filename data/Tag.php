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

namespace bgernert\libNBT\data;

interface Tag
{
    /**
     * Stores the name of the NBT
     * 
     * @param string $name The name of the NBT
     * 
     * @return void
     */
    public function setName(&$name);

    /**
     * Returns the name of the NBT
     * 
     * @return string Name of the NBT
     */
    public function getName();

    /**
     * Sets the value of the NBT
     * 
     * @param mixed $value The value for the NBT
     */
    public function setValue(&$value);

    /**
     * Returns the value of the NBT
     * 
     * @return mixed The value of the NBT
     */
    public function getValue();
    
    /**
     * Returns the length of the value
     * 
     * @return int Length of the value
     */
    public function getLength();

    /**
     * Overwrite the toString method
     * 
     * @return string Returns a string representation of the class
     *                (e.g. TAG_STRING("name"): Hello World!)
     */
    public function __toString();
}