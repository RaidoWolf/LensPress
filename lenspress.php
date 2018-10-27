<?php
declare(strict_types=1);
namespace LensPress\EntryPoint;

/**
 * Plugin Name: LensPress
 * Plugin URI: https://github.com/aebarber/LensPress
 * Description: A WordPress Gutenberg editor plugin for conditional content
 * Version: 1.0.0
 * Author: Alexander Barber
 */

require_once __DIR__.'/metadata.php';
require_once __DIR__.'/function/Renderer.php';
require_once __DIR__.'/function/UI.php';
require_once __DIR__.'/function/Util.php';

/**
 * Ensure that all LensPress dependencies are met before allowing activation.
 */
function ensureDependencies () : void {
    \LensPress\Util\requireWordpressPlugin('Gutenberg', 'gutenberg/gutenberg.php');
}

// Check dependencies during appropriate hooks.
register_activation_hook(__FILE__, __NAMESPACE__.'\\ensureDependencies');
register_deactivation_hook(WP_PLUGIN_DIR.'/gutenberg/gutenberg.php', __NAMESPACE__.'\\ensureDependencies');

// Initialize all shortcodes, which are an alternative to the visual editor.
add_action('init', '\\LensPress\\Renderer\\registerAllShortcodes');

// Initialize all Gutenberg blocks, which is the content editor.
add_action('init', '\\LensPress\\UI\\registerAllBlocks');
