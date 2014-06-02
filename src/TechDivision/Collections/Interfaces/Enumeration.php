<?php

/**
 * License: GNU General Public License
 *
 * Copyright (c) 2009 TechDivision GmbH.  All rights reserved.
 * Note: Original work copyright to respective authors
 *
 * This file is part of TechDivision GmbH - Connect.
 *
 * TechDivision_Collections is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * TechDivision_Collections is distributed in the hope that it will be useful,
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

/**
 * Interface for lists of objects that can be returned in sequence. Successive
 * objects are obtained by the nextElement method.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
interface TechDivision_Collections_Interfaces_Enumeration
{
	/**
	 * Tests whether there are elements remaining in the enumeration.
	 *
	 * @return true if there is at least one more element in the enumeration,
	 *         that is, if the next call to nextElement will not throw a
	 *         TechDivision_Collections_Exceptions_NoSuchElementException.
	 */
	function hasMoreElements();

	/**
	 * Obtain the next element in the enumeration.
	 *
	 * @return the next element in the enumeration
	 * @throws TechDivision_Collections_Exceptions_NoSuchElementException if there are no more elements
	 */
	function nextElement();
}