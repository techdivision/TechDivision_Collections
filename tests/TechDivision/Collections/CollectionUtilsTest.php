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
require_once "TechDivision/Collections/TestPredicate.php";
require_once "TechDivision/Collections/TestComparator.php";
require_once "TechDivision/Collections/ArrayList.php";
require_once "TechDivision/Collections/CollectionUtils.php";

/**
 * This class implements the test cases
 * of the CollectionUtils.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_CollectionUtilsTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var ArrayList This variable holds the ArrayList for testing purposes
	 */
	private $list = null;

    /**
     * This method is called befor the tests starts
     * and initializes necessary objects.
     *
     * @return void
     */
    public function setUp()
    {
        $this->list = new TechDivision_Collections_ArrayList();
        $this->list->add("Albert");
        $this->list->add("Dodo");
        $this->list->add("Franz");
		$this->list->add("Adolf");
		$this->list->add("Caesar");
		$this->list->add("Zacharias");
		$this->list->add("Julius");
    }

    /**
     * This method is called after the tests and
     * destroys the objects.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->list = null;
    }

	/**
	 * This method tests the filter method
     * of the CollectionUtils.
	 *
	 * @return void
	 */
	public function testFilter()
	{
        // filter all elements with lastname
        TechDivision_Collections_CollectionUtils::filter(
            $this->list,
            new TechDivision_Collections_TestPredicate("Albert")
        );
        $this->assertEquals(1, $this->list->size());
    }

	/**
	 * This method tests the sort method
     * of the CollectionUtils.
	 *
	 * @return void
	 */
	public function testSort()
	{
		// sort all elements by their value
		TechDivision_Collections_CollectionUtils::sort(
		    $this->list,
		    new TechDivision_Collections_TestComparator()
		);
		$this->assertEquals("Adolf", $this->list->get(0));
		$this->assertEquals("Albert", $this->list->get(1));
		$this->assertEquals("Caesar", $this->list->get(2));
		$this->assertEquals("Dodo", $this->list->get(3));
		$this->assertEquals("Franz", $this->list->get(4));
		$this->assertEquals("Julius", $this->list->get(5));
		$this->assertEquals("Zacharias", $this->list->get(6));
	}
}