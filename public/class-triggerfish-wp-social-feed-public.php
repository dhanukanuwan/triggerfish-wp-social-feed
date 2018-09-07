<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/dhanukanuwan
 * @since      1.0.0
 *
 * @package    Triggerfish_Wp_Social_Feed
 * @subpackage Triggerfish_Wp_Social_Feed/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Triggerfish_Wp_Social_Feed
 * @subpackage Triggerfish_Wp_Social_Feed/public
 * @author     Dhanuka Nuwan Gunarathna <nuwan.dhanuka@gmail.com>
 */
class Triggerfish_Wp_Social_Feed_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();

		add_shortcode( 'tg_newsfeed', array( $this, 'newsfeed_shortcode_func' ) );
		add_filter( 'body_class', array( $this, 'newsfeed_shortcode_body_class' ) );

	}

	public function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/twitter/wp-social-twitter.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/google/wp-social-google.php';
		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'newsfeed-layout', plugin_dir_url( __FILE__ ) . 'css/bulma.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'newsfeed-main-css', plugin_dir_url( __FILE__ ) . 'css/public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'newsfeed-mixitup-js', plugin_dir_url( __FILE__ ) . 'js/mixitup.min.js', array( 'jquery' ), '3.3.0', true );
		wp_enqueue_script( 'newsfeed-linkify-js', plugin_dir_url( __FILE__ ) . 'js/linkify.min.js', array( 'jquery' ), '2.1.6', true );
		wp_enqueue_script( 'newsfeed-linkify-jquery-js', plugin_dir_url( __FILE__ ) . 'js/linkify-jquery.min.js', array( 'jquery' ), '2.1.6', true );
		wp_enqueue_script( 'newsfeed-main-js', plugin_dir_url( __FILE__ ) . 'js/social-feed-public.js', array( 'jquery' ), $this->version, true );

	}

	public function newsfeed_shortcode_func( $atts ) {

		$attr = shortcode_atts( array(
			'youtube' => true,
			'twitter' => true,
		), $atts );

		$html = $this->newsfeed_shortcode_output();

		return $html;

	}

	public function newsfeed_shortcode_output() {

		include_once( plugin_dir_path( __FILE__ ) . 'partials/newsfeed-shortcode-output.php' );

	}

	public function newsfeed_shortcode_body_class( $c ) {

	    global $post;

	    if( isset($post->post_content) && has_shortcode( $post->post_content, 'tg_newsfeed' ) ) {
	        $c[] = 'tg-newsfeed-page';
	    }
	    return $c;
	}

	

}
