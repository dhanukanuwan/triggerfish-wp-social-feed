<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/dhanukanuwan
 * @since      1.0.0
 *
 * @package    Triggerfish_Wp_Social_Feed
 * @subpackage Triggerfish_Wp_Social_Feed/admin
 */

/**
 *
 * @package    Triggerfish_Wp_Social_Feed
 * @subpackage Triggerfish_Wp_Social_Feed/admin
 * @author     Dhanuka Nuwan Gunarathna <nuwan.dhanuka@gmail.com>
 */
class Triggerfish_Wp_Social_Feed_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();

	}

	public function load_dependencies() {

		// Loading Redux Framework
		if ( !class_exists( 'ReduxFramework' )  ) {
		    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/framework/ReduxCore/framework.php';
		}

		// Including Redux Framework Options
		if ( !isset( $newsfeed_options ) ) {
		    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/newsfeed-options.php';
		}

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/inc/social-feed-admin-function.php';
		
	}


}
