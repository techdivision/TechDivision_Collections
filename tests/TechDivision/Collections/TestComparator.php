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

require_once "TechDivision/Collections/Interfaces/Comparator.php";

/**
 * This class is the comparator sorting
 * an array by its values.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_TestComparator
    implements TechDivision_Collections_Interfaces_Comparator {

    /**
     * This method compares the begin date of the objects passed as
     * parameter .
     *
     * @param Event $object Holds the event for the evalualtion
     * @return integer Returns 0 if the begin date is equal
     * 				   Returns 1 if the begin date of the first value is smaller
     * 				   Returns -1 if the begin date of the first value is greater
     */
    public function compare($o1, $o2)
    {
		// get the values from the objects
		$value1 = $o1;
		$value2 = $o2;
		// if value 1 is smaller than value 2
		if ($value1 < $value2) {
			return -1;
		}
		// if value 1 and 2 are equal
		if ($value1 == $value2) {
			return 0;
		}
		// if value 1 is greater than value 2
		if ($value1 > $value2) {
			return 1;
		}
    }
}