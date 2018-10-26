<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../class/CaseBlock.php';
require_once __DIR__.'/../class/ParameterReceiver.php';

final class TestCaseBlock extends TestCase {

    public function testDefaultConstructor () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $block = new \LensPress\CaseBlock();

        $this->assertNull($block->getReceiver());
        $this->assertEquals($block->getMatch(), '');
        $this->assertFalse($block->isNegated());
        $this->assertEquals($block->getValue(), '');
        $this->assertEquals($block->render(), '');

    }

    public function testFullConstructor () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

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

    public function testMatchGet () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = 'this is a match';

        $block = new \LensPress\CaseBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            'this is a match',
            false,
            'it works'
        );

        $this->assertEquals($block->render(), 'it works');

    }

    public function testMatchPost () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_POST['test'] = 'this is a match';

        $block = new \LensPress\CaseBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            'this is a match',
            false,
            'it works'
        );

        $this->assertEquals($block->render(), 'it works');

    }

    public function testMatchCookie () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = 'this is a match';

        $block = new \LensPress\CaseBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            'this is a match',
            false,
            'it works'
        );

        $this->assertEquals($block->render(), 'it works');

    }

    public function testFailedMatch () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = 'this is (not) a match';

        $block = new \LensPress\CaseBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            'this is a match',
            false,
            'it works'
        );

        $this->assertEquals($block->render(), '');

    }

    public function testInverseMatch () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = 'this is a match';

        $block = new \LensPress\CaseBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            'this is a match',
            true,
            'it works'
        );

        $this->assertEquals($block->render(), '');

    }

    public function testInverseFailedMatch () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = 'this is (not) a match';

        $block = new \LensPress\CaseBlock(
            new \LensPress\ParameterReceiver('test', true, true, true),
            'this is a match',
            true,
            'it works'
        );

        $this->assertEquals($block->render(), 'it works');

    }

}
