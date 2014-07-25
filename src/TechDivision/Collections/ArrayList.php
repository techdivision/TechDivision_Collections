<?php

/**
 * \TechDivision\Collections\ArrayList
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
 * @package   TechDivision_Collections
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_Collections
 */
namespace TechDivision\Collections;

use TechDivision\Lang\ClassCastException;
use TechDivision\Lang\NullPointerException;

/**
 * This class is the implementation of a ArrayList.
 *
 * @category  Library
 * @package   TechDivision_Collections
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_Collections
 */
class ArrayList extends AbstractCollection
{

    /**
     * Holds the internal counter for the keys of the ArrayList.
     *
     * @var integer
     */
    protected $count = 0;

    /**
     * Standardconstructor that adds the array passed
     * as parameter to the internal membervariable.
     *
     * @param array $items An array to initialize the ArrayList
     *
     * @return void
     */
    public function __construct($items = null)
    {
        // check if NULL is passed, is yes, to nothing
        if (is_null($items)) {
            return;
        }
        // check if an array is passed
        if (is_array($items)) {
            // initialize the ArrayList with the values of the passed array
            foreach ($items as $key => $item) {
                $this->add($item);
            }
            return;
        }
        // if not a array is passed throw an exception
        throw new ClassCastException('Passed object is not an array');
    }

    /**
     * This method adds the passed object with the passed key
     * to the ArrayList.
     *
     * @param mixed $object The object that should be added to the ArrayList
     *
     * @return \TechDivision\Collection\ArrayList The instance
     * @throws \TechDivision\Lang\NullPointerException Is thrown it the passed object is NULL
     */
    public function add($object)
    {
        if (is_null($object)) {
            throw new NullPointerException('Passed object is null');
        }
        // set the item in the array
        $this->items[$this->count ++] = $object;
        // return the instance
        return $this;
    }

    /**
     * This method Returns a new ArrayList initialized with the
     * passed array.
     *
     * @param array $array Holds the array to initialize the new ArrayList
     *
     * @return \TechDivision\Collections\ArrayList Returns an ArrayList initialized with the passed array
     * @throws \TechDivision\Lang\ClassCastException Is thrown if the passed object is not an array
     */
    public static function fromArray($array)
    {
        // check if the passed object is an array and set it
        if (is_array($array)) {
            return new ArrayList($array);
        }
        // throw an exception if the passed object is not an array
        throw new ClassCastException('Passed object is not an array');
    }

    /**
     * This method returns a new ArrayList with the
     * items from the passed offset with the passed
     * length.
     *
     * If no length is passed, the section up from
     * the offset until the end of the items is
     * returned.
     *
     * @param integer $offset The start of the section
     * @param integer $length The length of the section to return
     *
     * @return \TechDivision\Collections\ArrayList Holds the ArrayList with the requested elements
     */
    public function slice($offset, $length = null)
    {
        // initialize the items
        $items = array();
        // if lenght is not define return all items from the offset up
        // till the end of the items, else return all items from the offset
        // with the defined length
        if ($length == null) {
            $items = array_slice($this->items, $offset);
        } else {
            $items = array_slice($this->items, $offset, $length);
        }
        // return a new ArraList with the requested items
        return new ArrayList($items);
    }
}
