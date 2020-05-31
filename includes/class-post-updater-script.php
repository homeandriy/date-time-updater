<?php

class Post_Updater_Script {
	const CONFIG_META_KEY = 'dpu_config';
	const IS_WORKED = 1;
	const IS_STOPPED = 0;

	/**
	 * Config array
	 *
	 * @var []
	 */
	private $config;
	/**
	 * @var string
	 */
	private $min_date;
	/**
	 * @var int
	 */
	private $limit;
	/**
	 * @var string
	 */
	private $post_type;
	/**
	 * Is worked shedule
	 *
	 * @var int
	 */
	private $status;

	public function __construct() {
		$config = get_option( self::CONFIG_META_KEY );
		$date   = date( 'Y-m-d H:i:s', strtotime( '-1 day', time() ) );
		error_log( $date );
		$this->config = ! is_array( $config ) ?
			[
				'is_worked' => self::IS_WORKED,
				'min_date'  => $date,
				'range'     => 100,
				'post_type' => 'post'
			]
			:
			$config;

		$this->min_date  = $this->config['min_date'];
		$this->limit     = $this->config['range'];
		$this->post_type = $this->config['post_type'];
		$this->status    = $this->config['is_worked'];
	}

	public static function cron_tasks() {

		error_log( 'ERROR LOG >>> !> Start test <!' );

		$sheduller = new self();
		/**
		 * Task is stopped
		 */
		if ( self::IS_STOPPED === $sheduller->status ) {
			return;
		}
		$sheduller->find_posts();

	}

	private function find_posts() {
		global $wpdb;
		$finded_posts = $wpdb->get_results( "
									SELECT * FROM `{$wpdb->posts}` 
									WHERE `post_date` <= '" . $this->min_date . "' 
									AND `post_type` = '" . $this->post_type . "' 
									ORDER BY `ID` ASC LIMIT " . $this->limit );

		$finded_posts = ! is_array( $finded_posts ) ? [] : $finded_posts;

		foreach ( $finded_posts as $finded_post ) {
			/**
			 * Helper
			 *
			 * @var WP_Post $finded_post
			 */
			error_log( 'Title : ' . $finded_post->post_title );
			error_log( 'Date : ' . $this->get_random_date( date( 'Y-m-d H:i:s' ), $this->min_date ) );
			$diff = date( 'G', strtotime( strtotime( $finded_post->post_date_gmt ) - strtotime( $finded_post->post_date ) ) );
			error_log( 'Hour diff : ' . $diff );
			error_log( 'Post publish : ' . $finded_post->post_date );
			$add_string   = "+" . $diff . " hours";
			$new_date_gmt = date( 'Y-m-d H:i:s', strtotime( $add_string, strtotime( $finded_post->post_date ) ) );
			error_log( 'New date : ' . $new_date_gmt );
		}
	}

	/**
	 * Get random date
	 *
	 * @param string $start_date
	 * @param string $end_date
	 *
	 * @return false|string
	 */
	function get_random_date( string $start_date, string $end_date ) {
		// Convert to timetamps
		$min = strtotime( $start_date );
		$max = strtotime( $end_date );

		// Generate random number using above bounds
		$val = rand( $min, $max );

		// Convert back to desired date format
		return date( 'Y-m-d H:i:s', $val );
	}
}
