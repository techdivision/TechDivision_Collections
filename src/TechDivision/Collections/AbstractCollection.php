<?php

/**
 * \TechDivision\Collections\AbstractCollection
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

use TechDivision\Lang\Object;
use TechDivision\Lang\String;
use TechDivision\Lang\Float;
use TechDivision\Lang\Integer;
use TechDivision\Lang\Boolean;
use TechDivision\Lang\NullPointerException;

/**
 * Abstract base class of the IndexedCollections.
 *
 * @category  Library
 * @package   TechDivision_Collections
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_Collections
 */
abstract class AbstractCollection extends Object implements Collection, \IteratorAggregate
{

    /**
     * Holds the items of the ArrayList
     *
     * @var array
     */
    protected $items = array();

    /**
     * This method returns a new Iter object
     * needed by a foreach structure.
     *
     * @return \TechDivision\Collections\Iter Holds the Iter object
     * @see \TechDivision\Collections\IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new Iter($this->items);
    }

    /**
	 * This method appends all elements of the
	 * passed array to the Collection.
	 *
	 * @param array $array Holds the array with the values to add
	 *
	 * @return \TechDivision\Collections\Collection The instance
     * @see \TechDivision\Collections\Collection::addAll($array)
     */
    public function addAll($array)
    {
        foreach ($array as $key => $value) {
            $this->items[$key] = $value;
        }
        // return the instance
        return $this;
    }

    /**
     * This method returns the element with the passed key
     * from the Collection.
     *
     * @param mixed $key Holds the key of the element to return
     *
     * @return mixed The requested element
     * @throws \TechDivision\Collections\InvalidKeyException Is thrown if the passed key is NOT an integer
     * @throws \TechDivision\Collections\NullPointerException Is thrown if the passed key OR value are NULL
     * @throws \TechDivision\Collections\IndexOutOfBoundsException Is thrown if no element with the passed key exists in the Collection
     * @see \TechDivision\Collections\Collection::get($key)
     */
    public function get($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        // check if a primitive datatype is passed
        if (is_integer($key) || is_string($key) || is_double($key) || is_bool($key)) {
            // return the value for the passed key, if it exists
            if (array_key_exists($key, $this->items)) {
                return $this->items[$key];
            } else {
                throw new IndexOutOfBoundsException('Index ' . $key . ' out of bounds');
            }
        }
        // check if an object is passed
        if (is_object($key)) {
            if ($key instanceof String) {
                $newKey = $key->stringValue();
            } elseif ($key instanceof Float) {
                $newKey = $key->floatValue();
            } elseif ($key instanceof Integer) {
                $newKey = $key->intValue();
            } elseif ($key instanceof Boolean) {
                $newKey = $key->booleanValue();
            } elseif (method_exists($key, '__toString')) {
                $newKey = $key->__toString();
            } else {
                throw new InvalidKeyException('Passed key has to be a primitve datatype or ' . 'has to implement the __toString() method');
            }
            // return the value for the passed key, if it exists
            if (array_key_exists($newKey, $this->items)) {
                return $this->items[$newKey];
            } else {
                throw new IndexOutOfBoundsException('Index ' . $newKey . ' out of bounds');
            }
        }
        throw new InvalidKeyException('Passed key has to be a primitve datatype or ' . 'has to implement the __toString() method');
    }

    /**
     * This method checks if an element with the passed
     * key exists in the Collection.
     * If yes the method
     * returns TRUE, else FALSE.
     *
     * @param mixed $key Holds the key of the element to check for
     *
     * @return boolean Returns TRUE if the element exists in the Collection else FALSE
     * @throws \TechDivision\Collections\InvalidKeyException Is thrown if the passed key is NOT an integer
     * @throws \TechDivision\Collections\NullPointerException Is thrown if the passed key is NULL
     * @see \TechDivision\Collections\Collection::exists($key)
     */
    public function exists($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        // check if a primitive datatype is passed
        if (is_integer($key) || is_string($key) || is_double($key) || is_bool($key)) {
            // return TRUE if a value for the passed key exists, else FALSE
            return array_key_exists($key, $this->items);
        }
        // check if an object is passed
        if (is_object($key)) {
            if ($key instanceof String) {
                $newKey = $key->stringValue();
            } elseif ($key instanceof Float) {
                $newKey = $key->floatValue();
            } elseif ($key instanceof Integer) {
                $newKey = $key->intValue();
            } elseif ($key instanceof Boolean) {
                $newKey = $key->booleanValue();
            } elseif (method_exists($key, '__toString')) {
                $newKey = $key->__toString();
            } else {
                throw new InvalidKeyException('Passed key has to be a primitve datatype or ' . 'has to implement the __toString() method');
            }
            // return TRUE if a value for the passed key exists, else FALSE
            return array_key_exists($newKey, $this->items);
        }
        throw new InvalidKeyException('Passed key has to be a primitve datatype or ' . 'has to implement the __toString() method');
    }

    /**
     * This method returns an array with the
     * items of the Dictionary. The keys are
     * lost in the array.
     *
     * @return array Holds an array with the items of the Dictionary
     * @see \TechDivision\Collections\Collection::toArray()
     */
    public function toArray()
    {
        return array_values($this->items);
    }

    /**
     * This method returns the number of entries of the Collection.
     *
     * @return integer The number of entries
     * @see \TechDivision\Collections\Collection::size()
     */
    public function size()
    {
        return sizeof($this->items);
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
        $this->items = array();
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
        if ($this->size() == 0) {
            return true;
        }
        return false;
    }

    /**
     * This method removes the element with the passed
     * key, that has to be an integer, from the
     * IndexedCollection.
     *
     * @param mixed $key Holds the key of the element to remove
     *
     * @return void
     * @throws \TechDivision\Collections\InvalidKeyException Is thrown if the passed key is NOT an integer
     * @throws \TechDivision\Collections\NullPointerException Is thrown if the passed key is NULL
     */
    public function remove($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        // check if a primitive datatype is passed
        if (is_integer($key) || is_string($key) || is_double($key) || is_bool($key)) {
            if (array_key_exists($key, $this->items)) {
                // remove the item
                unset($this->items[$key]);
                // return the instance
                return $this;
            } else {
                throw new IndexOutOfBoundsException('Index ' . $key . ' out of bounds');
            }
        }
        // check if an object is passed
        if (is_object($key)) {
            if ($key instanceof String) {
                $newKey = $key->stringValue();
            } elseif ($key instanceof Float) {
                $newKey = $key->floatValue();
            } elseif ($key instanceof Integer) {
                $newKey = $key->intValue();
            } elseif ($key instanceof Boolean) {
                $newKey = $key->booleanValue();
            } elseif (method_exists($key, '__toString')) {
                $newKey = $key->__toString();
            } else {
                throw new InvalidKeyException('Passed key has to be a primitve datatype or ' . 'has to implement the __toString() method');
            }
            if (array_key_exists($newKey, $this->items)) {
                // remove the item
                unset($this->items[$newKey]);
                // returns the instance
                return $this;
            } else {
                throw new IndexOutOfBoundsException('Index ' . $newKey . ' out of bounds');
            }
        }
        throw new InvalidKeyException('Passed key has to be a primitve datatype or ' . 'has to implement the __toString() method');
    }

    /**
     * This method merges the elements of the passed map
     * with the elements of the actual map.
     *
     * If the keys are equal, the existing value is taken, else
     * the new one is appended.
     *
     * @param \TechDivision\Collections\Collection $col Holds the Collection with the values to merge
     *
     * @return void
     * @deprecated Does not work correctly
     */
    public function merge(Collection $col)
    {
        // union the items of the two maps
        $this->items = $this->items + $col->toArray();
    }

    /**
     * This method checks if an element with the passed
     * value exists in the ArrayList.
     *
     * @param mixed $value Holds the value to check the elements of the array list for
     *
     * @return boolean Returns true if an element with the passed value exists in the array list
     */
    public function contains($value)
    {
        // initialize the return value
        $isEqual = false;
        // run through all elements an check if the one
        // of the items is equal to the passed one
        foreach ($this->items as $item) {
            if ($item == $value) {
                $isEqual = true;
            }
        }
        // return false if the value is not found
        return $isEqual;
    }
}
