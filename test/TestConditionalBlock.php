<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__."/../class/ConditionalBlock.php";

final class TestConditionalBlock extends TestCase {

    public function testConstructTrueCondition () : void {
        $block = new LensPress\ConditionalBlock("true", "false");
        $this->assertEquals("true", $block->getValue(true));
    }

    public function testSetterTrueCondition () : void {
        $block = new LensPress\ConditionalBlock();
        $block->setValueTrue("true");
        $block->setValueFalse("false");
        $this->assertEquals("true", $block->getValue(true));
    }

    public function testConstructFalseCondition () : void {
        $block = new LensPress\ConditionalBlock("true", "false");
        $this->assertEquals("false", $block->getValue(false));
    }

    public function testSetterFalseCondition () : void {
        $block = new LensPres\ConditionalBlock();
        $block->setValueTrue("true");
        $block->setValueFalse("false");
        $this->assertEquals("false", $block->getValue(false));
    }

}
