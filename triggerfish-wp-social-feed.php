<?php

/**
 *
 * @link              https://github.com/dhanukanuwan
 * @since             1.0.0
 * @package           Triggerfish_Wp_Social_Feed
 *
 * @wordpress-plugin
 * Plugin Name:       Triggerfish Social Feed for WordPress
 * Plugin URI:        https://github.com/dhanukanuwan/wp-social-feed
 * Description:       Display YouTube and Twitter feed in any page or post.
 * Version:           1.0.0
 * Author:            Dhanuka Nuwan Gunarathna
 * Author URI:        https://github.com/dhanukanuwan
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       triggerfish-wp-social-feed
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 */
function activate_triggerfish_wp_social_feed() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-triggerfish-wp-social-feed-activator.php';
	Triggerfish_Wp_Social_Feed_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_triggerfish_wp_social_feed() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-triggerfish-wp-social-feed-deactivator.php';
	Triggerfish_Wp_Social_Feed_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_triggerfish_wp_social_feed' );
register_deactivation_hook( __FILE__, 'deactivate_triggerfish_wp_social_feed' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-triggerfish-wp-social-feed.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_triggerfish_wp_social_feed() {

	$plugin = new Triggerfish_Wp_Social_Feed();
	$plugin->run();

}
run_triggerfish_wp_social_feed();
