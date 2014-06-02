<?php

/**
 * \TechDivision\Collections\Enum
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
 * Interface for lists of objects that can be returned in sequence.
 *
 * Successive  objects are obtained by the nextElement method.
 *
 * @category Library
 * @package TechDivision_Collections
 * @author Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link https://github.com/techdivision/TechDivision_Collections
 */
class Enum extends Object implements Enumeration
{

    /**
     *
     * @var array The possible items.
     */
    protected $items = null;

    /**
     *
     * @var integer The point to the actual item.
     */
    protected $itemPointer = 0;

    /**
     * Standardconstructor that adds the array passed
     * as parameter to the internal membervariable.
     *
     * @param array $items
     *            An array to initialize the Enumeration
     */
    public function __construct($items = array())
    {
        $this->items = $items;
    }

    /**
     *
     * @see \TechDivision\Collections\Enumeration::hasMoreElements()
     */
    public function hasMoreElements()
    {
        if (count($this->items) > $this->itemPointer) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @see \TechDivision\Collections\Enumeration::nextElement()
     */
    public function nextElement()
    {
        if (array_key_exists($this->itemPointer, $this->items)) {
            return $this->items[$this->itemPointer ++];
        } else {
            throw new NoSuchElementException('No such element was found');
        }
    }
}