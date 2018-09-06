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
			<div class="tg-newsfeed-sort controls">
				<a href="javascript:;" class="control" data-filter="all"><?php _e( 'All', 'triggerfish-wp-social-feed' ); ?></a>
				<a href="javascript:;" class="control" data-filter=".youtube"><?php _e( 'YouTube', 'triggerfish-wp-social-feed' ); ?></a>
				<a href="javascript:;" class="control" data-filter=".twitter"><?php _e( 'Twitter', 'triggerfish-wp-social-feed' ); ?></a>
			</div>
		</div>
	</div>


	<div class="tg-newsfeed-filter-wrap">
		<div class="tg-newsfeed-filter-content">

			<?php

				$NewsfeedTweets = new WpSocialTwitter( array(
				  'consumer_key'        => 'mXX4HibMNrmU86ol6ajoVfJrU',
				  'consumer_secret'     => '2UBH169B3v1iaBHWarkgOhXeMSX97ZWhkbixijJf8pvQCggSxh',
				  'access_token'        => '161672794-xbjchxVasGPoiqTlMzLEKR6Vive2NVXxIqCnojXJ',
				  'access_token_secret' => 'zizqFNBEgtjEobGcU5FwTHaf54xSIEeZBBALWZPyxNLDy',
				  'api_endpoint'        => 'statuses/home_timeline',
				  'api_params'          => array( 'screen_name' => 'dhanukanuwan' )
				));

				$NewsfeedTweetsArray = $NewsfeedTweets->get_tweet_array();

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

				$NewsfeedYoutubeVideos = new WpSocialGoogle ( array( 
					'api_key' 		=> 'AIzaSyCQw69zZi_hQin0YuVJREUgN7xgLf3vUDc',
					'playlist_id'	=> 'PLxyNkZaNq8SsWtL4mYttdoOFpti0bTf0B'
				 ) );

				$NewsfeedVideoArray = $NewsfeedYoutubeVideos->fetch_youtube_videos();

				$NewsfeedVideoList = $NewsfeedYoutubeVideos->fetch_youtube_video_info_list( $NewsfeedVideoArray );


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

