<?php

/**
 * \TechDivision\Collections\TreeMap
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

use TechDivision\Lang\String;
use TechDivision\Lang\Integer;
use TechDivision\Lang\Float;
use TechDivision\Lang\Boolean;
use TechDivision\Lang\ClassCastException;
use TechDivision\Lang\NullPointerException;

/**
 * This class is the implementation of a sorted HashMap.
 *
 * @category Library
 * @package TechDivision_Collections
 * @author Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link https://github.com/techdivision/TechDivision_Collections
 */
class TreeMap extends AbstractMap implements SortedMap
{

    /**
     * Holds the comparator to sort the internal array.
     *
     * @var \TechDivision\Collections\Comparator
     */
    protected $comparator = null;

    /**
     * Standardconstructor that adds the array passed
     * as parameter to the internal membervariable.
     *
     * Be careful when using a comparator, because sorting
     * a large map can take much processor time and memory.
     *
     * @param \TechDivision\Collections\Comparator $comparator Holds the comparator to use
     * @param array                                $items      An array to initialize the TreeMap
     *
     * @return void
     * @throws \TechDivision\Lang\ClassCastException Is thrown if the parameter items is not of type array
     */
    public function __construct(Comparator $comparator = null, $items = array())
    {
        // set the comparator
        $this->comparator = $comparator;
        // check if NULL is passed, is yes, to nothing
        if (is_null($items)) {
            return;
        }
        // check if an array is passed
        if (is_array($items)) {
            // initialize the TreeMap with the values of the passed array
            foreach ($items as $key => $item) {
                $this->add($key, $item);
            }
            return;
        }
        // if not a array is passed throw an exception
        throw new ClassCastException('Passed object is not an array');
    }

    /**
     * This method adds the passed object with the passed key
     * to the TreeMap.
     *
     * @param mixed $key    The key to add the passed value under
     * @param mixed $object The object to add to the TreeMap
     *
     * @return \TechDivision\Collections\TreeMap
     * @throws \TechDivision\Collections\InvalidKeyException Is thrown if the passed key is NOT an primitve datatype
     * @throws \TechDivision\Lang\NullPointerException Is thrown if the passed key is null or not a flat datatype like Integer, String, Double or Boolean
     */
    public function add($key, $object)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        // check if a primitive datatype is passed
        if (is_integer($key) || is_string($key) || is_double($key) || is_bool($key)) {
            // add the passed object to the internal array
            $this->items[$key] = $object;
            // sort the instance
            $this->sort();
            // return the instance
            return $this;
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
                throw new InvalidKeyException('Passed key has to be a primitve datatype or has to implement the __toString() method');
            }
            // add the passed object to the internal array
            $this->items[$newKey] = $object;
            // sort the instance
            $this->sort();
            // return the instance
            return $this;
        }
        throw new InvalidKeyException('Passed key has to be a primitve datatype or has to implement the __toString() method');
    }

    /**
     * Sorts the instance with the given comparator
     * or the PHP ksort() funktion.
     *
     * @return boolean Returns TRUE if the instance was sorted successfully
     */
    protected function sort()
    {
        // if no comparator is passed sort the internal array
        // by its keys, else use the comparator
        if ($this->comparator == null) {
            return ksort($this->items);
        } else {
            return CollectionUtils::sort($this, $this->comparator);
        }
    }

    /**
     * This method Returns a new TreeMap initialized with the
     * passed array.
     *
     * @param array $array Holds the array to initialize the new TreeMap
     *
     * @return \TechDivision\Collections\TreeMap Returns a TreeMap initialized with the passed array
     * @throws \TechDivision\Lang\ClassCastException Is thrown if the passed object is not an array
     */
    public static function fromArray($array)
    {
        // check if the passed object is an array and set it
        if (is_array($array)) {
            return new TreeMap($this->comparator, $array);
        }
        // throw an exception if the passed object is not an array
        throw ClassCastException('Passed object is not an array');
    }

    /**
     *
     * @see \TechDivision\Collections\SortedMap::comparator()
     */
    public function comparator()
    {
        return $this->comparator;
    }
}
