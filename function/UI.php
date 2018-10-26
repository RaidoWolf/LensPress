<?php
declare(strict_types=1);
namespace LensPress\UI;

const SCRIPT_PARAMETER_CONDITION = 'lenspress_parameterConditionalBlock';
const SCRIPT_PARAMETER_CASE = 'lenspress_parameterCaseBlock';

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

    if (!wp_script_is(SCRIPT_PARAMETER_CONDITION, 'registered')) {
        wp_register_script(
            SCRIPT_PARAMETER_CONDITION,
            plugins_url('block/parameterConditionalBlock.final.js', __FILE__),
            array('wp-blocks', 'wp-element')
        );
    }

    register_block_type(BLOCK_PARAMETER_CONDITION, [
        'editor-script' => SCRIPT_PARAMETER_CONDITION
    ]);

}

/**
 * Register the Parameter Case block with the Gutenberg editor.
 */
function registerParameterCaseBlock () : void {

    if (!wp_script_is(SCRIPT_PARAMETER_CASE, 'registered')) {
        wp_register_script(
            SCRIPT_PARAMETER_CASE,
            plugins_url('block/parameterCaseBlock.final.js', __FILE__),
            array('wp-blocks', 'wp-elements')
        );
    }

    register_block_type(BLOCK_PARAMETER_CONDITION, [
        'editor-script' => SCRIPT_PARAMETER_CASE
    ]);

}
