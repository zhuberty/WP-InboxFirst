<?php
/**
 * Plugin Name: WP InboxFirst
 * Description: This plugin integrates the InboxFirst API into WordPress
 * Version: 1.0.0
 * Author: Zachary J. Huberty
 * Author URI: http://zacharyhuberty.com
 * License: GPL2
*/
require_once('InboxFirst-PHP-Library/InboxFirst.php');
require_once('InboxFirst-GForms-Addon/index.php');

# Register Settings
add_action( 'admin_init', function() {
    register_setting( 'wp_inboxfirst', 'wp_inboxfirst_api_key' );
    register_setting( 'wp_inboxfirst', 'wp_inboxfirst_org_id' );
    register_setting( 'wp_inboxfirst', 'wp_inboxfirst_mailing_id' );
    register_setting( 'wp_inboxfirst', 'wp_inboxfirst_allow_subscriber_upates' );
} );

# Dashboard Menu Hooks
function inboxfirst_menus()
{
	# Make sure user is authorized
	if ( !current_user_can( 'manage_options' ) )
	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	# Menu - Main
	add_menu_page( 'WP InboxFirst', 'WP InboxFirst ', 'manage_options', 'wp_inboxfirst', 'main_menu', 'dashicons-email-alt', 20);
}
add_action('admin_menu', 'inboxfirst_menus');

function main_menu()
{
	# Add settings inputs to main menu
	require_once( dirname( __FILE__ ) . '/assets/templates/settings.php' );
}
?>