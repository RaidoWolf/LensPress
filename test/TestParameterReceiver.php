<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../class/ParameterReceiver.php';

final class TestParameterReceiver extends TestCase {

    public function testDefaultConstructor () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $receiver = new \LensPress\ParameterReceiver();

        $this->assertFalse($receiver->isDefined());
        $this->assertFalse($receiver->isTrue());
        $this->assertEquals($receiver->getValue(), '');

        $this->assertNull($receiver->getParamName());
        $this->assertTrue($receiver->urlIsEnabled());
        $this->assertTrue($receiver->postIsEnabled());
        $this->assertTrue($receiver->cookieIsEnabled());

    }

    public function testFullConstructor () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $receiver = new \LensPress\ParameterReceiver('test', true, true, true);

        $this->assertEquals($receiver->getParamName(), 'test');
        $this->assertTrue($receiver->urlIsEnabled());
        $this->assertTrue($receiver->postIsEnabled());
        $this->assertTrue($receiver->cookieIsEnabled());

        $receiver = new \LensPress\ParameterReceiver('test', false, false, false);

        $this->assertEquals($receiver->getParamName(), 'test');
        $this->assertFalse($receiver->urlIsEnabled());
        $this->assertFalse($receiver->postIsEnabled());
        $this->assertFalse($receiver->cookieIsEnabled());

    }

    public function testGetWithAllEnabled () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = 'it works';
        $receiver = new \LensPress\ParameterReceiver('test', true, true, true);

        $this->assertTrue($receiver->isDefined());
        $this->assertTrue($receiver->isTrue());
        $this->assertEquals($receiver->getValue(), 'it works');

    }

    public function testPostWithAllEnabled () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_POST['test'] = 'it works';
        $receiver = new \LensPress\ParameterReceiver('test', true, true, true);

        $this->assertTrue($receiver->isDefined());
        $this->assertTrue($receiver->isTrue());
        $this->assertEquals($receiver->getValue(), 'it works');

    }

    public function testCookieWithAllEnabled () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_COOKIE['test'] = 'it works';
        $receiver = new \LensPress\ParameterReceiver('test', true, true, true);

        $this->assertTrue($receiver->isDefined());
        $this->assertTrue($receiver->isTrue());
        $this->assertEquals($receiver->getValue(), 'it works');

    }

    public function testGetWithSelfDisabled () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = 'it works';
        $receiver = new \LensPress\ParameterReceiver('test', false, true, true);

        $this->assertFalse($receiver->isDefined());
        $this->assertFalse($receiver->isTrue());
        $this->assertNull($receiver->getValue());

    }

    public function testPostWithSelfDisabled () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_POST['test'] = 'it works';
        $receiver = new \LensPress\ParameterReceiver('test', true, false, true);

        $this->assertFalse($receiver->isDefined());
        $this->assertFalse($receiver->isTrue());
        $this->assertNull($receiver->getValue());

    }

    public function testCookieWithSelfDisabled () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_COOKIE['test'] = 'it works';
        $receiver = new \LensPress\ParameterReceiver('test', true, true, false);

        $this->assertFalse($receiver->isDefined());
        $this->assertFalse($receiver->isTrue());
        $this->assertNull($receiver->getValue());

    }

    public function testValueOverride () : void {

        $_GET = [];
        $_POST = [];
        $_COOKIE = [];

        $_GET['test'] = 'get';
        $_POST['test'] = 'post';
        $_COOKIE['test'] = 'cookie';

        $receiver = new \LensPress\ParameterReceiver('test', true, true, true);

        $this->assertTrue($receiver->isDefined());
        $this->assertTrue($receiver->isTrue());
        $this->assertEquals($receiver->getValue(), 'get');

        $receiver = new \LensPress\ParameterReceiver('test', false, true, true);

        $this->assertTrue($receiver->isDefined());
        $this->assertTrue($receiver->isTrue());
        $this->assertEquals($receiver->getValue(), 'post');

        $receiver = new \LensPress\ParameterReceiver('test', false, false, true);

        $this->assertTrue($receiver->isDefined());
        $this->assertTrue($receiver->isTrue());
        $this->assertEquals($receiver->getValue(), 'cookie');

    }

}
