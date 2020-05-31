<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webbooks.com.ua/portfolio
 * @since             1.0.2
 * @package           Date_Post_Updater
 *
 * @wordpress-plugin
 * Plugin Name:       Date Post Updater
 * Plugin URI:        https://webbooks.com.ua/plugins
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Andrii Beznosko
 * Author URI:        https://webbooks.com.ua/portfolio
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       date-post-updater
 * Domain Path:       /languages
 * Network:           true
 * GitHub Plugin URI: https://github.com/homeandriy/date-time-updater
 * Requires PHP:      7.2
 * Requires at least: 5.2
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DATE_POST_UPDATER_VERSION', '1.0.2' );
define( 'DATE_POST_UPDATER_PATH', plugin_dir_path( __FILE__ ) );
define( 'DATE_POST_UPDATER_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-date-post-updater-activator.php
 */
function activate_date_post_updater() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-date-post-updater-activator.php';
	Date_Post_Updater_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-date-post-updater-deactivator.php
 */
function deactivate_date_post_updater() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-date-post-updater-deactivator.php';
	Date_Post_Updater_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_date_post_updater' );
register_deactivation_hook( __FILE__, 'deactivate_date_post_updater' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-date-post-updater.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_date_post_updater() {

	$plugin = new Date_Post_Updater();
	$plugin->run();

}
run_date_post_updater();
