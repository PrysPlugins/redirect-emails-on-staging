=== Redirect Emails on Staging ===
Contributors: JPry
Tags: email, wpengine
Requires at least: 3.5.2
Tested up to: 5.9
Requires PHP: 5.3.2
Stable tag: 1.2.0
License: GPL2

Redirect any emails that are sent by the staging site to the administrator of the site.

== Description ==

When using the [Staging site](http://support.wpengine.com/staging/) on WP Engine, you may want to prevent the staging version of your site from sending emails to your site users. This plugin redirects all emails to the site admin.

This plugin should be activated on your Production site. Don't worry — it won't do anything *unless* it is active on Staging site. Once you create a new copy of your Staging site, the plugin will start taking effect there.

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

= What if I forget to install this plugin when I recreate my Staging Site? =

It is recommended to activate this plugin on your Production site. It won't have any affect on your Production site email, and then when you go to recreate your Staging site, it will already be activated and working.

== Screenshots ==

(Not applicable to this plugin)

== Changelog ==

= 1.2.0 - 2022-03-18 =
* Add - Native wp_get_environment_type() support.
* Add - Support for checking with Jetpack for staging.
* Add - Support for modifying CC and BCC lists in emails.
* Dev - Add separate changelog file.
* Dev - add automated build process.
* Tweak - WP 5.9 compatibility.

= 1.1.0 =
* Under-the-hood change: use a class for the main plugin functionality
* Check PHP version with an activation hook
* Update the "Tested up to" tag

= 1.0.0 =
* Created the plugin

== Upgrade Notice ==

