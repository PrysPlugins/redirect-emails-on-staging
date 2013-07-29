<?php
/**
 * Plugin Name: Redirect Emails on Staging
 * Plugin URI: https://github.com/JCPry/WPE-redirect-emails-on-staging.git
 * Description: (For WP Engine only) On the Staging site, redirect all emails to the site admin. This is useful in making sure that the staging site doesn't send out confusing emails to your users.
 * Version: 1.0
 * Author: Jeremy Pry
 * Author URI: http://jeremypry.com/
 * License: GPL2
 */

// Prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You can\'t do anything by accessing this file directly.' );
}

// We're using a high priority to give other plugins room to also modify this filter.
add_filter( 'wp_mail', 'jpry_maybe_redirect_mail', 1000, 1 );

/**
 * Possibly filter all mail.
 * 
 * @uses is_wpe_snapshot() Checks to determine if this is a WP Engine Staging site.
 *
 * We only apply this filter if we're on the staging site, where we generally don't want email
 * accidentally being sent out to end users.
 * @param array $mail_args Array of settings for sending the message.
 * @return array The args to use for the mail message
 */
function jpry_maybe_redirect_mail( $mail_args ) {
	if ( function_exists( 'is_wpe_snapshot' ) && is_wpe_snapshot() ) {
		$mail_args['message'] = 'Originally to: ' . $mail_args['to'] . "\n\n" . $mail_args['message'];
		$mail_args['subject'] = 'Redirected mail | ' . $mail_args['subject'];
		$mail_args['to'] = get_site_option( 'admin_email', 'jeremy@does.co' );
	}
	return $mail_args;
}
