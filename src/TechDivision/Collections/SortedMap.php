<?php

/**
 * \TechDivision\Collections\SortedMap
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

/**
 * Interface of all sorted Map objects.
 *
 * @category  Library
 * @package   TechDivision_Collections
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_Collections
 */
interface SortedMap extends Map
{

    /**
     * This method returns the comparator passed
     * with the constructor.
     *
     * @return \TechDivision\Collections\Comparator Holds the comparator passed with the constructor
     */
    public function comparator();
}
