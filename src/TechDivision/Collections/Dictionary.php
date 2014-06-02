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
require_once "TechDivision/Lang/Exceptions/NullPointerException.php";
require_once "TechDivision/Lang/Exceptions/ClassCastException.php";
require_once "TechDivision/Collections/Interfaces/Set.php";
require_once "TechDivision/Collections/Exceptions/InvalidKeyException.php";
require_once
	"TechDivision/Collections/Exceptions/IndexOutOfBoundsException.php";

/**
 * This class is the implementation of a Dictionary. A
 * dictionary uses objects as keys instead of integers
 * like a HashMap.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_Dictionary
    extends TechDivision_Lang_Object
    implements TechDivision_Collections_Interfaces_Set {

	/**
	 * Holds the keys with the objects.
	 * @var array
	 */
	protected $_keys = array();

	/**
	 * Holds the items of the Dictionary
	 * @var array
	 */
    protected $_items = array();

    /**
	 * Holds the internal counter for the keys.
	 * @var integer
	 */
    protected $_key = 0;

	/**
	 * Standardconstructor that adds the values of the array passed
	 * as parameter to the internal membervariable.
	 *
	 * @param array $items An array to initialize the Dictionary
	 * @throws TechDivision_Lang_Exceptions_ClassCastException
	 * 		Is thrown if nor NULL or an object that is not a
	 * 		Dictionary is passed
	 * @see TechDivision_Collections_Dictionary::add($key, $value)
	 */
	public function __construct($items = null)
	{
		// check if NULL is passed, is yes, to nothing
		if (is_null($items)) {
			return;
		}
		// check if an array is passed
		if (is_array($items)) {
			// initialize the Dictionary with the values of the passed array
			foreach($items as $key => $item) {
				$this->add($key, $item);
			}
			return;
		}
		// if not a array is passed throw an exception
		throw new TechDivision_Lang_Exceptions_ClassCastException(
			'Passed object is not an array'
		);
	}

    /**
     * This method adds the passed value with the passed key
     * to the Dictionary.
     *
     * @param object $key Holds the key as object to add the value under
     * @param mixed $value Holds the value to add
     * @return TechDivision_Collections_Dictionary The instance
     * @throws TechDivision_Collections_Exceptions_InvalidKeyException
     * 		Is thrown if the passed key is NOT an object
     * @throws TechDivision_Lang_Exceptions_NullPointerException
     * 		Is thrown if the passed key OR value are NULL
     */
    public function add($key, $value)
    {
		if (is_null($key)) {
			throw new TechDivision_Lang_Exceptions_NullPointerException(
				'Passed key is null'
			);
		}
		if (is_null($value)) {
			throw new TechDivision_Lang_Exceptions_NullPointerException(
				'Passed value with key ' . $key . ' is null'
			);
		}
		if (!is_object($key)) {
			throw new TechDivision_Collections_Exceptions_InvalidKeyException(
				'Passed key has to be an object'
			);
		}
		// get the next id
		$id = $this->_key++;
		// add the key to the array with the keys
		$this->_keys[$id] = $key;
		// and add the value with the IDENTICAL id to internal
		// array with the values
        $this->_items[$id] = $value;
        // return the instance
        return $this;
    }

    /**
     * This method returns the element with the passed key
     * from the Dictionary.
     *
     * @param object $key Holds the key of the element to return
     * @throws TechDivision_Lang_Exceptions_InvalidKeyException
     * 		Is thrown if the passed key is NOT an object
     * @throws TechDivision_Lang_Exceptions_NullPointerException
     * 		Is thrown if the passed key OR value are NULL
     * @throws TechDivision_Collections_Exceptions_IndexOutOfBoundsException
     * 		Is thrown if no element with the passed key exists in the Dictionary
     * @see TechDivision_Collections_Interfaces_IndexedCollection::get($key)
     */
    public function get($key)
    {
		if (is_null($key)) {
			throw new TechDivision_Lang_Exceptions_NullPointerException(
				'Passed key is null'
			);
		}
		if (!is_object($key)) {
			throw new TechDivision_Collections_Exceptions_InvalidKeyException(
				'Passed key has to be an object'
			);
		}
		// run over all keys and check if one is equal to the passed one
		foreach ($this->_keys as $id => $value) {
			// if the actual is equal to the passed key ..
			if ($key == $value) {
				// return the item with the passed key
				if (array_key_exists($id, $this->_items)) {
					return $this->_items[$id];
				}
			}
		}
		// if no value is found throw an exception
		throw new TechDivision_Lang_Exceptions_IndexOutOfBoundsException(
			'Index out of bounds'
		);
    }

    /**
     * @see TechDivision_Collections_Interfaces_Collection::clear()
     */
    public function clear()
    {
		// intialize the internal arrays and keys
		$this->_keys = array();
		$this->_items = array();
		$this->_key = 0;
    }

    /**
     * @see TechDivision_Collections_InterfacesCollection::size()
     */
    public function size()
    {
        return sizeof($this->_keys); // return the size of the keys array
    }

	/**
	 * This method checks if the element with the passed
	 * key exists in the Dictionary.
	 *
	 * @param object $key
	 * 		Holds the key to check the elements of the Dictionary for
	 * @return boolean
	 * 		Returns true if an element with the passed key
	 * 		exists in the Dictionary
	 * @throws TechDivision_Collections_Exceptions_InvalidKeyException
	 * 		Is thrown if the passed key is NOT an object
	 * @throws TechDivision_Lang_Exceptions_NullPointerException
	 * 		Is thrown if the passed key is NULL
	 * @see TechDivision_Collections_Interfaces_IndexedCollection::exists($key)
	 */
	public function exists($key)
	{
		if (is_null($key)) {
			throw new TechDivision_Lang_Exceptions_NullPointerException(
				'Passed key is null'
			);
		}
		if (!is_object($key)) {
			throw new TechDivision_Collections_Exceptions_InvalidKeyException(
				'Passed key has to be an object'
			);
		}
		// run over all keys and check if one is equal to the passed one
		foreach ($this->_keys as $id => $value) {
			// if the actual is equal to the passed key ..
			if ($key == $value) {
				// return TRUE if the key is found
				return true;
			}
		}
		// return FALSE if the key is not found
		return false;
	}

    /**
     * @see TechDivision_Collections_Interfaces_Collection::isEmpty()
     */
    public function isEmpty()
    {
		// if no items are set return true
		if ($this->_key == 0) {
			return true;
		}
		return false;
    }

    /**
     * @see TechDivision_Collections_Interfaces_Collection::toArray()
     */
    public function toArray()
    {
		return $this->_items;
    }

    /**
     * This method returns the keys as
     * an array.
     *
     * @return array Holds an array with the keys
     */
    public function keysToArray()
    {
		return $this->_keys;
    }

    /**
     * This method removes the element with the passed
     * key, that has to be an object, from the Dictionary.
     *
     * @param object $key Holds the key of the element to remove
     * @return void
     * @throws TechDivision_Collections_Exceptions_InvalidKeyException
     * 		Is thrown if the passed key is NOT an object
     * @throws TechDivision_Lang_Exceptions_NullPointerException
     * 		Is thrown if the passed key is NULL
     * @throws TechDivision_Collections_Exceptions_IndexOutOfBoundsException
     * 		Is thrown if no element with the passed key exists in the Dictionary
     */
    public function remove($key)
    {
		if (is_null($key)) {
			throw new TechDivision_Lang_Exceptions_NullPointerException(
				'Passed key is null'
			);
		}
		if (!is_object($key)) {
			throw new TechDivision_Collections_Exceptions_InvalidKeyException(
				'Passed key has to be an object'
			);
		}
		// run over all keys and check if one is equal to the passed one
		foreach ($this->_keys as $id => $value) {
			// if the actual is equal to the passed key ..
			if ($key == $value) {
				// unset the elements
				unset($this->_items[$id]);
                unset($this->_keys[$id]);
				return;
			}
		}
		// throw an exception if key is not found in internal array
        throw new TechDivision_Collections_Exceptions_IndexOutOfBoundsException(
        	'Index out of bounds'
        );
    }

	/**
	 * This method appends all elements of the
	 * passed array to the Dictionary.
	 *
	 * @param array $array Holds the array with the values to add
	 * @return void
	 */
	public function addAll($array)
	{
		foreach ($array as $key => $value) {
			$this->add($key, $value);
		}
	}
}