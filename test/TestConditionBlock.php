<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../class/ConditionBlock.php';
require_once __DIR__.'/../class/ParameterReceiver.php';

final class TestConditionBlock extends TestCase {

    public function testDefaultConstructor () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $block = new \LensPress\ConditionBlock();

        $this->assertNull($block->getReceiver());
        $this->assertFalse($block->isNegated());
        $this->assertEquals($block->getValue(), '');
        $this->assertEquals($block->render(), '');

    }

    public function testFullConstructor () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

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

    public function testTrueConditionGet () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = '1';

        $block = new \LensPress\ConditionBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            false,
            'it works'
        );

        $this->assertEquals($block->render(), 'it works');

    }

    public function testTrueConditionPost () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_POST['test'] = '1';

        $block = new \LensPress\ConditionBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            false,
            'it works'
        );

        $this->assertEquals($block->render(), 'it works');

    }

    public function testTrueConditionCookie () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_COOKIE['test'] = '1';

        $block = new \LensPress\ConditionBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            false,
            'it works'
        );

        $this->assertEquals($block->render(), 'it works');

    }

    public function testFalseTrueCondition () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = 'false';

        $block = new \LensPress\ConditionBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            false,
            'it works'
        );

        $this->assertEquals($block->render(), 'it works');

    }

    public function testZeroFalseCase () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = '0';

        $block = new \LensPress\ConditionBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            false,
            'it works'
        );

        $this->assertEquals($block->render(), '');

    }

    public function testEmptyFalseCase () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = '';

        $block = new \LensPress\ConditionBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            false,
            'it works'
        );

        $this->assertEquals($block->render(), '');

    }

    public function testInverseTrueCase () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = 'true';

        $block = new \LensPress\ConditionBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            true,
            'it works'
        );

        $this->assertEquals($block->render(), '');

    }

    public function testInverseFalseCase () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = '0';

        $block = new \LensPress\ConditionBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            true,
            'it works'
        );

        $this->assertEquals($block->render(), 'it works');

    }

}
