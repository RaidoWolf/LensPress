<?php
declare(strict_types=1);
namespace LensPress;

class ParameterConditionalBlock extends ConditionalBlock {

    public function __construct (
        string $paramName = "",
        bool $urlEnabled = false,
        bool $postEnabled = false,
        bool $cookieEnabled = false,
        string $valueTrue = "",
        string $valueFalse = ""
    ) {

        $this->paramName = $paramName;
        $this->urlEnabled = $urlEnabled;
        $this->postEnabled = $postEnabled;
        $this->cookieEnabled = $cookieEnabled;

        parent::__construct($valueTrue, $valueFalse);

    }

    public function getParamName () : string {
        return $this->paramName;
    }

    public function setParamName (string $name) : void {
        $this->paramName = $name;
    }

    public function urlIsEnabled () : bool {
        return $this->urlEnabled;
    }

    public function enableUrl () : void {
        $this->urlEnabled = true;
    }

    public function disableUrl () : void {
        $this->urlEnabled = false;
    }

    public function postIsEnabled () : bool {
        return $this->postEnabled;
    }

    public function enablePost () : void {
        $this->postEnabled = true;
    }

    public function disablePost () : void {
        $this->postEnabled = false;
    }

    public function cookieIsEnabled () : bool {
        return $this->cookieEnabled;
    }

    public function enableCookie () : void {
        $this->cookieEnabled = true;
    }

    public function disableCookie () : void {
        $this->cookieDisabled = false;
    }

    public function getValue () : string {

        // check URL parameters
        if ($urlEnabled && array_key_exists($paramName, $_GET)) {
            return parent::getValue($_GET[$paramName]);
        }

        // check POST parameters
        if ($postEnabled && array_key_exists($paramName, $_POST)) {
            return parent::getValue($_POST[$paramName]);
        }

        // check cookie parameters
        if ($cookieEnabled && array_key_exists($paramName, $_COOKIE)) {
            return parent::getValue($_COOKIE[$paramName]);
        }

        // if the value isn't defined anywhere, assume false
        return parent::getValueFalse();

    }

    private $paramName = "";
    private $urlEnabled = false;
    private $postEnabled = false;
    private $cookieEnabled = false;

}
