<?php

/**
 * \TechDivision\Collections\Dictionary
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

use TechDivision\Lang\ClassCastException;
use TechDivision\Lang\NullPointerException;
use TechDivision\Lang\IndexOutOfBoundsException;

/**
 * This class is the implementation of a Dictionary.
 *
 * A dictionary uses objects as keys instead of integers
 * like a HashMap.
 *
 * @category  Library
 * @package   TechDivision_Collections
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_Collections
 */
class Dictionary extends Object implements Set
{

    /**
     * Holds the keys with the objects.
     *
     * @var array
     */
    protected $keys = array();

    /**
     * Holds the items of the Dictionary
     *
     * @var array
     */
    protected $items = array();

    /**
     * Holds the internal counter for the keys.
     *
     * @var integer
     */
    protected $key = 0;

    /**
     * Standardconstructor that adds the values of the array passed
     * as parameter to the internal membervariable.
     *
     * @param array $items An array to initialize the Dictionary
     *
     * @return void
     * @throws \TechDivision\Lang\ClassCastException Is thrown if nor NULL or an object that is not a Dictionary is passed
     * @see \TechDivision\Collections\Dictionary::add($key, $value)
     */
    public function __construct($items = null)
    {
        // check if NULL is passed, is yes, to nothing
        if (is_null($items)) {
            return;
        }
        // check if an array is passed
        if (is_array($items)) {
            // initialize the Dictionary with the values of the passed array
            foreach ($items as $key => $item) {
                $this->add($key, $item);
            }
            return;
        }
        // if not a array is passed throw an exception
        throw new ClassCastException('Passed object is not an array');
    }

    /**
     * This method adds the passed value with the passed key
     * to the Dictionary.
     *
     * @param object $key   Holds the key as object to add the value under
     * @param mixed  $value Holds the value to add
     *
     * @return \TechDivision\Collections\Dictionary The instance
     * @throws \TechDivision\Collections\InvalidKeyException Is thrown if the passed key is NOT an object
     * @throws \TechDivision\Lang\NullPointerException Is thrown if the passed key OR value are NULL
     */
    public function add($key, $value)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        if (is_null($value)) {
            throw new NullPointerException('Passed value with key ' . $key . ' is null');
        }
        if (!is_object($key)) {
            throw new InvalidKeyException('Passed key has to be an object');
        }
        // get the next id
        $id = $this->key ++;
        // add the key to the array with the keys
        $this->keys[$id] = $key;
        // and add the value with the IDENTICAL id to internal
        // array with the values
        $this->items[$id] = $value;
        // return the instance
        return $this;
    }

    /**
     * This method returns the element with the passed key
     * from the Dictionary.
     *
     * @param object $key Holds the key of the element to return
     *
     * @return mixed The requested element
     * @throws \TechDivision\Lang\InvalidKeyException Is thrown if the passed key is NOT an object
     * @throws \TechDivision\Lang\NullPointerException Is thrown if the passed key OR value are NULL
     * @throws \TechDivision\Collections\IndexOutOfBoundsException Is thrown if no element with the passed key exists in the Dictionary
     * @see \TechDivision\Collections\IndexedCollection::get($key)
     */
    public function get($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        if (!is_object($key)) {
            throw new InvalidKeyException('Passed key has to be an object');
        }
        // run over all keys and check if one is equal to the passed one
        foreach ($this->keys as $id => $value) {
            // if the actual is equal to the passed key ..
            if ($key == $value) {
                // return the item with the passed key
                if (arraykey_exists($id, $this->items)) {
                    return $this->items[$id];
                }
            }
        }
        // if no value is found throw an exception
        throw new IndexOutOfBoundsException('Index out of bounds');
    }

    /**
     * This method initializes the Collection and removes
     * all exsiting entries.
     *
     * @return void
     * @see \TechDivision\Collections\Collection::clear()
     */
    public function clear()
    {
        // intialize the internal arrays and keys
        $this->keys = array();
        $this->items = array();
        $this->key = 0;
    }

    /**
     * This method returns the number of entries of the Collection.
     *
     * @return integer The number of entries
     * @see \TechDivision\Collections\InterfacesCollection::size()
     */
    public function size()
    {
        return sizeof($this->keys); // return the size of the keys array
    }

    /**
     * This method checks if the element with the passed
     * key exists in the Dictionary.
     *
     * @param object $key Holds the key to check the elements of the Dictionary for
     *
     * @return boolean Returns true if an element with the passed key exists in the Dictionary
     * @throws \TechDivision\Collections\InvalidKeyException Is thrown if the passed key is NOT an object
     * @throws \TechDivision\Lang\NullPointerException Is thrown if the passed key is NULL
     * @see \TechDivision\Collections\IndexedCollection::exists($key)
     */
    public function exists($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        if (!is_object($key)) {
            throw new InvalidKeyException('Passed key has to be an object');
        }
        // run over all keys and check if one is equal to the passed one
        foreach ($this->keys as $id => $value) {
            // if the actual is equal to the passed key ..
            if ($key == $value) {
                // return TRUE if the key is found
                return true;
            }
        }
        // return FALSE if the key is not found
        return false;
    }

    /**
     * This returns true if the Collection has no
     * entries, otherwise false.
     *
     * @return boolean
     * @see \TechDivision\Collections\Collection::isEmpty()
     */
    public function isEmpty()
    {
        // if no items are set return true
        if ($this->key == 0) {
            return true;
        }
        return false;
    }

    /**
     * This method returns an array with the
     * items of the Dictionary.
     *
     * The keys are lost in the array.
     *
     * @return array Holds an array with the items of the Dictionary
     * @see \TechDivision\Collections\Collection::toArray()
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * This method returns the keys as
     * an array.
     *
     * @return array Holds an array with the keys
     */
    public function keysToArray()
    {
        return $this->keys;
    }

    /**
     * This method removes the element with the passed
     * key, that has to be an object, from the Dictionary.
     *
     * @param object $key Holds the key of the element to remove
     *
     * @return void
     * @throws \TechDivision\Lang\NullPointerException Is thrown if the passed key is NULL
     * @throws \TechDivision\Collections\InvalidKeyException Is thrown if the passed key is NOT an object
     * @throws \TechDivision\Collections\IndexOutOfBoundsException Is thrown if no element with the passed key exists in the Dictionary
     */
    public function remove($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        if (!is_object($key)) {
            throw new InvalidKeyException('Passed key has to be an object');
        }
        // run over all keys and check if one is equal to the passed one
        foreach ($this->keys as $id => $value) {
            // if the actual is equal to the passed key ..
            if ($key == $value) {
                // unset the elements
                unset($this->items[$id]);
                unset($this->keys[$id]);
                return;
            }
        }
        // throw an exception if key is not found in internal array
        throw new IndexOutOfBoundsException('Index out of bounds');
    }

    /**
     * This method appends all elements of the
     * passed array to the Dictionary.
     *
     * @param array $array Holds the array with the values to add
     *
     * @return void
     */
    public function addAll($array)
    {
        foreach ($array as $key => $value) {
            $this->add($key, $value);
        }
    }
}
