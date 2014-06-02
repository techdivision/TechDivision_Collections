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
require_once "TechDivision/Collections/ArrayList.php";
require_once "TechDivision/Collections/HashMap.php";

/**
 * This class implements the test cases
 * of the ArrayList.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_ArrayListTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var ArrayList This variable holds the ArrayList
	 */
	private $list = null;

	/**
	 * This method tests the add and the get method
     * of the ArrayList.
	 *
	 * @return void
	 */
	public function testAddAndGetAndIsEmptyAndClear()
	{
        // initialize a new ArrayList
        $list = new TechDivision_Collections_ArrayList();
        // check that the ArrayList is empty
        $this->assertTrue($list->isEmpty());
        // add a new element
        $list->add("Test");
        // get the element
        $this->assertEquals("Test", $list->get(0));
        // check that the ArrayList is not empty
        $this->assertFalse($list->isEmpty());
        // remove all elements
        $list->clear();
        // check that the ArrayList is empty
        $this->assertTrue($list->isEmpty());
    }

	/**
	 * This method tests the get method of the ArrayList.
	 *
	 * @return void
	 */
	public function testAddNullWithException()
	{
	    // set the excpected exception
	    $this->setExpectedException(
	    	'TechDivision_Lang_Exceptions_NullPointerException'
	    );
        // initialize a new ArrayList
        $list = new TechDivision_Collections_ArrayList();
        // try to add a null value
        $list->add(null);
        // let the test fail
        $this->fail("Expected exception NullPointerException not thrown");
    }

	/**
	 * This method tests the add, remove and
     * size method of the ArrayList.
	 *
	 * @return void
	 */
	public function testAddAndRemoveAndSize()
	{
        // initialize a new ArrayList
        $list = new TechDivision_Collections_ArrayList();
        $this->assertEquals(0, $list->size());
        $list->add("Element 1");
        $list->add("Element 2");
        $list->add("Element 3");
        $this->assertEquals(3, $list->size());
        $list->remove(2);
        $this->assertEquals(2, $list->size());
    }

	/**
	 * This method tests that a exception is thrown if the
     * object with the key, passed to the remove method as
     * a parameter, does not exist in the ArrayList.
	 *
	 * @return void
	 */
	public function testDeleteWithException()
	{
        // initialize a new ArrayList
        $list = new TechDivision_Collections_ArrayList();
        // try to remove a not existing object from the ArrayList
        try {
            $list->remove(1);
            $this->fail("Expect exception!");
        } catch (Exception $e) {
            $this->assertEquals("Index 1 out of bounds", $e->getMessage());
        }
    }

	/**
	 * This method tests that the exists method
	 * returns TRUE if the values exists in the
	 * ArrayList.
	 *
	 * @return void
	 */
	public function testExists()
	{
		// initialize two new ArrayList's
		$list = new TechDivision_Collections_ArrayList();
		// add different values to the ArrayList
		$list->add("test");
		$list->add(1);
		// check for the values
        $this->assertTrue($list->exists(0));
		$this->assertTrue($list->exists(1));
    }
}