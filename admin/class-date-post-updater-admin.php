<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://webbooks.com.ua/portfolio
 * @since      1.0.0
 *
 * @package    Date_Post_Updater
 * @subpackage Date_Post_Updater/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Date_Post_Updater
 * @subpackage Date_Post_Updater/admin
 * @author     Andrii Beznosko <homeandriy@gmail.com>
 */
class Date_Post_Updater_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Date_Post_Updater_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Date_Post_Updater_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/date-post-updater-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register menu
	 */
	public function register_menu() {
		add_menu_page(
			'Post Date Updater',
			'Post Date Updater',
			'manage_options',
			'post-date-pdater',
			[ $this, 'admin_menu_view' ],
			'dashicons-arrow-right-alt',
			7
		);
	}

	public function admin_menu_view() {
		ob_start();
		include_once DATE_POST_UPDATER_PATH . '/admin/partials/date-post-updater-admin-display.php';
		$content = ob_get_contents();
		ob_clean();
		echo $content;
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Date_Post_Updater_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Date_Post_Updater_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/date-post-updater-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register cron events
	 */
	public function register_cron() {
		$config = require_once DATE_POST_UPDATER_PATH . 'config/cron-config.php';
		new Kama_Cron( $config );
	}

}
