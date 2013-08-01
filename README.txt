=== Redirect Emails on Staging ===
Contributors: JPry
Tags: email, wpengine
Requires at least: 3.5.2
Tested up to: 3.5.2
Stable Tag: 1.0
License: GPL2

Redirect any emails that are sent by the staging site to the administrator of the site.

== Description ==

When using the [Staging area](http://support.wpengine.com/staging/) on WP Engine, you may want to prevent the staging version of your site from sending emails to your site users. This plugin redirects all emails to the site admin.

This plugin should be activated on your Production site. Don't worry — it won't do anything *unless* it is active on Staging site.

This plugin is compatible with WordPress Multisite. If you're using it in a Multisite environment, it is recommended to either Network Activate the plugin, or follow the instructions for installing it to the `mu-plugins` directory.

== Installation ==

Simple installation:

1. Upload the `redirect-emails-on-staging` folder to your `/wp-content/plugins/` directory
2. Activate the plugin through the "Plugins" menu in WordPress

Advanced installation (`mu-plugins` directory):

1. Upload *just* the `redirect-emails-on-staging.php` file to your `/wp-content/mu-plugins/` directory
2. That's it... the plugin is already activated! Take a look under Plugins > Must Use

== Frequently Asked Questions ==

= Where do I find the Site Admin email? =

On a normal WordPress installation, go to the Dashboard, then to Settings > General. Look for the "E-mail Address" field.

On a Multisite WordPress installation, go to the Network Dashboard, then to Settings > Network Settings. Look for the "Network Admin Email" field.

== Screenshots ==

(none yet)

== Changelog ==

= 1.0 =
* Created the plugin

== Upgrade Notice ==

