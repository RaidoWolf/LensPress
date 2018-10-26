<?php
declare(strict_types=1);
namespace LensPress;

/**
 * Interface representing any content replacement block in the plugin.
 */
interface Block {

    /**
     * Render an output string by passing the input string through an
     * implementation-dependent render procedure.
     * @return string output value
     */
    public function render () : string;

};
