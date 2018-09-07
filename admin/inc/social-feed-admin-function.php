<?php

/**
 *
 * @link       https://github.com/dhanukanuwan
 * @since      1.0.0
 *
 * @package    Triggerfish_Wp_Social_Feed
 * @subpackage Triggerfish_Wp_Social_Feed/admin/inc
 */


function newsfeed_get_options( $option_id = null ) {

	if ( empty( $option_id ) ) {
		return;
	}

	global $newsfeed_options;

	if ( isset( $newsfeed_options[$option_id] ) ) {

		return $newsfeed_options[$option_id];

	}

}



