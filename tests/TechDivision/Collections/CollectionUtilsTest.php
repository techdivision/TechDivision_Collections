<?php

/**
 * \TechDivision\Collections\CollectionUtilsTest
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
 * of the CollectionUtils.
 *
 * @category Library
 * @package TechDivision_Collections
 * @author Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link https://github.com/techdivision/TechDivision_Collections
 */
class CollectionUtilsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * This variable holds the ArrayList for testing purposes.
     *
     * @var \TechDivision\Collections\ArrayList
     */
    protected $list = null;

    /**
     * This method is called befor the tests starts
     * and initializes necessary objects.
     *
     * @return void
     */
    public function setUp()
    {
        $this->list = new ArrayList();
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
        CollectionUtils::filter($this->list, new TestPredicate("Albert"));
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
        CollectionUtils::sort($this->list, new TestComparator());
        $this->assertEquals("Adolf", $this->list->get(0));
        $this->assertEquals("Albert", $this->list->get(1));
        $this->assertEquals("Caesar", $this->list->get(2));
        $this->assertEquals("Dodo", $this->list->get(3));
        $this->assertEquals("Franz", $this->list->get(4));
        $this->assertEquals("Julius", $this->list->get(5));
        $this->assertEquals("Zacharias", $this->list->get(6));
    }
}
