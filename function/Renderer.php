<?php
declare(strict_types=1);
namespace LensPress\Renderer;

const SHORTCODE_PARAMETER_CONDITION = "lenspress-param-condition";
const SHORTCODE_PARAMETER_CASE = "lenspress-param-case";

/**
 * Register all of the rendering shortcodes (just a shortcut for doint them all
 * separately).
 */
function registerAllShortcodes () : void {

    registerParameterConditionShortcode();
    registerParameterCaseShortcode();

}

/**
 * Register the shortcode [lenspress-param-condition].
 */
function registerParameterConditionShortcode () : void {

    add_shortcode(SHORTCODE_PARAMETER_CONDITION, __NAMESPACE__.'\\renderParameterConditionShortcode');

}

/**
 * Render the [lenspress-param-condition] shortcode.
 * @param  array  $atts    attributes on the shortcode instance
 * @param  string $content content of the shortcode instance
 * @return string          rendered output
 */
function renderParameterConditionShortcode (array $atts, string $content = null) : string {

    if ($content === null || $content == '') {
        return ''; // no content in, no content out
    }

    if (!array_key_exists('param', $atts)) {
        return ''; // no valid parameter
    }

    $block = new \LensPress\ParameterConditionBlock();

}

/**
 * Register the shortcode [lenspress-param-case].
 */
function registerParameterCaseShortcode () : void {

    add_shortcode(SHORTCODE_PARAMETER_CASE, __NAMESPACE__.'\\renderParameterCaseShortcode');

}

/**
 * Render the [lenspress-param-case] shortcode.
 * @param  array  $atts    attributes on the shortcode instance
 * @param  string $content content of the shortcode instance
 * @return string          rendered output
 */
function renderParameterCaseShortcode (array $atts, string $content = null) : string {

    if ($content === null || $content == '') {
        return ''; // no content in, no content out
    }

}
