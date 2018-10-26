<?php
declare(strict_types=1);
namespace LensPress;

/**
 * An interface representing an object capable of finding or receiving some kind
 * of data, and then telling you: if it is defined, if it is "true", and a
 * string representation of what it is.
 */
interface Receiver {

    /**
     * Determine if the data that the receiver can see exists or is defined.
     * @return bool if the data exists or is defined
     */
    public function isDefined () : bool;

    /**
     * Determine if the data that the receiver can see evaluates to true. The
     * meaning of true vs. false is implementation dependent, but generally will
     * mean that the data is both defined, and not "empty".
     * @return bool implementation choice, but usually whether the data is defined and non-empty
     */
    public function isTrue () : bool;

    /**
     * Get the string representation of whatever data the receiver is watching.
     * Can also return null, which is indicative of a failure to get any
     * meaningful value.
     * @return string the string representation of the data
     */
    public function getValue () : ?string;

}
