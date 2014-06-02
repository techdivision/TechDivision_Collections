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

require_once "TechDivision/Collections/Dictionary.php";
require_once
	"TechDivision/Collections/Exceptions/IndexOutOfBoundsException.php";
require_once "TechDivision/Collections/Exceptions/InvalidKeyException.php";
require_once "TechDivision/Lang/exceptions/NullPointerException.php";
require_once "TechDivision/Lang/exceptions/ClassCastException.php";

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
class TechDivision_Collections_IdentityDictionary
    extends TechDivision_Collections_Interfaces_Dictionary {

    /**
     * This method returns the element that has the passed
     * key as a reference (has to be an object) from the
     * Dictionary.
     *
     * @param object $key Holds the key to the key of the element to return
     * @throws TechDivision_Collections_Exceptions_InvalidKeyException
     * 		Is thrown if the passed key is NOT an object
     * @throws TechDivision_Lang_Exceptions_NullPointerException
     * 		Is thrown if the passed key OR value are NULL
     * @throws TechDivision_Collections_Exceptions_IndexOutOfBoundsException
     * 		Is thrown if no element with the passed key exists in the Dictionary
     * @see TechDivision_Collections_Interfaces_IndexedCollection::get($key)
     */
    public function get($key)
    {
		if (is_null($key))
		{
			throw new TechDivision_Lang_Exceptions_NullPointerException(
				'Passed key is null'
			);
		}
		if (!is_object($key))
		{
			throw new TechDivision_Collections_Exceptions_InvalidKeyException(
				'Passed key has to be an object'
			);
		}
		// run over all keys and check if one is equal to the passed one
		foreach ($this->keys as $id => $value) {
			// if the actual is equal to the passed key ..
			if ($key === $value) {
				// return the item with the passed key
				if (array_key_exists($id, $this->items)) {
					return $this->items[$id];
				}
			}
		}
		// if no value is found throw an exception
		throw new TechDivision_Collections_Exceptions_IndexOutOfBoundsException(
			'Index out of bounds'
		);
    }

	/**
     * This method checks if the element that has the passed
     * key as a reference (has to be an object) exists in
     * the Dictionary.
	 *
	 * @param object $key
	 * 		Holds the reference to the key of the element that should
	 * 		exists in the Dictionary
	 * @return boolean
	 * 		Returns TRUE if an element with the passed key
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
		foreach ($this->keys as $id => $value) {
			// if the actual is equal to the passed key ..
			if ($key === $value) {
				// return TRUE if the key is found
				return true;
			}
		}
		// return FALSE if the key is not found
		return false;
	}

    /**
     * This method removes the element that has the passed
     * key as a reference (has to be an object) from the
     * Dictionary.
     *
     * @param object $key
     * 		Holds the reference of the key of the element to remove
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
		// run over all keys and check if one is a reference of the passed one
		foreach ($this->keys as $id => $value) {
			// if the actual is equal to the passed key ..
			if ($key === $value) {
				// unset the elements
				unset($this->items[$id]);
                unset($this->keys[$id]);
				return;
			}
		}
		// throw an exception if key is not found in internal array
        throw new TechDivision_Collections_Exceptions_IndexOutOfBoundsException(
        	'Index out of bounds'
        );
    }
}