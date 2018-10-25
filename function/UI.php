<?php
declare(strict_types=1);
namespace LensPress\UI;

function registerParameterConditionalBlock () : void {

    if (!wp_script_is('lenspress_parameterConditionalBlock', 'registered')) {
        wp_register_script(
            'lenspress_parameterConditionalBlock',
            plugins_url('block/parameterConditionalBlock.final.js', __FILE__),
            array('wp-blocks', 'wp-element')
        );
    }

    register_block_type('lenspress/param-condition', [
        'editor-script' => 'lenspress_parameterConditionalBlock'
    ]);

    // register the necessary shortcodes

}
