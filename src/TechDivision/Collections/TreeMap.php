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

require_once "TechDivision/Lang/String.php";
require_once "TechDivision/Lang/Integer.php";
require_once "TechDivision/Lang/Float.php";
require_once "TechDivision/Lang/Boolean.php";
require_once "TechDivision/Lang/Exceptions/NullPointerException.php";
require_once "TechDivision/Lang/Exceptions/ClassCastException.php";
require_once "TechDivision/Collections/Interfaces/SortedMap.php";
require_once "TechDivision/Collections/AbstractMap.php";
require_once "TechDivision/Collections/Exceptions/InvalidKeyException.php";

/**
 * This class is the implementation of a sorted
 * HashMap.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_TreeMap
    extends TechDivision_Collections_AbstractMap
    implements TechDivision_Collections_Interfaces_SortedMap
{

	/**
	 * Holds the comparator to sort the internal array.
	 * @var TechDivision_Collections_Interfaces_Comparator
	 */
	private $_comparator = null;

	/**
	 * Standardconstructor that adds the array passed
	 * as parameter to the internal membervariable.
	 *
	 * Be careful when using a comparator, because sorting
	 * a large map can take much processor time and memory.
	 *
	 * @param TechDivision_Collections_Interfaces_Comparator $comparator
	 * 		Holds the comparator to use
	 * @param array $items An array to initialize the TreeMap
	 * @return void
	 * @throws TechDivision_Collections_Exceptions_ClassCastException
	 * 		Is thrown if the parameter items is not of type array
	 */
	public function __construct(
	    TechDivision_Collections_Interfaces_Comparator $comparator = null, 
	    $items = array()) {
		// set the comparator
		$this->_comparator = $comparator;
		// check if NULL is passed, is yes, to nothing
		if (is_null($items)) {
			return;
		}
		// check if an array is passed
		if (is_array($items)) {
			// initialize the TreeMap with the values of the passed array
			foreach ($items as $key => $item) {
				$this->add($key, $item);
			}
			return;
		}
		// if not a array is passed throw an exception
		throw new TechDivision_Collections_Exceptions_ClassCastException(
			'Passed object is not an array'
		);
	}

    /**
     * This method adds the passed object with the passed key
     * to the TreeMap.
     *
     * @param mixed $key The key to add the passed value under
     * @param mixed $object The object to add to the TreeMap
     * @return TechDivision_Collections_TreeMap
     * @throws TechDivision_Collections_Exceptions_InvalidKeyException
     * 		Is thrown if the passed key is NOT an primitve datatype
     * @throws TechDivision_Collections_Exceptions_NullPointerException
     * 		Is thrown if the passed key is null or not a flat datatype like
     * 		Integer, String, Double or Boolean
     */
    public function add($key, $object)
    {
		if (is_null($key)) {
			throw new TechDivision_Collections_Exceptions_NullPointerException(
				'Passed key is null'
			);
		}
		// check if a primitive datatype is passed
		if (is_integer($key) ||
		    is_string($key) ||
		    is_double($key) ||
		    is_bool($key)) {
    		// add the passed object to the internal array
            $this->_items[$key] = $object;
            // sort the instance
            $this->_sort();
            // return the instance
            return $this;
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
    		// add the passed object to the internal array
            $this->_items[$newKey] = $object;
            // sort the instance
            $this->_sort();
            // return the instance
            return $this;
		}       
		throw new TechDivision_Collections_Exceptions_InvalidKeyException(
    		'Passed key has to be a primitve datatype or ' .
    	    'has to implement the __toString() method'
		);
    }
    
    /**
     * Sorts the instance with the given comparator
     * or the PHP ksort() funktion.
     * 
     * @return boolean Returns TRUE if the instance was sorted successfully
     */
    protected function _sort() 
    {
		// if no comparator is passed sort the internal array 
		// by its keys, else use the comparator
		if ($this->_comparator == null) {
			return ksort($this->_items);
		} else {
			return TechDivision_Collections_CollectionUtils::sort(
			    $this,
			    $this->_comparator
		    );
		}        
    }

	/**
     * This method Returns a new TreeMap initialized with the
     * passed array.
     *
     * @param array $array Holds the array to initialize the new TreeMap
     * @return TechDivision_Collections_TreeMap
     * 		Returns a TreeMap initialized with the passed array
     * @throws TechDivision_Collections_Exceptions_ClassCastException
     * 		Is thrown if the passed object is not an array
     */
    public static function fromArray($array)
    {
		// check if the passed object is an array and set it
        if (is_array($array)) {
			return new TechDivision_Collections_TreeMap(
			    $this->_comparator,
			    $array
			);
        }
		// throw an exception if the passed object is not an array
		throw TechDivision_Collections_Exceptions_ClassCastException(
			'Passed object is not an array'
		);
    }

	/**
	 * @see TechDivision_Collections_Interfaces_SortedMap::comparator()
	 */
    public function comparator()
    {
    	return $this->_comparator;
    }
}