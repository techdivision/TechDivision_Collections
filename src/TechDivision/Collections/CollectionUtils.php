<?php

/**
 * \TechDivision\Collections\CollectionUtils
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
 * This class implements static methods that can be used
 * to work with Collections.
 *
 * @category Library
 * @package TechDivision_Collections
 * @author Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link https://github.com/techdivision/TechDivision_Collections
 */
class CollectionUtils extends Object
{

    /**
     * Standardconstructor that marks this class as util class.
     */
    private function __construct()
    {
        /* Marks class as utility */
    }

    /**
     * This method iterates over the passed IndexedCollection and invokes the evaluate
     * method of the although passed Predicate on every object of the IndexedCollection.
     * If the evaluate method returns false, the object is removed from the passed
     * IndexedCollection.
     *
     * @param \TechDivision\Collections\Collection $collection
     *            Holds the IndexedCollection that should be filtered
     * @param \TechDivision\Collections\Predicate $predicate
     *            The Predicate that should be used for evaluation purposes
     * @param integer $iterations
     *            Holds the size of successfull interations, after that the filter should run
     *
     * @return void
     */
    public static function filter(Collection $collection, Predicate $predicate, $iterations = 0)
    {
        // initialize the ArrayList that should be returned
        $return = array();
        // initialize the counter for the iterations
        $iteration = 0;
        // iterate over the ArrayList and invoke the evaluate()
        // method of the Predicate on every object of the ArrayList
        foreach ($collection as $key => $object) {
            // if the Predicate returns true, then adding the object
            // to the new ArrayList
            if ($predicate->evaluate($object)) {
                $return[$key] = $object;
                // rise the iterator
                $iteration ++;
                // if the iterator is equal to the actual iteration number
                // then stop
                if ($iteration == $iterations) {
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
     * @param \TechDivision\Collections\Collection $collection
     *            The collection to search
     * @param \TechDivision\Collections\Predicate $predicate
     *            The predicate to use
     *
     * @return object Returns the first element of the collection which matches the predicate or null if none could be found
     */
    public static function find(Collection $collection, Predicate $predicate)
    {
        // iterate over the IndexedCollection and invoke the evaluate()
        // method of the Predicate on every object of the IndexedCollection
        foreach ($collection as $object) {
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
     * of the Collection.
     * If the evaluate method returns true the method
     * returns true also.
     *
     * @param \TechDivision\Collections\Collection $collection
     *            Holds the IndexedCollection that should be filtered
     * @param \TechDivision\Collections\Predicate $predicate
     *            The Predicate that should be used for evaluation purposes
     *
     * @return boolean TRUE if the evaluate method of the Predicate returns TRUE
     */
    public static function exists(Collection $collection, Predicate $predicate)
    {
        // iterate over the Collection and invoke the evaluate()
        // method of the Predicate on every object of the Collection
        foreach ($collection as $object) {
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
     * of the Collection.
     * If the evaluate method returns
     * true the method returns the key of the object.
     *
     * @param \TechDivision\Collections\Collection $collection
     *            Holds the Collection that should be filtered
     * @param \TechDivision\Collections\Predicate $predicate
     *            The Predicate that should be used for evaluation purposes
     *
     * @return mixed Holds the key of the first object with it's evaluate() method returning TRUE
     */
    public static function findKey(Collection $collection, Predicate $predicate)
    {
        // iterate over the IndexedCollection and invoke the evaluate()
        // method of the Predicate on every object of the Collection
        foreach ($collection as $key => $object) {
            // if the Predicate returns true, if the predicate returns true
            if ($predicate->evaluate($object)) {
                return $key;
            }
        }
        // return nothing if no object was evaluated by the predicate
        return;
    }

    /**
     * Returns a new Collection containing a - b.
     * The cardinality of each
     * element e in the returned Collection will be the cardinality of e
     * in a minus the cardinality of e in b, or zero, whichever is greater.
     *
     * @param \TechDivision\Collections\Collection $a
     *            The Collection to subtract from, must not be null
     * @param \TechDivision\Collections\Collection $a
     *            The Collection to subtract, must not be null
     *
     * @return void
     */
    public static function subtract(Collection $a, IndexedCollection $b)
    {
        // initialize the array with the value to return that should be returned
        $return = array();
        // iterate over the Collection and check if the object exsists in
        // the second Collection
        foreach ($a as $key => $element) {
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
     * @param \TechDivision\Collections\Collection $collection
     *            Holds the Collection that should be sorted
     * @param \TechDivision\Collections\Comparator $comparator
     *            The Comparator that should be used for compare purposes
     *
     * @return void
     */
    public static function sort(Collection $collection, Comparator $comperator)
    {
        // initialize the ArrayList that should be returned
        // sort the ArrayList
        $return = CollectionUtils::_arraySort($collection->toArray(), 0, $collection->size(), $comperator);
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
     * @param \TechDivision\Collections\Comparator $comperator
     *
     * @return array
     */
    private static function _arraySort($src, $low, $high, Comparator $comperator)
    {
        // get the length of the array to sort
        $length = $high - $low;
        // sort the array
        for ($i = $low; $i < $high; $i ++) {
            for ($j = $i; ($j > $low) && ($comperator->compare($src[$j - 1], $src[$j]) > 0); $j --) {
                $src = CollectionUtils::_swap($src, $j, $j - 1);
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
     *
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
