<?php

/**
 * License: GNU General Public License
 *
 * Copyright (c) 2009 TechDivision GmbH.  All rights reserved.
 * Note: Original work copyright to respective authors
 *
 * This file is part of TechDivision GmbH - Connect.
 *
 * faett.net is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * faett.net is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,
 * USA.
 *
 * @package TechDivision_Collections
 */

require_once "TechDivision/Collections/Interfaces/Predicate.php";

/**
 * This class implements a predicate needed for
 * the test case of the CollectionUtils.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_TestPredicate
    implements TechDivision_Collections_Interfaces_Predicate {

    /**
	 * @var string This variable holds the lastname needed for evaluation purposes
	 */
    private $lastname = "";

    /**
     * The constructor initializes the internal member
     * with the value passed as parameter.
     *
     * @param string The string needed for the evaluation
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
     * @param string $lastname The string that should be evaluated
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