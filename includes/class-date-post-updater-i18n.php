<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://webbooks.com.ua/portfolio
 * @since      1.0.0
 *
 * @package    Date_Post_Updater
 * @subpackage Date_Post_Updater/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Date_Post_Updater
 * @subpackage Date_Post_Updater/includes
 * @author     Andrii Beznosko <homeandriy@gmail.com>
 */
class Date_Post_Updater_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'date-post-updater',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
