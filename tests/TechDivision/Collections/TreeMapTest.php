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

require_once 'PHPUnit/Framework.php';
require_once 'TechDivision/Collections/TreeMap.php';
require_once 'TechDivision/Collections/TestComparator.php';

/**
 * This class implements the test cases
 * of the TreeMap.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_TreeMapTest extends PHPUnit_Framework_TestCase
{

	/**
	 * This method tests the add and the get method
     * of the TreeMap.
	 *
	 * @return void
	 */
	public function testAddAndGetAndIsEmptyAndClear()
	{
        // initialize a new TreeMap
        $map = new TechDivision_Collections_TreeMap();
        // check that the TreeMap is empty
        $this->assertTrue($map->isEmpty());
        // add a new element
        $map->add(10, 'Test');
        // get the element
        $this->assertEquals('Test', $map->get(10));
        // check that the TreeMap is not empty
        $this->assertFalse($map->isEmpty());
        // remove all elements
        $map->clear();
        // check that the TreeMap is empty
        $this->assertTrue($map->isEmpty());
    }

	/**
	 * This method tests the get method of the TreeMap.
	 *
	 * @return void
	 */
	public function testAddAndGetWithNull()
	{
        try {
            // initialize a new TreeMap
            $map = new TechDivision_Collections_TreeMap();
			$this->assertNull($map->get(0));
			$this->fail("Insert out of bounds exception expected!");
        } catch (Exception $e) {
        	$this->assertEquals("Index 0 out of bounds", $e->getMessage());
        }
    }

	/**
	 * This method tests the add, remove and
     * size method of the TreeMap.
	 *
	 * @return void
	 */
	public function testAddAndRemoveAndSize()
	{
        // initialize a new TreeMap
        $map = new TechDivision_Collections_TreeMap();
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
     * a parameter, does not exist in the TreeMap.
	 *
	 * @return void
	 */
	public function testDeleteWithException()
	{
	    $this->setExpectedException(
	    	'TechDivision_Collections_Exceptions_IndexOutOfBoundsException'
	    );
        // initialize a new TreeMap
        $map = new TechDivision_Collections_TreeMap();
        // try to remove a not existing object from the TreeMap
        $map->remove(1);
        $this->fail(
        	'Expected exception IndexOutOfBoundsException is not thrown'
        );

    }

	/**
	 * This method tests the merge method
	 * of the TreeMap.
	 *
	 * @return void
	 */
	public function testMerge()
	{
        // initialize a new TreeMap
        $map = new TechDivision_Collections_TreeMap();
		// initialize a new TreeMap and add some elements
		$mergeMap = new TechDivision_Collections_TreeMap();
		$mergeMap->add(1, "test_merge_1");
		$mergeMap->add(3, "test_merge_3");
		// add some elements to the original TreeMap
		$map->add(1, "test_original_1");
		$map->add(2, "test_original_2");
		// merge the original TreeMap with the new one
        $map->merge($mergeMap);
		// check the merge result
		$this->assertEquals(3, $map->size());
		$this->assertEquals("test_original_1", $map->get(1));
    }

    /**
     * This method tests if the TreeMap is
     * sorted correctly.
     *
     * return void
     */
    public function testSorted()
    {
        // initialize a new TreeMap
        $map = new TechDivision_Collections_TreeMap();
        //add several values
        $map->add(0, "test_value_0");
        $map->add(2, "test_value_2");
        $map->add(1, "test_value_1");
        // check the sort order
        $counter = 0;
        foreach($map as $key => $value) {
        	$this->assertEquals($key, $counter++);
        }
    }

    /**
     * This method tests if the TreeMap is sorted 
     * correctly by the passed Comparator.
     *
     * return void
     */
    public function testSortedByComparator()
    {
        // initialize a new TreeMap
        $map = new TechDivision_Collections_TreeMap(
            new TechDivision_Collections_TestComparator()
        );
        //add several values
        $map->add(0, 3);
        $map->add(1, 2);
        $map->add(2, 1);
        // initialize the values
        $counter = 1;
        $keys = 0;
        // check the sort order
        foreach($map as $key => $value) {
        	$this->assertEquals($keys++, $key);
        	$this->assertEquals($counter++, $value);
        }
    }
}