<?php
declare(strict_types=1);
namespace LensPress;

require_once __DIR__.'/Receiver.php';

class ParameterReceiver implements Receiver {

    /**
     * Constructor optionally taking the name of a parameter to watch, and
     * whether to enable the checking of GET (url), POST, and COOKIE parameters.
     * @param string  $paramName     the name of the parameter to watch
     * @param boolean $urlEnabled    whether to enable GET (url) parameters
     * @param boolean $postEnabled   whether to enable POST parameters
     * @param boolean $cookieEnabled whether to enable COOKIE parameters
     */
    public function __construct (
        string $paramName = null,
        bool $urlEnabled = true,
        bool $postEnabled = true,
        bool $cookieEnabled = true
    ) {

        $this->paramName = $paramName;
        $this->urlEnabled = $urlEnabled;
        $this->postEnabled = $postEnabled;
        $this->cookieEnabled = $cookieEnabled;

    }

    /**
     * Getter for the name of the parameter to watch.
     * @return string name of the parameter to watch
     */
    public function getParamName () : ?string {
        return $this->paramName;
    }

    /**
     * Setter for the name of the parameter to watch.
     * @param string $paramName name of the parameter to watch
     */
    public function setParamName (string $paramName) : void {
        $this->paramName = $paramName;
    }

    /**
     * Check if URL/GET parameters are enabled.
     * @return bool whether URL/GET parameters are enabled
     */
    public function urlIsEnabled () : bool {
        return $this->urlEnabled;
    }

    /**
     * Enable URL/GET parameters.
     */
    public function enableUrl () : void {
        $this->urlEnabled = true;
    }

    /**
     * Disable URL/GET parameters.
     */
    public function disableUrl () : void {
        $this->urlEnabled = false;
    }

    /**
     * Check if POST parameters are enabled.
     * @return bool whether post parameters are enabled
     */
    public function postIsEnabled () : bool {
        return $this->postEnabled;
    }

    /**
     * Enable POST parameters.
     */
    public function enablePost () : void {
        $this->postEnabled = true;
    }

    /**
     * Disable POST parameters.
     */
    public function disablePost () : void {
        $this->postEnabled = false;
    }

    /**
     * Check if COOKIE parameters are enabled.
     * @return bool whether COOKIE parameters are enabled
     */
    public function cookieIsEnabled () : bool {
        return $this->cookieEnabled;
    }

    /**
     * Enable COOKIE parameters.
     */
    public function enableCookie () : void {
        $this->cookieEnabled = true;
    }

    /**
     * Disable COOKIE parameters.
     */
    public function disableCookie () : void {
        $this->cookieEnabled = false;
    }

    /**
     * Check if the watched parameter is defined anywhere.
     * @return bool whether the watched parameter is defined anywhere
     */
    public function isDefined () : bool {

        if (empty($this->paramName)) {
            return false;
        }

        if ($this->urlEnabled) {
            if (array_key_exists($this->paramName, $_GET)) {
                return true;
            }
        }

        if ($this->postEnabled) {
            if (array_key_exists($this->paramName, $_POST)) {
                return true;
            }
        }

        if ($this->cookieEnabled) {
            if (array_key_exists($this->paramName, $_COOKIE)) {
                return true;
            }
        }

        return false;

    }

    /**
     * Check if the watched parameter is defined and evaluates to true.
     * @return bool whether the watched parameter evaluates to true
     */
    public function isTrue () : bool {

        return $this->getValue() && true; // using PHP's evaluation of whether string is true, which means anything except "" or "0".

    }

    /**
     * If the watched parameter is defined, return the value as a string. If not
     * defined, return null.
     * @return string the value of the watched parameter
     */
    public function getValue () : ?string {

        if (empty($this->paramName)) {
            return null;
        }

        if ($this->urlEnabled) {
            if (array_key_exists($this->paramName, $_GET)) {
                return $_GET[$this->paramName];
            }
        }

        if ($this->postEnabled) {
            if (array_key_exists($this->paramName, $_POST)) {
                return $_POST[$this->paramName];
            }
        }

        if ($this->cookieEnabled) {
            if (array_key_exists($this->paramName, $_COOKIE)) {
                return $_COOKIE[$this->paramName];
            }
        }

        return null;

    }

    private $paramName = null;
    private $urlEnabled = true;
    private $postEnabled = true;
    private $cookieEnabled = true;

}
