<?php

/**
 * \TechDivision\Collections\HashMap
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

use \TechDivision\Lang\String;
use \TechDivision\Lang\Integer;
use \TechDivision\Lang\Float;
use \TechDivision\Lang\Boolean;
use \TechDivision\Lang\NullPointerException;
use \TechDivision\Lang\ClassCastException;

/**
 * This class is the implementation of a HashMap.
 *
 * @category Library
 * @package TechDivision_Collections
 * @author Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link https://github.com/techdivision/TechDivision_Collections
 */
class HashMap extends AbstractMap
{

    /**
     * Standardconstructor that adds the array passed
     * as parameter to the internal membervariable.
     *
     * @param array $items
     *            An array to initialize the HashMap
     *
     * @return void
     *
     * @throws \TechDivision\Lang\ClassCastException Is thrown if the passed parameter is not of type array
     */
    public function __construct($items = array())
    {
        // check if NULL is passed, is yes, to nothing
        if (is_null($items)) {
            return;
        }
        // check if an array is passed
        if (is_array($items)) {
            // initialize the HashMap with the values of the passed array
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
     * to the HashMap.
     *
     * @param mixed $key
     *            The key to add the passed value under
     * @param mixed $object
     *            The object to add to the HashMap
     *
     * @return \TechDivision\Collections\HashMap The instance
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
            // add the item to the array
            $this->items[$key] = $object;
            // and return
            return;
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
                throw new InvalidKeyException('Passed key has to be a primitve datatype or  has to implement the __toString() method');
            }
            // add the item to the array
            $this->items[$newKey] = $object;
            // and return
            return;
        }
        throw new InvalidKeyException('Passed key has to be a primitve datatype or  has to implement the __toString() method');
    }

    /**
     * This method Returns a new HashMap initialized with the
     * passed array.
     *
     * @param array $array
     *            Holds the array to initialize the new HashMap
     *
     * @return \TechDivision\Collections\HashMap Returns a HashMap initialized with the passed array
     * @throws \TechDivision\Lang\ClassCastException Is thrown if the passed object is not an array
     */
    public static function fromArray($array)
    {
        // check if the passed object is an array and set it
        if (is_array($array)) {
            return new HashMap($array);
        }
        // throw an exception if the passed object is not an array
        throw ClassCastException('Passed object is not an array');
    }
}
