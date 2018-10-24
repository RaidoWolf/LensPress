<?php
declare(strict_types=1);
namespace LensPress;

require_once __DIR__."/Block.php";

class ConditionalBlock implements Block {

    public function __construct (string $valueTrue = "", string $valueFalse = "") {
        $this->valueTrue = $valueTrue;
        $this->valueFalse = $valueFalse;
    }

    public function getValueTrue () : string {
        return $this->valueTrue;
    }

    public function setValueTrue (string $value) : void {
        $this->valueTrue = $value;
    }

    public function getValueFalse () : string {
        return $this->valueFalse;
    }

    public function setValueFalse (string $value) : void {
        $this->valueFalse = $value;
    }

    public function getValue (bool $condition) : string {

        if ($condition) {
            return $this->getValueTrue();
        } else {
            return $this->getValueFalse();
        }

    }

    private $valueTrue = "";
    private $valueFalse = "";

}
