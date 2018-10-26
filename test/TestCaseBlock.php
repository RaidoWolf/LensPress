<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../class/CaseBlock.php';
require_once __DIR__.'/../class/ParameterReceiver.php';

final class TestCaseBlock extends TestCase {

    public function testDefaultConstructor () : void {

        $block = new \LensPress\CaseBlock();

        $this->assertNull($block->getReceiver());
        $this->assertEquals($block->getMatch(), '');
        $this->assertFalse($block->isNegated());
        $this->assertEquals($block->getValue(), '');
        $this->assertEquals($block->render(), '');

    }

    public function testFullConstructor () : void {

        $block = new \LensPress\CaseBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            'against',
            false,
            'it works'
        );

        $this->assertEquals($block->getReceiver()->getParamName(), 'test');
        $this->assertEquals($block->getMatch(), 'against');
        $this->assertFalse($block->isNegated());
        $this->assertEquals($block->getValue(), 'it works');
        $this->assertEquals($block->render(), '');

        $block = new \LensPress\CaseBlock(
            new \LensPress\ParameterReceiver('test2', true, true, true),
            'against2',
            true,
            'it works2'
        );

        $this->assertEquals($block->getReceiver()->getParamName(), 'test2');
        $this->assertEquals($block->getMatch(), 'against2');
        $this->assertTrue($block->isNegated());
        $this->assertEquals($block->getValue(), 'it works2');
        $this->assertEquals($block->render(), 'it works2');

    }

}
