<?php

/**
 * \TechDivision\Collections\TestPredicate
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
 * This class implements a predicate needed for
 * the test case of the CollectionUtils.
 *
 * @category Library
 * @package TechDivision_Collections
 * @author Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link https://github.com/techdivision/TechDivision_Collections
 */
class TestPredicate implements Predicate
{

    /**
     * This variable holds the lastname needed for evaluation purposes.
     *
     * @var string
     */
    protected $lastname = "";

    /**
     * The constructor initializes the internal member
     * with the value passed as parameter.
     *
     * @param string $lastname The string needed for the evaluation
     *
     * @return void
     */
    public function __construct($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * This function checks that the string passed as
     * parameter is the same as the member.
     *
     * @param string $lastname
     *            The string that should be evaluated
     *
     * @return boolean True if the strings a equal, else false
     */
    public function evaluate($lastname)
    {
        if (strcmp($lastname, $this->lastname) == 0) {
            return true;
        } else {
            return false;
        }
    }
}