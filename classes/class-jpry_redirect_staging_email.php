<?php

if ( ! class_exists( 'JPry_Redirect_Staging_Email', false ) ) :
/**
 * This class handles redirecting emaiils when on the WP Engine Staging site.
 *
 * It is usually undesirable for the staging site to send out emails to anyone besides the site
 * administrator. This class hooks into the wp_mail() function in WordPress
 *
 * @package RedirectStagingEmail
 * @author Jeremy Pry
 * @license GPL-2.0+
 * @since 1.1
 */
class JPry_Redirect_Staging_Email extends JPry_Singleton {

	/**
	 * The Singleton instance of this class
	 *
	 * @var JPry_Redirect_Staging_Email
	 */
	protected static $instance = null;

	/**
	 * Constructor.
	 *
	 * Hook the methods of this class to the appropriate hooks in WordPress
	 *
	 * @since 1.1
	 */
	protected function __construct() {

		// We're using a high priority to give other plugins room to also modify this filter.
		add_filter( 'wp_mail', array( $this, 'maybe_redirect_mail' ), 1000, 1 );
	}

	/**
	 * Possibly filter all mail.
	 *
	 * We only apply this filter if we're on the staging site, where we generally don't want email
	 * accidentally being sent out to end users.
	 *
	 * @since 1.0
	 *
	 * @uses is_wpe_snapshot() Checks to determine if this is a WP Engine Staging site.
	 *
	 * @param array $mail_args Array of settings for sending the message.
	 * @return array The args to use for the mail message
	 */
	public function maybe_redirect_mail( $mail_args ) {
		if ( function_exists( 'is_wpe_snapshot' ) && is_wpe_snapshot() ) {
			$admin_email = get_site_option( 'admin_email' );

			// Only redirect email that is NOT already going to the admin
			if ( $admin_email != $mail_args['to'] ) {
				$mail_args['message'] = 'Originally to: ' . $mail_args['to'] . "\n\n" . $mail_args['message'];
				$mail_args['subject'] = 'REDIRECTED MAIL | ' . $mail_args['subject'];
				$mail_args['to'] = $admin_email;
			}

			// Handle the CC and BCC headers
			if ( isset( $mail_args['headers'] ) && ! empty( $mail_args['headers'] ) ) {

				$ccs  = array();
				$bccs = array();

				// Ensure we have an array
				$mail_args['headers'] = (array) $mail_args['headers'];

				foreach ( $mail_args['headers'] as $num => $header ) {
					if ( strpos( $header, ':' ) === false ) {
						continue;
					}

					// Explode headers and content
					list( $name, $content ) = explode( ':', trim( $header ), 2 );

					// Cleanup the header name
					$name = trim( $name );

					switch ( strtolower( $name ) ) {

						// Remove the header entirely
						case 'cc':
							$ccs = array_merge( (array) $ccs, explode( ',', $content ) );
							break;
						case 'bcc':
							$bccs = array_merge( (array) $bccs, explode( ',', $content ) );
							break;

						// Continue to the next item in the array
						default:
							continue;
							break;
					}

					// Now unset the header
					unset( $mail_args[ 'headers' ][ $num ] );

					// Include what was removed in the message body
					$addition = 'CCs removed: ' . join( ', ', $ccs ) . "\n";
					$addition .= 'BCCs removed: ' . join( ', ', $bccs ) . "\n\n";
					$mail_args['message'] = $addition . $mail_args['message'];
				}
			}
		}
		return $mail_args;
	}
}
endif; // end of if ( class_exists() ) statement