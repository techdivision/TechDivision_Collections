<?php

/**
 * \TechDivision\Collections\Iter
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

/**
 * This class is the default implementation of a Iterator
 * used for foreach constructs.
 *
 * @category  Library
 * @package   TechDivision_Collections
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_Collections
 */
class Iter extends Object implements \Iterator
{

    /**
     * Holds the internal array
     *
     * @var array
     */
    protected $arr = array();

    /**
     * Constructor that initializes the internal member
     * with the array passed as parameter.
     *
     * @param array $array Holds the array
     *
     * @return void
     */
    public function __construct($array)
    {
        if (is_array($array)) {
            $this->arr = $array;
        }
    }

    /**
     * Resets the internal array pointer to
     * the first entry.
     *
     * And retures the value therefore.
     *
     * @return mixed Holds the first value of the internal array
     */
    public function rewind()
    {
        return reset($this->arr);
    }

    /**
     * Returns the actual entry.
     *
     * @return mixed The actual entry of the internal array
     */
    public function current()
    {
        return current($this->arr);
    }

    /**
     * Returns the key of the actual entry.
     *
     * @return mixed The key of actual entry of the internal array
     */
    public function key()
    {
        return key($this->arr);
    }

    /**
     * Returns the next entry.
     *
     * @return mixed The next entry of the internal array
     */
    public function next()
    {
        return next($this->arr);
    }

    /**
     * Checks if the actual entry of the internal
     * array is not false.
     *
     * @return boolean TRUE if there is a actual entry in the internal array, else FALSE
     */
    public function valid()
    {
        return $this->current() !== false;
    }

    /**
     * This method sets the internal array pointer
     * to the end of the array and returns the
     * value therefore.
     *
     * @return mixed Holds the last value of the internal array
     */
    public function last()
    {
        return end($this->arr);
    }
}
