<?php
declare(strict_types=1);

/**
 * Plugin Name: LensPress
 * Plugin URI: https://github.com/aebarber/LensPress
 * Description: A WordPress Gutenberg editor plugin for conditional content
 * Version: 0.1.0
 * Author: Danger Interactive LLC
 */

require_once __DIR__.'/metadata.php';
require_once __DIR__.'/function/Util.php';

LensPress\Meta\requireWordpressPlugin('Gutenberg', 'Gutenberg/gutenberg.php');

// TODO: register blocks for gutenberg.

// TODO: register shortcodes that the gutenberg blocks will produce.
