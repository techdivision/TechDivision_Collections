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

/**
 * Interface of all Collection objects.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
interface TechDivision_Collections_Interfaces_Collection
{

    /**
     * This method returns the number of entries of the Collection.
     *
     * @return integer The number of entries
     */
    public function size();

    /**
     * This method initializes the Collection and removes
     * all exsiting entries.
     *
     * @return void
     */
    public function clear();

    /**
     * This returns true if the Collection has no
     * entries, otherwise false.
     *
     * @return boolean
     */
    public function isEmpty();

	/**
     * This method returns an array with the
     * items of the Dictionary. The keys are
     * lost in the array.
     *
     * @return array Holds an array with the items of the Dictionary
     */
    public function toArray();

	/**
	 * This method appends all elements of the
	 * passed array to the Collection.
	 *
	 * @param array $array Holds the array with the values to add
	 * @return TechDivision_Collections_Interfaces_Collection The instance
	 */
	public function addAll($array);

	/**
	 * This method returns the object, identified by the key
	 * passed as a parameter, from the Collection.
	 *
	 * @param mixed $key The key of the element to return
	 * @return mixed Holds the entry identified by the passed key
	 * @throws TechDivision_Collections_InvalidKeyException Is thrown if the passed key is invalid
	 * @throws TechDivision_Collections_NullPointerException Is thrown if the passed key is NULL
	 * @throws TechDivision_Collections_IndexOutOfBoundsException If element with passed key is not in the collection
	 */
	public function get($key);

	/**
	 * This method checks if the element with the passed
	 * key exists in the Collection.
	 *
	 * @param mixed $key Holds the key to check the elements of the Collection for
	 * @return boolean Returns true if an element with the passed key exists in the Collection
	 * @throws TechDivision_Collections_InvalidKeyException Is thrown if the passed key is invalid
	 * @throws TechDivision_Collections_NullPointerException Is thrown if the passed key is NULL
	 */
	public function exists($key);
}