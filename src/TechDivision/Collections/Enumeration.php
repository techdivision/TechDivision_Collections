<?php

/**
 * \TechDivision\Collections\Enumeration
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
 * Successive objects are obtained by the nextElement method.
 *
 * @category Library
 * @package TechDivision_Collections
 * @author Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link https://github.com/techdivision/TechDivision_Collections
 */
interface Enumeration
{

    /**
     * Tests whether there are elements remaining in the enumeration.
     *
     * @return true if there is at least one more element in the enumeration, that is, if the next call to nextElement will not throw a NoSuchElementException.
     */
    function hasMoreElements();

    /**
     * Obtain the next element in the enumeration.
     *
     * @return the next element in the enumeration
     * @throws \TechDivision\Collections\NoSuchElementException if there are no more elements
     */
    function nextElement();
}
