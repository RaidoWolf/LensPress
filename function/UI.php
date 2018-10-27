<?php
declare(strict_types=1);
namespace LensPress\UI;

const SCRIPT_PARAMETER_CONDITION = 'lenspress-parameter-condition';
const SCRIPT_PARAMETER_CASE = 'lenspress-parameter-case';

const BLOCK_PARAMETER_CONDITION = 'lenspress/param-condition';
const BLOCK_PARAMETER_CASE = 'lenspress/param-case';

/**
 * Register all of the blocks with the Gutenberg editor. This is just a shortcut
 * to registering them each manually.
 */
function registerAllBlocks () : void {

    registerParameterConditionBlock();
    registerParameterCaseBlock();

}

/**
 * Register the Parameter Condition block with the Gutenberg editor.
 */
function registerParameterConditionBlock () : void {

    if (!function_exists('register_block_type')) {
        return;
    }

    wp_register_script(
        SCRIPT_PARAMETER_CONDITION,
        plugins_url('block/ParameterCondition.final.js', __DIR__),
        ['wp-blocks', 'wp-element', 'wp-i18n', 'wp-editor', 'wp-components'],
        (string) filemtime(plugin_dir_path(__DIR__.'/../block/ParameterCondition.final.js'))
    );

    register_block_type(BLOCK_PARAMETER_CONDITION, [
        'editor_script' => SCRIPT_PARAMETER_CONDITION,
        'render_callback' => '\\LensPress\\Renderer\\renderParameterCondition'
    ]);

}

/**
 * Register the Parameter Case block with the Gutenberg editor.
 */
function registerParameterCaseBlock () : void {

    if (!function_exists('register_block_type')) {
        return;
    }

    wp_register_script(
        SCRIPT_PARAMETER_CASE,
        plugins_url('block/ParameterCase.final.js', __DIR__),
        ['wp-blocks', 'wp-element', 'wp-i18n', 'wp-editor', 'wp-components'],
        (string) filemtime(plugin_dir_path(__DIR__.'/../block/ParameterCase.final.js'))
    );

    register_block_type(BLOCK_PARAMETER_CASE, [
        'editor_script' => SCRIPT_PARAMETER_CASE,
        'render_callback' => '\\LensPress\\Renderer\\renderParameterCase'
    ]);

}
