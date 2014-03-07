<?php
/**
 * Plugin Name: Redirect Emails on Staging
 * Plugin URI: http://wordpress.org/plugins/redirect-emails-on-staging/
 * Description: (For WP Engine only) On the Staging site, redirect all emails to the site admin. This is useful in making sure that the staging site doesn't send out confusing emails to your users.
 * Version: 1.1
 * Author: Jeremy Pry
 * Author URI: http://jeremypry.com/
 * License: GPL2
 */

// Prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
	die( "You can't do anything by accessing this file directly." );
}

// Activation check
register_activation_hook( plugin_basename( __FILE__ ), 'jpry_res_activation_check' );

/**
 * Check to ensure the plugin is able to run
 *
 * We're specifically looking to make sure there is a PHP version of 5.3.2 or greater
 *
 * @since 1.1
 */
function jpry_res_activation_check() {
	$min_php_version = '5.3.2';
	$installed_php_version = phpversion();

	if ( version_compare( $min_php_version, $installed_php_version, '>' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( sprintf( "This plugin requires a minimum PHP version of %s. You only have version %s installed. Please upgrade PHP to use this plugin.", $min_php_version, $installed_php_version ) );
	}
}

// Some constants
define( 'RES_FILE', __FILE__ );
define( 'RES_DIR', dirname( RES_FILE ) );

// Pull in the class files
require_once( RES_DIR . "/classes/class-jpry_singleton.php" );
require_once( RES_DIR . "/classes/class-jpry_redirect_staging_email.php" );

// Instantiate the class
JPry_Redirect_Staging_Email::get_instance();
