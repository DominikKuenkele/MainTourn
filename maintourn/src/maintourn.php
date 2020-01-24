<?php

namespace Maintourn;

/**
 * The plugin bootstrap file
 *
 *
 * @since             1.0.0
 * @package           Maintourn
 *
 * @wordpress-plugin
 * Plugin Name:       Maintourn
 * Plugin URI:        https://github.com/DominikKuenkele/MainTourn
 * Description:       This plugin stores information about possible tournaments for a club and offers a maintainance function
 * Version:           1.0.0
 * Author:            Dominik Kuenkele
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       maintourn
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
defined('ABSPATH') or die("Direct access not allowed");

/** Useful for registering hooks in setup-hooks.php */
define('MAINTOURN_PLUGIN_FILE', __FILE__);

/**
 * Absolute path to the directory containing Maintourn (wp-content/maintourn).
 */
define('MAINTOURN_PLUGIN_DIR', __DIR__);

/**
 * Version of Maintourn
 */
define('MAINTOURN_VERSION', '1.0.0');


if (!file_exists(__DIR__ . 'autoload.php')) {
    register_activation_hook(__FILE__, 'disable_plugin_activation');

    function disable_plugin_activation()
    {
        wp_die('<h1>Maintourn could not be activated</h1>
            <p>
                It seems that your copy of Maintourn was not built correctly.
            </p>');
    }
    return;
}

require_once(MAINTOURN_PLUGIN_DIR . '/autoloader.php');
require_once(MAINTOURN_PLUGIN_DIR . '/setup-hooks.php');
