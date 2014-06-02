<?php

/**
 * License: GNU General Public License
 *
 * Copyright (c) 2009 TechDivision GmbH.  All rights reserved.
 * Note: Original work copyright to respective authors
 *
 * This file is part of TechDivision GmbH - Connect.
 *
 * faett.net is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * faett.net is distributed in the hope that it will be useful,
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

require_once "PHPUnit/Framework.php";
require_once "TechDivision/Collections/HashMap.php";

/**
 * This class implements the test cases
 * of the HashMap.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_HashMapTest extends PHPUnit_Framework_TestCase
{

	/**
	 * This method tests the add and the get method
     * of the HashMap.
	 *
	 * @return void
	 */
	public function testAddAndGetAndIsEmptyAndClear()
	{
        // initialize a new HashMap
        $map = new TechDivision_Collections_HashMap();
        // check that the HashMap is empty
        $this->assertTrue($map->isEmpty());
        // add a new element
        $map->add(10, "Test");
        // get the element
        $this->assertEquals("Test", $map->get(10));
        // check that the HashMap is not empty
        $this->assertFalse($map->isEmpty());
        // remove all elements
        $map->clear();
        // check that the HashMap is empty
        $this->assertTrue($map->isEmpty());
    }

	/**
	 * This method tests the get method of the HashMap.
	 *
	 * @return void
	 */
	public function testAddAndGetWithNull()
	{
        try {
            // initialize a new HashMap
            $map = new TechDivision_Collections_HashMap();
			$this->assertNull($map->get(0));
			$this->fail("Insert out of bounds exception expected");
        } catch (Exception $e) {
        	$this->assertEquals("Index 0 out of bounds", $e->getMessage());
        }
    }

	/**
	 * This method tests the add, remove and
     * size method of the HashMap.
	 *
	 * @return void
	 */
	public function testAddAndRemoveAndSize()
	{
        // initialize a new HashMap
        $map = new TechDivision_Collections_HashMap();
        $this->assertEquals(0, $map->size());
        $map->add(0, "Element 1");
        $map->add(2, "Element 2");
        $map->add(5, "Element 3");
        $this->assertEquals(3, $map->size());
        $map->remove(2);
        $this->assertEquals(2, $map->size());
    }

	/**
	 * This method tests that a exception is thrown if the
     * object with the key, passed to the remove method as
     * a parameter, does not exist in the HashMap.
	 *
	 * @return void
	 */
	public function testDeleteWithException()
	{
        // initialize a new HashMap
        $map = new TechDivision_Collections_HashMap();
        // try to remove a not existing object from the HashMap
        try {
            $map->remove(1);
            $this->fail("Expect exception!");
        } catch (Exception $e) {
            $this->assertEquals("Index 1 out of bounds", $e->getMessage());
        }
    }

	/**
	 * This method tests the merge method
	 * of the hash map.
	 *
	 * @return void
	 */
	public function testMerge()
	{
        // initialize a new HashMap
        $map = new TechDivision_Collections_HashMap();
		// initialize a new hash map and add some elements
		$mergeMap = new TechDivision_Collections_HashMap();
		$mergeMap->add(1, "test_merge_1");
		$mergeMap->add(3, "test_merge_3");
		// add some elements to the original hash map
		$map->add(1, "test_original_1");
		$map->add(2, "test_original_2");
		// merge the original map with the new one
        $map->merge($mergeMap);
		// check the merge result
		$this->assertEquals(3, $map->size());
		$this->assertEquals("test_original_1", $map->get(1));
    }
}