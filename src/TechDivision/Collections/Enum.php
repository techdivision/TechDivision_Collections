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

require_once "TechDivision/Lang/Object.php";
require_once "TechDivision/Collections/Interfaces/Enumeration.php";
require_once "TechDivision/Collections/Exceptions/NoSuchElementException.php";

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
class TechDivision_Collections_Enum
    extends TechDivision_Lang_Object
    implements TechDivision_Collections_Interfaces_Enumeration
{

    /**
     * @var array The possible items.
     */
	protected $_items = null;

	/**
	 * @var integer The point to the actual item.
	 */
	protected $_itemPointer = 0;

	/**
	 * Standardconstructor that adds the array passed
	 * as parameter to the internal membervariable.
	 *
	 * @param array $items An array to initialize the Enumeration
	 */
	public function __construct($items = array())
	{
		$this->_items = $items;
	}

	/**
     * @see TechDivision_Collections_Interfaces_Enumeration::hasMoreElements()
     */
	public function hasMoreElements()
	{
		if (count($this->_items) > $this->_itemPointer) {
			return true;
		} else {
			return false;
		}
	}

	/**
     * @see TechDivision_Collections_Interfaces_Enumeration::nextElement()
     */
	public function nextElement()
	{
		if (array_key_exists($this->_itemPointer, $this->_items)) {
			return $this->_items[$this->_itemPointer++];
		} else {
			throw new TechDivision_Collections_Exceptions_NoSuchElementException(
			    'No such element was found'
			);
		}
	}
}