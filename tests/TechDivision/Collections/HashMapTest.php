<?php

/**
 * \TechDivision\Collections\HashMapTest
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  Library
 * @package   TechDivision_Lang
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_Collections
 */
namespace TechDivision\Collections;

/**
 * This class implements the test cases
 * of the HashMap.
 *
 * @category Library
 * @package TechDivision_Collections
 * @author Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link https://github.com/techdivision/TechDivision_Collections
 */
class HashMapTest extends PHPUnit_Framework_TestCase
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
        $map = new HashMap();
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
            $map = new HashMap();
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
        $map = new HashMap();
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
        $map = new HashMap();
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
        $map = new HashMap();
        // initialize a new hash map and add some elements
        $mergeMap = new HashMap();
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
