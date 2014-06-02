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
require_once "TechDivision/Collections/ArrayList.php";
require_once "TechDivision/Collections/Interfaces/Collection.php";
require_once "TechDivision/Collections/Interfaces/Comparator.php";
require_once "TechDivision/Collections/Interfaces/Predicate.php";

/**
 * This class implements static methods that can be used
 * to work with Collections.
 *
 * @package TechDivision_Collections
 * @author Tim Wagner <t.wagner@techdivision.com>
 * @copyright TechDivision GmbH
 * @link http://www.techdivision.com
 * @license GPL
 */
class TechDivision_Collections_CollectionUtils
    extends TechDivision_Lang_Object {

	/**
	 * Standardconstructor that marks this class as util class.
	 */
	private function __construct()
	{
		/* Marks class as utility */
	}

    /**
     * This method iterates over the passed IndexedCollection and invokes
     * the evaluate method of the although passed Predicate on
     * every object of the IndexedCollection. If the evaluate method returns
     * false, the object is removed from the passed IndexedCollection.
     *
     * @param TechDivision_Collections_Interfaces_Collection $collection
     * 		Holds the IndexedCollection that should be filtered
     * @param TechDivision_Collections_Interfaces_Predicate $predicate
     * 		The Predicate that should be used for evaluation purposes
     * @param int $iterations
     * 		Holds the size of successfull interations, after that the
     * 		filter should run
     */
    public static function filter(
        TechDivision_Collections_Interfaces_Collection $collection,
        TechDivision_Collections_Interfaces_Predicate $predicate,
        $iterations = 0) {
        // initialize the ArrayList that should be returned
        $return = array();
		// initialize the counter for the iterations
		$iteration = 0;
        // iterate over the ArrayList and invoke the evaluate()
        // method of the Predicate on every object of the ArrayList
        foreach($collection as $key => $object) {
            // if the Predicate returns true, then adding the object
            // to the new ArrayList
            if ($predicate->evaluate($object)) {
                $return[$key] = $object;
				// rise the iterator
				$iteration++;
				// if the iterator is equal to the actual iteration number
				// then stop
				if($iteration == $iterations) {
					break;
				}
            }
        }
        // clear all elements and add the filtered
        $collection->clear();
		$collection->addAll($return);
    }

    /**
     * Finds the first element in the given collection which matches
     * the given predicate.
     *
	 * If no element of the collection matches the predicate, null is
	 * returned.
     *
     * @param TechDivision_Collections_Interfaces_Collection $collection
     * 		The collection to search
     * @param TechDivision_Collections_Interfaces_Predicate $predicate
     * 		The predicate to use
     * @return object
     * 		Returns the first element of the collection which matches the
     * 		predicate or null if none could be found
     */
    public static function find(
        TechDivision_Collections_Interfaces_Collection $collection,
        TechDivision_Collections_Interfaces_Predicate $predicate) {
        // iterate over the IndexedCollection and invoke the evaluate()
        // method of the Predicate on every object of the IndexedCollection
        foreach($collection as $object) {
            // if the Predicate returns true, if the predicate returns true
            if ($predicate->evaluate($object)) {
                return $object;
            }
        }
        // return nothing if no object was found
        return;
    }

    /**
     * This method iterates over the passed Collection and invokes the
     * evaluate method of the although passed Predicate on every object
     * of the Collection. If the evaluate method returns true the method
     * returns true also.
     *
     * @param TechDivision_Collections_Interfaces_Collection $collection
     * 		Holds the IndexedCollection that should be filtered
     * @param TechDivision_Collections_Interfaces_Predicate $predicate
     * 		The Predicate that should be used for evaluation purposes
     * @return boolean TRUE if the evaluate method of the Predicate returns TRUE
     */
    public static function exists(
        TechDivision_Collections_Interfaces_Collection $collection,
        TechDivision_Collections_Interfaces_Predicate $predicate) {
        // iterate over the Collection and invoke the evaluate()
        // method of the Predicate on every object of the Collection
        foreach($collection as $object) {
            // if the Predicate returns true, if the predicate returns true
            if ($predicate->evaluate($object)) {
                return true;
            }
        }
        // return false if element is not found
        return false;
    }

    /**
     * This method iterates over the passed Collection and invokes
     * the evaluate method of the although passed Predicate on every object
     * of the Collection. If the evaluate method returns
     * true the method returns the key of the object.
     *
     * @param TechDivision_Collections_Interfaces_Collection $collection
     * 		Holds the Collection that should be filtered
     * @param TechDivision_Collections_Interfaces_Predicate $predicate
     * 		The Predicate that should be used for evaluation purposes
     * @return mixed
     * 		Holds the key of the first object with it's evaluate() method
     * 		returning TRUE
     */
    public static function findKey(
        TechDivision_Collections_Interfaces_Collection $collection,
        TechDivision_Collections_Interfaces_Predicate $predicate) {
        // iterate over the IndexedCollection and invoke the evaluate()
        // method of the Predicate on every object of the Collection
        foreach($collection as $key => $object) {
            // if the Predicate returns true, if the predicate returns true
            if ($predicate->evaluate($object)) {
                return $key;
            }
        }
        // return nothing if no object was evaluated by the predicate
        return;
    }

    /**
     * Returns a new Collection containing a - b. The cardinality of each
     * element e in the returned Collection will be the cardinality of e
     * in a minus the cardinality of e in b, or zero, whichever is greater.
     *
     * @param TechDivision_Collections_Interfaces_Collection $a
     * 		The Collection to subtract from, must not be null
     * @param TechDivision_Collections_Interfaces_Collection $a
     * 		The Collection to subtract, must not be null
     */
    public static function subtract(
        TechDivision_Collections_Interfaces_Collection $a,
        TechDivision_Collections_Interfaces_IndexedCollection $b) {
        // initialize the array with the value to return that should be returned
        $return = array();
        // iterate over the Collection and check if the object exsists in
        // the second Collection
        foreach($a as $key => $element) {
            // if the object does not exsist in the second Collection add
            // it to the return array
            if ($b->exists($key)) {
                $return[$key] = $element;
            }
        }
        // clear all elements and add the subtracted
        $a->clear();
        $a->addAll($return);
    }

    /**
     * This method sorts the passed collection depending
     * on the comparator.
     *
     * @param TechDivision_Collections_Interfaces_Collection $collection
     * 		Holds the Collection that should be sorted
     * @param TechDivision_Collections_Interfaces_Comparator $comparator
     * 		The Comparator that should be used for compare purposes
     */
    public static function sort(
        TechDivision_Collections_Interfaces_Collection $collection,
        TechDivision_Collections_Interfaces_Comparator $comperator) {
        // initialize the ArrayList that should be returned
		// sort the ArrayList
        $return = TechDivision_Collections_CollectionUtils::_arraySort(
            $collection->toArray(),
            0,
            $collection->size(),
            $comperator
        );
        // clear all elements and add the sorted
        $collection->clear();
		$collection->addAll($return);
    }

	/**
	 * Sorts the passed array.
	 *
	 * @param array $src
	 * @param integer $low
	 * @param integer $high
	 * @param TechDivision_Collections_Interfaces_Comparator $comperator
	 * @return array
	 */
    private static function _arraySort(
        $src,
        $low,
        $high,
        TechDivision_Collections_Interfaces_Comparator $comperator) {
		// get the length of the array to sort
		$length = $high - $low;
		// sort the array
	    for($i = $low; $i < $high; $i++) {
			for ($j = $i;
			    ($j > $low) && ($comperator->compare($src[$j-1], $src[$j]) > 0);
			    $j--) {
				$src = TechDivision_Collections_CollectionUtils::_swap(
				    $src,
				    $j,
				    $j - 1
				);
			}
	    }
		// return the sortet array
		return $src;
    }

    /**
     * Swaps x[a] with x[b].
     *
     * @param array $x
     * @param integer $a
     * @param integer $b
     * @return array
     */
    private static function _swap($x, $a, $b)
    {
		$t = $x[$a];
		$x[$a] = $x[$b];
		$x[$b] = $t;
		return $x;
    }
}