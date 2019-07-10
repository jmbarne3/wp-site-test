<?php
/**
 * Utility class for testing WordPress sites
 */
if ( ! class_exists( 'WPST_URL_Tester' ) ) {
	class WPST_URL_Tester {
		private
			$posts_found = 0,
			$posts_success = 0,
			$posts_failed = 0,
			$post_failues = array();

		public function test() {
			$args = array(
				'post_type'      => 'any',
				'posts_per_page' => -1
			);

			$posts = get_posts( $args );

			$this->posts_found = count( $posts );

			$progress = $progress = \WP_CLI\Utils\make_progress_bar( 'Testing posts...', $this->posts_found );

			foreach( $posts as $post ) {
				$url = get_permalink( $post->ID );

				$response = wp_remote_get( $url, array( 'timeout' => '5' ) );

				if ( $response ) {
					$code = wp_remote_retrieve_response_code( $response );

					if ( $code < 400 ) {
						$posts_success++;
					} else {
						$posts_failed++;
						$this->post_failures[] = array(
							'url'  => $url,
							'code' => $code
						);
					}
				}

				$progress->tick();
			}
		}

		public function get_results() {
			$output =
"
Posts processed : $this->posts_found
Success         : $this->posts_success
Failed          : $this->posts_failed

Failures        :
";

			foreach( $this->post_failues as $post ) {
				$output .= "$post['code']: $post['url']\n";
			}

			return $output;
		}
	}
}
