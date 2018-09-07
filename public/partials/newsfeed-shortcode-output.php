<?php

/**
 *
 * @link       https://github.com/dhanukanuwan
 * @since      1.0.0
 *
 * @package    Triggerfish_Wp_Social_Feed
 * @subpackage Triggerfish_Wp_Social_Feed/public/partials
 */
?>

<?php

	$NewsfeedTweets = new WpSocialTwitter( array(
	  'consumer_key'        => newsfeed_get_options( 'newsfeed-twitter-consumer-key' ),
	  'consumer_secret'     => newsfeed_get_options( 'newsfeed-twitter-consumer-secret' ),
	  'access_token'        => newsfeed_get_options( 'newsfeed-twitter-access-token' ),
	  'access_token_secret' => newsfeed_get_options( 'newsfeed-twitter-access-token-secret' ),
	  'api_endpoint'        => 'statuses/home_timeline',
	  'api_params'          => array( 'screen_name' => newsfeed_get_options( 'newsfeed-twitter-username' ) ),
	  'enable_cache'		=> false
	));

	$NewsfeedTweetsArray = $NewsfeedTweets->get_tweet_array();

	$NewsfeedYoutubeVideos = new WpSocialGoogle ( array( 
		'api_key' 		=> newsfeed_get_options( 'newsfeed-google-api-key' ),
		'playlist_id'	=> newsfeed_get_options( 'newsfeed-youtube-playlist-id' )
	 ) );

	$NewsfeedVideoArray = $NewsfeedYoutubeVideos->fetch_youtube_videos();

	$NewsfeedVideoList = $NewsfeedYoutubeVideos->fetch_youtube_video_info_list( $NewsfeedVideoArray );

	$tweet_error = false;

	if ( isset( $NewsfeedTweetsArray[0] ) && $NewsfeedTweetsArray[0] == 'Error fetching or loading tweets' ) {
		$tweet_error = true;
	}

?>

<?php if( $tweet_error === false || ! empty( $NewsfeedVideoList ) ) : ?>

	<div id="tg-newsfeed-wrap" class="tg-newsfeed-wrap">

		<div class="tg-newsfeed-header columns is-mobile is-multiline">
			<div class="tg-newsfeed-header-left column is-12-mobile is-12-tablet is-8-desktop">
				<h2>Phasellus non rutrum enim, eu pulvinar quam</h2>
				<div class="tg-newsfeed-sort controls">
					<a href="javascript:;" class="control" data-sort="published-date:asc"><?php _e( 'Sort By Date:ASC', 'triggerfish-wp-social-feed' ); ?></a>
					<a href="javascript:;" class="control" data-sort="published-date:desc"><?php _e( 'Sort By Date:DESC', 'triggerfish-wp-social-feed' ); ?></a>
				</div>
			</div>
			<div class="tg-newsfeed-header-right column is-12-mobile is-12-tablet is-4-desktop">
				<?php if ( ! empty( $NewsfeedTweetsArray ) && ! empty( $NewsfeedVideoList ) ) : ?>
					<div class="tg-newsfeed-sort controls">
						<a href="javascript:;" class="control" data-filter="all"><?php _e( 'All', 'triggerfish-wp-social-feed' ); ?></a>
						<a href="javascript:;" class="control" data-filter=".youtube"><?php _e( 'YouTube', 'triggerfish-wp-social-feed' ); ?></a>
						<a href="javascript:;" class="control" data-filter=".twitter"><?php _e( 'Twitter', 'triggerfish-wp-social-feed' ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="tg-newsfeed-filter-wrap">
			<div class="tg-newsfeed-filter-content">

				<?php  

					if ( ! empty( $NewsfeedTweetsArray ) ) {

						foreach ( $NewsfeedTweetsArray as $NewsfeedTweetsSingle ) {

							//print("<pre>".print_r($NewsfeedTweetsSingle,true)."</pre>");

							if ( isset( $NewsfeedTweetsSingle[ 'text' ] ) ) {

								if( isset( $NewsfeedTweetsSingle[ 'created_at' ] ) ) {

									$tweet_date_timestamp = $NewsfeedTweetsSingle[ 'created_at' ];
									$tweet_date = new DateTime( $tweet_date_timestamp );
									$tweet_date = $tweet_date->format('Y-m-d');

								}

								echo '<div class="mix tg-newsfeed-single twitter" data-published-date="' . $tweet_date . '">';
									echo '<div class="tg-newsfeed-single-inner">';
										echo '<div class="tg-newsfeed-single-bottom">';
											echo wpautop( $NewsfeedTweetsSingle[ 'text'] );
										echo '</div>';
									echo '</div>';
								echo '</div>';

							}

						}

					}

					
				?>

				<?php 

					if ( ! empty( $NewsfeedVideoList ) ) {

						foreach( $NewsfeedVideoList as $key => $value ) {

							echo '<div class="mix tg-newsfeed-single youtube" data-published-date="' . $value['date'] . '">';
								echo '<div class="tg-newsfeed-single-inner">';
									echo '<div class="tg-newsfeed-single-top">';
										echo $NewsfeedYoutubeVideos->output_video_embed_html( $key );
									echo '</div>';
									echo '<div class="tg-newsfeed-single-bottom">';
										echo '<h2>' . $value['title'] . '</h2>';
									echo '</div>';
								echo '</div>';
							echo '</div>';

						}

					}

					 

				?>

			</div>

		</div>

	</div>

<?php endif; ?>