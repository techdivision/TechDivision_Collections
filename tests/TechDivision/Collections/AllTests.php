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

// set the include path necessary for running the tests
set_include_path(
	get_include_path() . PATH_SEPARATOR
	. getcwd() . PATH_SEPARATOR
	. 'pear/php' . PATH_SEPARATOR
	. 'lib'
);

require_once 'TechDivision/XHProfPHPUnit/TestSuite.php';
require_once 'TechDivision/Collections/ArrayListTest.php';
require_once 'TechDivision/Collections/CollectionUtilsTest.php';
require_once 'TechDivision/Collections/HashMapTest.php';
require_once 'TechDivision/Collections/TreeMapTest.php';

/**
 * The TestSuite that initializes all PHPUnit tests.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_AllTests
{

    /**
     * Initializes the TestSuite.
     *
     * @return TechDivision_XHProfPHPUnit_TestSuite The initialized TestSuite
     */
    public static function suite()
    {
        // initialize the TestSuite
        $suite = new TechDivision_XHProfPHPUnit_TestSuite(
        	'${unique.name}',
        	'',
            '${version}'
        );
        // add a test
        $suite->addTestSuite('TechDivision_Collections_ArrayListTest');
        $suite->addTestSuite('TechDivision_Collections_CollectionUtilsTest');
        $suite->addTestSuite('TechDivision_Collections_HashMapTest');
        $suite->addTestSuite('TechDivision_Collections_TreeMapTest');
        // return the TestSuite itself
        return $suite;
    }
}