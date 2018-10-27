<?php
declare(strict_types=1);
namespace LensPress\Renderer;

require_once __DIR__.'/../class/CaseBlock.php';
require_once __DIR__.'/../class/ConditionBlock.php';
require_once __DIR__.'/../class/ParameterReceiver.php';

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

    add_shortcode(SHORTCODE_PARAMETER_CONDITION, __NAMESPACE__.'\\renderParameterCondition');

}

/**
 * Render the [lenspress-param-condition] shortcode.
 * @param  array  $atts    attributes on the shortcode instance
 * @param  string $content content of the shortcode instance
 * @return string          rendered output
 */
function renderParameterCondition (array $atts, string $content = '') : string {

    if ($content === null || $content == '') {
        return ''; // no content in, no content out
    }

    $block = new \LensPress\ConditionBlock(
        new \LensPress\ParameterReceiver((string) (array_key_exists('paramName', $atts) ? $atts['paramName'] : 'hidden'),
            (bool) (array_key_exists('enableUrl', $atts) ? $atts['enableUrl'] : true),
            (bool) (array_key_exists('enablePost', $atts) ? $atts['enablePost'] : true),
            (bool) (array_key_exists('enableCookie', $atts) ? $atts['enableCookie'] : true)
        ),
        (bool) (array_key_exists('negate', $atts) ? $atts['negate'] : false),
        (string) ($content !== null ? $content : '')
    );

    return do_shortcode($block->render());

}

/**
 * Register the shortcode [lenspress-param-case].
 */
function registerParameterCaseShortcode () : void {

    add_shortcode(SHORTCODE_PARAMETER_CASE, __NAMESPACE__.'\\renderParameterCase');

}

/**
 * Render the [lenspress-param-case] shortcode.
 * @param  array  $atts    attributes on the shortcode instance
 * @param  string $content content of the shortcode instance
 * @return string          rendered output
 */
function renderParameterCase (array $atts, string $content = '') : string {

    if ($content === null || $content == '') {
        return ''; // no content in, no content out
    }

    $block = new \LensPress\CaseBlock(
        new \LensPress\ParameterReceiver((string) (array_key_exists('paramName', $atts) ? $atts['paramName'] : 'hidden'),
            (bool) (array_key_exists('enableUrl', $atts) ? $atts['enableUrl'] : true),
            (bool) (array_key_exists('enablePost', $atts) ? $atts['enablePost'] : true),
            (bool) (array_key_exists('enableCookie', $atts) ? $atts['enableCookie'] : true)
        ),
        (string) (array_key_exists('match', $atts) ? $atts['match'] : ''),
        (bool) (array_key_exists('negate', $atts) ? $atts['negate'] : false),
        (string) ($content !== null ? $content : '')
    );

    return do_shortcode($block->render());

}
