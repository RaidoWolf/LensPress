<?php
declare(strict_types=1);
namespace LensPress;

require_once __DIR__.'/Block.php';
require_once __DIR__.'/Receiver.php';

/**
 * A conditional content block that checks whether a receiver evaluates to an
 * exact string value (or not).
 */
class CaseBlock implements Block {

    /**
     * Constructor optionally taking a Receiver, a string to match, whether to
     * negate the check, and/or the value to return when the case is matched.
     * @param Receiver $receiver Receiver to which the condition applies
     * @param string   $match    the string to match against
     * @param boolean  $negate   whether to negate the check
     * @param string   $value    value of the block when the case is matched
     */
    public function __construct (
        Receiver $receiver = null,
        string $match = '',
        bool $negate = false,
        string $value = ''
    ) {

        $this->receiver = $receiver;
        $this->match = $match;
        $this->negate = $negate;
        $this->value = $value;

    }

    /**
     * Getter that returns the Receiver for which the case is checked.
     * @return Receiver Receiver for which the case is checked
     */
    public function getReceiver () : ?Receiver {
        return $this->receiver;
    }

    /**
     * Setter for the Receiver for which the case is checked.
     * @param Receiver $receiver Receiver for which the case is checked
     */
    public function setReceiver (Receiver $receiver) : void {
        $this->receiver = $receiver;
    }

    /**
     * Getter for the string against which the case is matched.
     * @return string string against which the case is matched
     */
    public function getMatch () : string {
        return $this->match;
    }

    /**
     * Setter for the string against which the case is matched.
     * @param string $match string against which the case is matched
     */
    public function setMatch (string $match) : void {
        $this->match = $match;
    }

    /**
     * Check if the case is negated.
     * @return bool whether the case is negated
     */
    public function isNegated () : bool {
        return $this->negate;
    }

    /**
     * Negate the case check.
     */
    public function negate () : void {
        $this->negate = true;
    }

    /**
     * Affirm (to not negate) the case check.
     */
    public function affirm () : void {
        $this->negate = false;
    }

    /**
     * Getter for the value of the block when case matches.
     * @return string value of the block when the case is matched
     */
    public function getValue () : string {
        return $this->value;
    }

    /**
     * Setter for the value of the block when the case matches.
     * @param string $value value of the block when the case is matched
     */
    public function setValue (string $value) : void {
        $this->value = $value;
    }

    /**
     * Output the value string if the case is matched, otherwise return an empty
     * string.
     * @return string the rendered output
     */
    public function render () : string {

        if ($this->receiver !== null) {
            if (
                (!$this->negate && $this->receiver->getValue() == $this->match) ||
                ($this->negate && $this->receiver->getValue() != $this->match)
            ) {
                return $this->value;
            } else {
                return '';
            }
        }

        return '';

    }

    private $receiver = null;

    private $match = '';
    private $negate = false;
    private $value = '';

}
