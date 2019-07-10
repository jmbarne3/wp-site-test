<?php
/**
 * Plugin Name: WP Site Test
 * Description: Provides WP CLI commands for testing WordPress sites
 * Version: 1.0.0
 * Author: UCF Web Communications
 * License: GPL3
 * Github Plugin URI: UCF/wp-site-test
 */

if ( defined( 'WP_CLI' ) ) {
	// Include utilities
	include_once 'includes/class-url-tester.php';

	// Include commands
	include_once 'commands/wp-cli-site-test.php';
}
