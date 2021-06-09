<?php

/**
 * Plugin Name: Facebook Group Ads
 * Domain Path: /Languages/
 *
 * @package PluginPackage
 * @category Core
 * @fs_premium_only
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'What are you doing here?' );
}

use Facebook_Group_Ads\Plugin;
use Facebook_Group_Ads\Controllers\Facebook_Controller;

require_once( plugin_dir_path( __FILE__ ) . '/Lib/autoload.php' );

add_action( 'wp_loaded', function() {

	$status = session_status();

	if ( PHP_SESSION_DISABLED === $status ) {
		// That's why you cannot rely on sessions!
		return;
	}

	if ( PHP_SESSION_NONE === $status ) {
		session_start();
	}
	if ( ! isset( $_SESSION[ 'ads' ] ) ) {
		$_SESSION[ 'ads' ] = [];
	}
	// $_SESSION[ 'ads' ] = [];
});

register_activation_hook( __FILE__, 'activate_facebook_group_ads' );
register_deactivation_hook( __FILE__, 'deactivate_facebook_group_ads' );
register_uninstall_hook( __FILE__, 'uninstall_facebook_group_ads' );

$facebook_group_ads = Plugin::get_instance();

$facebook_group_ads->init();

function activate_facebook_group_ads() {
	Plugin::get_instance()->activate();
}

function deactivate_facebook_group_ads() {
	Plugin::get_instance()->deactivate();
}

function uninstall_facebook_group_ads() {
	Plugin::get_instance()->uninstall();
}

add_action( 'fb_publish_post', 'publish_post', 10, 2 );

function publish_post( $ads, $order_id ) {
		
	foreach ( $ads as &$ad ) {

		if ( $ad[ 'has_run' ] ) {
			if ( $ad[ 'next_run' ] > time() ) continue;
		}

		if ( $ad['completed'] ) continue;
				
		( new Facebook_Controller() )->publish_post( $ad, $order_id );
		
		switch ($ad[ 'schedule' ]) {
			case 'weekly':
				$ad[ 'next_run' ] = strtotime('+7 days', time() );
				break;
			case 'monthly':
				$ad[ 'next_run' ] = strtotime('+30 days', time() );
				break;
		}

		$ad[ 'remaining' ] = $ad[ 'remaining' ] - 1;
		if ( $ad[ 'remaining' ] == 0) {
			$ad[ 'completed' ] = 1;
		}
		$ad[ 'has_run' ] = 1;
		$order = wc_get_order( $order_id );
		update_post_meta( $order_id, '_ad_data', $ads );
		update_post_meta( $order_id, '_ad_published', 1 );
	}
}