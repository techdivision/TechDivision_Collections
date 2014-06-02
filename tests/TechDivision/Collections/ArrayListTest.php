<?php

/**
 * \TechDivision\Collections\ArrayListTest
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
 * of the ArrayList.
 *
 * @category Library
 * @package TechDivision_Collections
 * @author Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link https://github.com/techdivision/TechDivision_Collections
 */
class ArrayListTest extends \PHPUnit_Framework_TestCase
{

    /**
     * This variable holds the ArrayList.
     *
     * @var \TechDivision\Collections\ArrayList
     */
    protected $list = null;

    /**
     * This method tests the add and the get method
     * of the ArrayList.
     *
     * @return void
     */
    public function testAddAndGetAndIsEmptyAndClear()
    {
        // initialize a new ArrayList
        $list = new ArrayList();
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
        $this->setExpectedException('\TechDivision\Lang\NullPointerException');
        // initialize a new ArrayList
        $list = new ArrayList();
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
        $list = new ArrayList();
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
        $list = new ArrayList();
        // try to remove a not existing object from the ArrayList
        try {
            $list->remove(1);
            $this->fail("Expect exception!");
        } catch (\Exception $e) {
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
        $list = new ArrayList();
        // add different values to the ArrayList
        $list->add("test");
        $list->add(1);
        // check for the values
        $this->assertTrue($list->exists(0));
        $this->assertTrue($list->exists(1));
    }
}
