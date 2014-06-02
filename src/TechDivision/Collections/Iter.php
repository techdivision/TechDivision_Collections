<?php

/**
 * License: GNU General Public License
 *
 * Copyright (c) 2009 TechDivision GmbH.  All rights reserved.
 * Note: Original work copyright to respective authors
 *
 * This file is part of TechDivision GmbH - Connect.
 *
 * TechDivision_Collections is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * TechDivision_Collections is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,
 * USA.
 *
 * @package TechDivision_Collections
 */

require_once "TechDivision/Lang/Object.php";

/**
 * This class is the default implementation of a Iterator
 * used for foreach constructs.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_Iter
    extends TechDivision_Lang_Object
    implements Iterator {

    /**
	 * Holds the internal array
	 * @var array
	 */
    private $arr = array();

   /**
    * Constructor that initializes the internal member
    * with the array passed as parameter.
    *
    * @param array $array Holds the array
    * @return void
    */
    public function __construct($array)
    {
        if (is_array($array)) {
            $this->arr = $array;
        }
    }

    /**
     * Resets the internal array pointer to
     * the first entry. And retures the
     * value therefore.
     *
     * @return mixed Holds the first value of the internal array
     */
    public function rewind()
    {
        return reset($this->arr);
    }

    /**
     * Returns the actual entry.
     *
     * @return mixed The actual entry of the internal array
     */
    public function current()
    {
        return current($this->arr);
    }

    /**
     * Returns the key of the actual entry.
     *
     * @return mixed The key of actual entry of the internal array
     */
    public function key()
    {
        return key($this->arr);
    }

    /**
     * Returns the next entry.
     *
     * @return mixed The next entry of the internal array
     */
    public function next()
    {
        return next($this->arr);
    }

    /**
     * Checks if the actual entry of the internal
     * array is not false.
     *
     * @return boolean
     * 		TRUE if there is a actual entry in the internal array, else FALSE
     */
    public function valid()
    {
        return $this->current() !== false;
    }

	/**
	 * This method sets the internal array pointer
	 * to the end of the array and returns the
	 * value therefore.
	 *
	 * @return mixed Holds the last value of the internal array
	 */
	public function last()
	{
		return end($this->arr);
	}
}