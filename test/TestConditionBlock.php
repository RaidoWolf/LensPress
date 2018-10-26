<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../class/ConditionBlock.php';
require_once __DIR__.'/../class/ParameterReceiver.php';

final class TestConditionBlock extends TestCase {

    public function testDefaultConstructor () : void {

        $block = new \LensPress\ConditionBlock();

        $this->assertNull($block->getReceiver());
        $this->assertFalse($block->isNegated());
        $this->assertEquals($block->getValue(), '');
        $this->assertEquals($block->render(), '');

    }

    public function testFullConstructor () : void {

        $block = new \LensPress\ConditionBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            false,
            'it works'
        );

        $this->assertEquals($block->getReceiver()->getParamName(), 'test');
        $this->assertFalse($block->isNegated());
        $this->assertEquals($block->getValue(), 'it works');
        $this->assertEquals($block->render(), '');

        $block = new \LensPress\ConditionBlock(
            new \LensPress\ParameterReceiver('test2', true, true, true),
            true,
            'it works2'
        );

        $this->assertEquals($block->getReceiver()->getParamName(), 'test2');
        $this->assertTrue($block->isNegated());
        $this->assertEquals($block->getValue(), 'it works2');
        $this->assertEquals($block->render(), 'it works2');

    }

}
