<?php

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
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'MAINTOURN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-maintourn-activator.php
 */
function activate_maintourn() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-maintourn-activator.php';
	Maintourn_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-maintourn-deactivator.php
 */
function deactivate_maintourn() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-maintourn-deactivator.php';
	Maintourn_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_maintourn' );
register_deactivation_hook( __FILE__, 'deactivate_maintourn' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-maintourn.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_maintourn() {

	$plugin = new Maintourn();
	$plugin->run();

}
run_maintourn();
