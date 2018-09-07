<?php


	class WpSocialGoogle {

		private $options;
		private $response_body;
		private $response_items;
		private $video_info_list = array();

		public function  __construct ( $options = array() ) {

			$this->options = array_merge(
		      array(
		          'api_key'         => '',
		          'playlist_id'		=> ''
		        ),
		        $options
		     );

		}

		/**
		 * Fetching a list of video data from given playlist ID
		 *
		 * @since    1.0.0
		 */
		public function fetch_youtube_videos () {

			$request_url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=20&playlistId=' . $this->options['playlist_id'] . '&key=' . $this->options['api_key'];

			$response = wp_remote_get( esc_url_raw( $request_url ) );

			$this->response_body = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( ! empty( $this->response_body ) && isset( $this->response_body[ 'items' ] ) ) {

				$this->response_items = $this->response_body[ 'items' ];

			}

			return $this->response_items;

		}

		/**
		 * Getting a list of video ID, Title and data from fetched data
		 *
		 * @since    1.0.0
		 * @param      array    $response_items      fetched video data using api call.
		 */
		public function fetch_youtube_video_info_list ( $response_items = array() ) {

			$this->response_items = $response_items;

			if ( ! empty( $this->response_items ) && is_array( $this->response_items ) ) {

				foreach( $this->response_items as $response_item ) {

					if ( isset( $response_item[ 'snippet' ] ) && is_array( $response_item[ 'snippet' ] ) ) {

						$video_info = $response_item[ 'snippet' ];

						if ( isset( $video_info[ 'title'] ) ) {

							$video_title = $video_info[ 'title'];

						}

						if ( isset( $video_info[ 'resourceId' ][ 'videoId' ] ) ) {

							$video_id = $video_info[ 'resourceId' ][ 'videoId' ];

						}

						if ( isset( $video_info[ 'publishedAt'] ) ) {

							$video_date = $video_info[ 'publishedAt'];
							$date = new DateTime($video_date);
							$date = $date->format('Y-m-d');

						}

						if ( ! empty( $video_id ) ) {

							$this->video_info_list[$video_id]['title'] = $video_title; 
							$this->video_info_list[$video_id]['date'] = $date;

						}

					}

				}

			}

			return $this->video_info_list;

		}

		/**
		 * Outputs video embed html for given video ID
		 *
		 * @since    1.0.0
		 * @param      string    $video_id      Video ID to output embed code.
		 * @param      string    $width      Width of the vide embed.
		 * @param      string    $height      Height of the vide embed.
		 */
		public function output_video_embed_html ( $video_id = null, $width = '100%', $height = '200' ) {

			$html = null;
			
			if ( ! empty( $video_id ) ) {

				$html = '<iframe width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" src="https://www.youtube.com/embed/' . $video_id . '?rel=0&amp;showinfo=0" frameborder="0" encrypted-media" allowfullscreen></iframe>';

			}

			return $html;

		}

	}

 ?>