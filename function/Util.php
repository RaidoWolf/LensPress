<?php
declare(strict_types=1);
namespace LensPress\Util;

/**
 * Declare a dependency on a specific plugin, and optionally a minimum version.
 * If the dependency is not met, the administrator will be notified and
 * LensPress deactivated. (specific to LensPress, must be modified to use in any
 * other plugins)
 * @param string $name       name of the plugin to be required
 * @param string $path       path of the plugin file to be required (the base PHP file)
 * @param string $textDomain optional text domain for translation of warnings
 * @param string $version    optional minimum version number of the required plugin
 */
function requireWordpressPlugin (
    string $name,
    string $path,
    string $textDomain = '',
    string $version = null
) : void {

    require_once __DIR__.'/../metadata.php'; // need NAME constant.
    require_once ABSPATH.'wp-admin/includes/plugin.php'; // need "deactivate_plugins" function

    if (!is_plugin_active($path)) {
        deactivate_plugins(plugin_basename(__FILE__)); // deactivate self
        notifyFailedPluginDependency($name, $textDomain); // notify failure
    } else {
        if ($version !== null) {
            // check if minimum version is met
            $dependencyData = get_plugin_data(WP_PLUGIN_DIR.'/'.$path);
            $error = !version_compare($dependencyData['Version'], $version, '>=') ? true : false;
            if ($error) {
                deactivate_plugins(plugin_basename(__FILE__)); // deactivate self
                notifyFailedPluginDependencyVersion($name, $version, $textDomain); // notifyFailure
            }
        }
    }

}

/**
 * Notify the admin of a failed dependency requirement. This means the plugin is
 * not found at all.
 * @param string $name       name of the required plugin
 * @param string $textDomain text domain for translation of warning message
 */
function notifyFailedPluginDependency (string $name, string $textDomain) : void {

    add_action('admin_notices', function () use ($name, $textDomain) {
?>
        <div class="updated error">
            <p>
<?php
                echo sprintf(
                    __('The plugin <strong>"%s"</strong> requires the plugin <strong>"%s"</strong> to be active', $textDomain),
                    Meta\NAME, $name
                );
?>
                <br />
<?php
                echo sprintf(
                    __('<strong>%s has been deactivated</strong>', $textdomain),
                    Meta\NAME
                );
?>
            </p>
        </div>
<?php

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

    } );

}

/**
 * Notify the admin of a failed dependency version requirement. This means the
 * plugin was found, but it was of a lower version than was required.
 * @param string $name       name of the required plugin
 * @param string $version    required version of the plugin
 * @param string $textDomain text domain for translation of warning message
 */
function notifyFailedPluginDependencyVersion (string $name, string $version, string $textDomain) : void {

    add_action('admin_notices', function () use ($name, $version, $textdomain) {
?>
        <div class="updated error">
            <p>
<?php
                echo sprintf(
                    __('The plugin <strong>"%s"</strong> requires the <strong>version %s</strong> or newer of <strong>"%s"</strong>', $textdomain),
                    Meta\NAME,
                    $version,
                    $name
                );
?>
                <br />
<?php
                echo sprintf(
                    __('<strong>%s has been deactivated</strong>', $textdomain),
                    Meta\NAME
                );
?>
            </p>
        </div>
<?php

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

    } );

}
