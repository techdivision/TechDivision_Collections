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
require_once "TechDivision/Lang/String.php";
require_once "TechDivision/Lang/Float.php";
require_once "TechDivision/Lang/Integer.php";
require_once "TechDivision/Lang/Boolean.php";
require_once "TechDivision/Collections/Interfaces/Collection.php";
require_once "TechDivision/Collections/Iter.php";
require_once
	"TechDivision/Collections/Exceptions/IndexOutOfBoundsException.php";

/**
 * Abstract base class of the IndexedCollections.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
abstract class TechDivision_Collections_AbstractCollection
    extends TechDivision_Lang_Object
    implements TechDivision_Collections_Interfaces_Collection, IteratorAggregate {

	/**
	 * Holds the items of the ArrayList
	 * @var array
	 */
    protected $_items = array();

    /**
     * This method returns a new Iter object
     * needed by a foreach structure.
     *
     * @return Iter Holds the Iter object
     * @see IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new TechDivision_Collections_Iter($this->_items);
    }

    /**
     * @see TechDivision_Collections_Interfaces_Collection::addAll($array)
     */
    public function addAll($array)
    {
		foreach($array as $key => $value) {
			$this->_items[$key] = $value;
		}
		// return the instance
		return $this;
    }

    /**
     * This method returns the element with the passed key
     * from the Collection.
     *
     * @param mixed $key Holds the key of the element to return
     * @throws TechDivision_Collections_Exceptions_InvalidKeyException
     * 		Is thrown if the passed key is NOT an integer
     * @throws TechDivision_Lang_Exceptions_NullPointerException
     * 		Is thrown if the passed key OR value are NULL
     * @throws TechDivision_Collections_Exceptions_IndexOutOfBoundsException
     * 		Is thrown if no element with the passed key exists in the Collection
     * @see TechDivision_Collections_Interfaces_Collection::get($key)
     */
    public function get($key)
    {
		if (is_null($key)) {
			throw new TechDivision_Lang_Exceptions_NullPointerException(
				'Passed key is null'
			);
		}
		// check if a primitive datatype is passed
		if (is_integer($key) ||
		    is_string($key) ||
		    is_double($key) ||
		    is_bool($key)) {
			// return the value for the passed key, if it exists
			if (array_key_exists($key, $this->_items)) {
                return $this->_items[$key];
            } else {
        		throw new TechDivision_Collections_Exceptions_IndexOutOfBoundsException(
        			'Index ' . $key . ' out of bounds'
        		);
            }
		}
		// check if an object is passed
		if (is_object($key)) {
			if ($key instanceof TechDivision_Lang_String) {
				$newKey = $key->stringValue();
			} elseif ($key instanceof TechDivision_Lang_Float) {
				$newKey = $key->floatValue();
			} elseif ($key instanceof TechDivision_Lang_Integer) {
				$newKey = $key->intValue();
			} elseif ($key instanceof TechDivision_Lang_Boolean) {
				$newKey = $key->booleanValue();
			} elseif (method_exists($key, '__toString')) {
		        $newKey = $key->__toString();
		    } else {			    
				throw new TechDivision_Collections_Exceptions_InvalidKeyException(
					'Passed key has to be a primitve datatype or ' .
				    'has to implement the __toString() method'
				);
			}
			// return the value for the passed key, if it exists
			if (array_key_exists($newKey, $this->_items)) {
                return $this->_items[$newKey];
            } else {
        		throw new TechDivision_Collections_Exceptions_IndexOutOfBoundsException(
        			'Index ' . $newKey . ' out of bounds'
        		);
            }
		}
		throw new TechDivision_Collections_Exceptions_InvalidKeyException(
    		'Passed key has to be a primitve datatype or ' .
    	    'has to implement the __toString() method'
		);
    }

	/**
	 * This method checks if an element with the passed
	 * key exists in the Collection. If yes the method
	 * returns TRUE, else FALSE.
	 *
	 * @param mixed $key Holds the key of the element to check for
	 * @return boolean Returns TRUE if the element exists in the Collection
	 * 		else FALSE
	 * @throws TechDivision_Collections_Exceptions_InvalidKeyException
	 * 		Is thrown if the passed key is NOT an integer
	 * @throws TechDivision_Lang_Exceptions_NullPointerException
	 * 		Is thrown if the passed key is NULL
	 * @see TechDivision_Collections_Interfaces_Collection::exists($key)
	 */
	public function exists($key)
	{
		if (is_null($key)) {
			throw new TechDivision_Lang_Exceptions_NullPointerException(
				'Passed key is null'
			);
		}
		// check if a primitive datatype is passed
		if (is_integer($key) ||
		    is_string($key) ||
		    is_double($key) ||
		    is_bool($key)) {
			// return TRUE if a value for the passed key exists, else FALSE
			return array_key_exists($key, $this->_items);
		}
		// check if an object is passed
		if (is_object($key)) {
			if ($key instanceof TechDivision_Lang_String) {
				$newKey = $key->stringValue();
			} elseif ($key instanceof TechDivision_Lang_Float) {
				$newKey = $key->floatValue();
			} elseif ($key instanceof TechDivision_Lang_Integer) {
				$newKey = $key->intValue();
			} elseif ($key instanceof TechDivision_Lang_Boolean) {
				$newKey = $key->booleanValue();
			} elseif (method_exists($key, '__toString')) {
			    $newKey = $key->__toString();
		    } else {			    
				throw new TechDivision_Collections_Exceptions_InvalidKeyException(
					'Passed key has to be a primitve datatype or ' .
				    'has to implement the __toString() method'
				);
			}
			// return TRUE if a value for the passed key exists, else FALSE
			return array_key_exists($newKey, $this->_items);
		}
		throw new TechDivision_Collections_Exceptions_InvalidKeyException(
    		'Passed key has to be a primitve datatype or ' .
    	    'has to implement the __toString() method'
		);
	}

    /**
     * @see TechDivision_Collections_Interfaces_Collection::toArray()
     */
    public function toArray()
    {
        return array_values($this->_items);
    }

    /**
     * @see TechDivision_Collections_Interfaces_Collection::size()
     */
    public function size()
    {
        return sizeof($this->_items);
    }

    /**
     * @see TechDivision_Collections_Interfaces_Collection::clear()
     */
    public function clear()
    {
        $this->_items = array();
    }

    /**
     * @see TechDivision_Collections_Interfaces_Collection::isEmpty()
     */
    public function isEmpty()
    {
        if ($this->size() == 0) {
            return true;
        }
		return false;
    }

    /**
     * This method removes the element with the passed
     * key, that has to be an integer, from the
     * IndexedCollection.
     *
     * @param mixed $key Holds the key of the element to remove
     * @return void
     * @throws TechDivision_Collections_Exceptions_InvalidKeyException
     * 		Is thrown if the passed key is NOT an integer
     * @throws TechDivision_Lang_Exceptions_NullPointerException
     * 		Is thrown if the passed key is NULL
     */
    public function remove($key)
    {
		if (is_null($key)) {
			throw new TechDivision_Lang_Exceptions_NullPointerException(
				'Passed key is null'
			);
		}
		// check if a primitive datatype is passed
		if (is_integer($key) ||
		    is_string($key) ||
		    is_double($key) ||
		    is_bool($key)) {
            if (array_key_exists($key, $this->_items)) {
                // remove the item
                unset($this->_items[$key]);
                // return the instance
				return $this;
            } else {
        		throw new TechDivision_Collections_Exceptions_IndexOutOfBoundsException(
        			'Index ' . $key . ' out of bounds'
        		);
            }
		}
		// check if an object is passed
		if (is_object($key)) {
			if ($key instanceof TechDivision_Lang_String) {
				$newKey = $key->stringValue();
			} elseif ($key instanceof TechDivision_Lang_Float) {
				$newKey = $key->floatValue();
			} elseif ($key instanceof TechDivision_Lang_Integer) {
				$newKey = $key->intValue();
			} elseif ($key instanceof TechDivision_Lang_Boolean) {
				$newKey = $key->booleanValue();
			} elseif (method_exists($key, '__toString')) {
			    $newKey = $key->__toString();
		    } else {			    
				throw new TechDivision_Collections_Exceptions_InvalidKeyException(
					'Passed key has to be a primitve datatype or ' .
				    'has to implement the __toString() method'
				);
			}
            if (array_key_exists($newKey, $this->_items)) {
                // remove the item
                unset($this->_items[$newKey]);
                // returns the instance
				return $this;
            } else {
        		throw new TechDivision_Collections_Exceptions_IndexOutOfBoundsException(
        			'Index '. $newKey . ' out of bounds'
        		);
            }
		}
		throw new TechDivision_Collections_Exceptions_InvalidKeyException(
    		'Passed key has to be a primitve datatype or ' .
    	    'has to implement the __toString() method'
		);
    }

   	/**
     * This method merges the elements of the passed map
     * with the elements of the actual map. If the keys
     * are equal, the existing value is taken, else
     * the new one is appended.
     *
     * @param TechDivision_Collections_Interfaces_Collection $col
     * 		Holds the Collection with the values to merge
     * @deprecated Does not work correctly
     */
	public function merge(TechDivision_Collections_Interfaces_Collection $col)
	{
		// union the items of the two maps
		$this->_items = $this->_items + $col->toArray();
    }

   	/**
     * This method checks if an element with the passed
     * value exists in the ArrayList.
     *
     * @param mixed $value
     * 		Holds the value to check the elements of the array list for
     * @return boolean
     * 		Returns true if an element with the passed value exists
     * 		in the array list
     */
	public function contains($value)
	{
		// initialize the return value
		$isEqual = false;
		// run through all elements an check if the one
		// of the items is equal to the passed one
		foreach($this->_items as $item) {
			if ($item == $value) {
				$isEqual = true;
			}
		}
		// return false if the value is not found
		return $isEqual;
    }
}