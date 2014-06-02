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
require_once "TechDivision/Collections/Interfaces/Map.php";
require_once "TechDivision/Collections/AbstractMap.php";
require_once "TechDivision/Collections/Exceptions/InvalidKeyException.php";

/**
 * This class is the implementation of a HashMap.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_HashMap
    extends TechDivision_Collections_AbstractMap {

	/**
	 * Standardconstructor that adds the array passed
	 * as parameter to the internal membervariable.
	 *
	 * @param array $items An array to initialize the HashMap
	 * @throws TechDivision_Lang_Exceptions_ClassCastException
	 * 		Is thrown if the passed parameter is not of type array
	 */
	public function __construct($items = array())
	{
		// check if NULL is passed, is yes, to nothing
		if (is_null($items)) {
			return;
		}
		// check if an array is passed
		if (is_array($items)) {
			// initialize the HashMap with the values of the passed array
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
     * This method adds the passed object with the passed key
     * to the HashMap.
     *
     * @param mixed $key The key to add the passed value under
     * @param mixed $object The object to add to the HashMap
     * @return TechDivision_Collections_HashMap The instance
     * @throws TechDivision_Collections_Exceptions_InvalidKeyException
     * 		Is thrown if the passed key is NOT an primitve datatype
     * @throws TechDivision_Lang_Exceptions_NullPointerException
     * 		Is thrown if the passed key is null or not a flat datatype like
     * 		Integer, String, Double or Boolean
     */
    public function add($key, $object)
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
			// add the item to the array
            $this->_items[$key] = $object;
            // and return
            return;
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
			// add the item to the array
            $this->_items[$newKey] = $object;
            // and return
            return;
		}
		throw new TechDivision_Collections_Exceptions_InvalidKeyException(
    		'Passed key has to be a primitve datatype or ' .
    	    'has to implement the __toString() method'
		);
    }

	/**
     * This method Returns a new HashMap initialized with the
     * passed array.
     *
     * @param array $array Holds the array to initialize the new HashMap
     * @return TechDivision_Collections_HashMap
     * 		Returns a HashMap initialized with the passed array
     * @throws TechDivision_Lang_Exceptions_ClassCastException
     * 		Is thrown if the passed object is not an array
     */
    public static function fromArray($array)
    {
		// check if the passed object is an array and set it
        if (is_array($array)) {
			return new TechDivision_Collections_HashMap($array);
        }
		// throw an exception if the passed object is not an array
		throw TechDivision_Lang_Exceptions_ClassCastException(
			'Passed object is not an array'
		);
    }
}