<?php
declare(strict_types=1);
namespace LensPress;

require_once __DIR__.'/Block.php';
require_once __DIR__.'/Receiver.php';

/**
 * A conditional content block that checks whether a receiver evaluates to true
 * or false.
 */
class ConditionBlock implements Block {

    /**
     * Constructor optionally taking a Receiver, whether to negate the check,
     * and/or the value to return when the condition is met.
     * @param Receiver $receiver Receiver to which the condition applies
     * @param bool     $negate   whether to negate the check
     * @param string   $value    value of the block when condition is met
     */
    public function __construct (
        Receiver $receiver = null,
        bool $negate = false,
        string $value = ''
    ) {

        $this->receiver = $receiver;
        $this->negate = $negate;
        $this->value = $value;

    }

    /**
     * Getter that returns the Receiver against which the condition is checked.
     * @return Receiver Receiver against which the condition is checked
     */
    public function getReceiver () : ?Receiver {
        return $this->receiver;
    }

    /**
     * Setter for the Receiver against which the condition is checked.
     * @param Receiver $receiver Receiver against which the condition is checked
     */
    public function setReceiver (Receiver $receiver) : void {
        $this->receiver = $receiver;
    }

    /**
     * Check if the condition is negated.
     * @return bool whether the condition is negated
     */
    public function isNegated () : bool {
        return $this->negate;
    }

    /**
     * Negate the condition check.
     */
    public function negate () : void {
        $this->negate = true;
    }

    /**
     * Affirm (to not negate) the condition check.
     */
    public function affirm () : void {
        $this->negate = false;
    }

    /**
     * Getter for the value of the block when condition is met.
     * @return string value of the block when the condition is met
     */
    public function getValue () : string {
        return $this->value;
    }

    /**
     * Setter for the value of the block when the condition is met.
     * @param string $value value of the block when the condition is true
     */
    public function setValue (string $value) : void {
        $this->value = $value;
    }

    /**
     * Output the value string if the condition is met, otherwise return an
     * empty string.
     * @return string the rendered output
     */
    public function render () : string {

        if ($this->receiver !== null) {
            if (
                (!$this->negate && $this->receiver->isTrue()) ||
                ($this->negate && !$this->receiver->isTrue())
            ) {
                return $this->value;
            } else {
                return '';
            }
        }

        return '';

    }

    private $receiver = null;

    private $value = '';
    private $negate = false;

}
