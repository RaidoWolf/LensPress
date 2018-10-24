<?php
declare(strict_types=1);
namespace LensPress;

require_once __DIR__.'/Block.php';

/**
 * A content replacement block with only two possible states: true and false.
 */
class ConditionalBlock implements Block {

    /**
     * Constructor taking in optional strings for the block's value during true
     * and false conditions respectively.
     * @param string $valueTrue  value of the block when condition is true
     * @param string $valueFalse value of the block when condition is false
     */
    public function __construct (string $valueTrue = '', string $valueFalse = '') {
        $this->valueTrue = $valueTrue;
        $this->valueFalse = $valueFalse;
    }

    /**
     * Getter for the value of the block when the condition is true.
     * @return string value of the block when the condition is true
     */
    public function getValueTrue () : string {
        return $this->valueTrue;
    }

    /**
     * Setter for the value of the block when the condition is true.
     * @param string $value value of the block when the condition is true
     */
    public function setValueTrue (string $value) : void {
        $this->valueTrue = $value;
    }

    /**
     * Getter for the value of the block when the condition is false.
     * @return string value of the block when the condition is false
     */
    public function getValueFalse () : string {
        return $this->valueFalse;
    }

    /**
     * Setter for the value of the block when the condition is false.
     * @param string $value value of the block when the condition is false
     */
    public function setValueFalse (string $value) : void {
        $this->valueFalse = $value;
    }

    /**
     * Get the value of the block, given a boolean condition.
     * @param  bool   $condition condition to apply to the block
     * @return string            the value of the block, according to the condition
     */
    public function getValue (bool $condition) : string {

        if ($condition) {
            return $this->getValueTrue();
        } else {
            return $this->getValueFalse();
        }

    }

    private $valueTrue = '';
    private $valueFalse = '';

}
