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

require_once "TechDivision/Collections/AbstractCollection.php";
require_once "TechDivision/Lang/Exceptions/NullPointerException.php";
require_once "TechDivision/Lang/Exceptions/ClassCastException.php";

/**
 * This class is the implementation of a ArrayList.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_ArrayList
    extends TechDivision_Collections_AbstractCollection {

    /**
	 * Holds the internal counter for the keys of the ArrayList
	 * @var integer
	 */
    private $_count = 0;

	/**
	 * Standardconstructor that adds the array passed
	 * as parameter to the internal membervariable.
	 *
	 * @param array $items An array to initialize the ArrayList
	 */
	public function __construct($items = null)
	{
		// check if NULL is passed, is yes, to nothing
		if (is_null($items)) {
			return;
		}
		// check if an array is passed
		if (is_array($items)) {
			// initialize the ArrayList with the values of the passed array
			foreach ($items as $key => $item) {
				$this->add($item);
			}
			return;
		}
		// if not a array is passed throw an exception
		throw new TechDivision_Lang_Exceptions_ClassCastException(
			'Passed object is not an array'
		);
	}

    /**
     * This method adds the passed object with the passed key
     * to the ArrayList.
     *
     * @param $object The object that should be added to the ArrayList
     * @return TechDivision_Collection_ArrayList The instance
     * @throws TechDivision_Lang_Exceptions_NullPointerException
     * 		Is thrown it the passed object is NULL
     */
    public function add($object)
    {
		if (is_null($object)) {
			throw new TechDivision_Lang_Exceptions_NullPointerException(
				'Passed object is null'
			);
		}
		// set the item in the array
        $this->_items[$this->_count++] = $object;
		// return the instance
		return $this;
    }

	/**
     * This method Returns a new ArrayList initialized with the
     * passed array.
     *
     * @param array $array Holds the array to initialize the new ArrayList
     * @return TechDivision_Collections_ArrayList
     * 		Returns an ArrayList initialized with the passed array
     * @throws TechDivision_Lang_Exceptions_ClassCastException
     * 		Is thrown if the passed object is not an array
     */
    public static function fromArray($array)
    {
		// check if the passed object is an array and set it
        if (is_array($array)) {
			return new TechDivision_Collections_ArrayList($array);
        }
		// throw an exception if the passed object is not an array
		throw new TechDivision_Lang_Exceptions_ClassCastException(
			'Passed object is not an array'
		);
    }

	/**
	 * This method returns a new ArrayList with the
	 * items from the passed offset with the passed
	 * length.
	 *
	 * If no length is passed, the section up from
	 * the offset until the end of the items is
	 * returned.
	 *
	 * @param integer $offset The start of the section
	 * @param integer $length The length of the section to return
	 * @return TechDivision_Collections_ArrayList
	 * 		Holds the ArrayList with the requested elements
	 */
	public function slice($offset, $length = null)
	{
		// initialize the items
		$items = array();
		// if lenght is not define return all items from the offset up
		// till the end of the items, else return all items from the offset
		// with the defined length
		if ($length == null) {
			$items = array_slice($this->_items, $offset);
		} else {
			$items = array_slice($this->_items, $offset, $length);
		}
		// return a new ArraList with the requested items
		return new TechDivision_Collections_ArrayList($items);
	}
}