<?php
if ( ! class_exists( 'WPST_Site_Test' ) ) {
	class WPST_Site_Test {
		/**
		 * Curls each post on a website
		 *
		 * ## EXAMPLES
		 *
		 * wp site-test url-check
		 *
		 * @when after_wp_load
		 */
		function __invoke( $args, $assoc_args ) {
			$util = new WPST_URL_Tester();
			$util->test();

			WP_CLI::success( $util->get_results() );
		}
	}

	WP_CLI::add_command( 'site-test url-check', 'WPST_Site_Test' );
}
