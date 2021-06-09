<?php


namespace Facebook_Group_Ads\Controllers;

use Facebook_Group_Ads\Plugin;
use Facebook_Group_Ads\Helpers\View;


/**
 * Class MenusController
 * @package SuperAffiliateLinks\Controllers
 *
 * @since 1.0.0
 */
class Menus_Controller extends Base_Controller {

	/**
	 * Displays the settings page
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function render_settings_page() {
		if ( isset( $_GET[ 'fb' ] ) ) {
			$prefix = Plugin::get_instance()->get_prefix();

			$app_id  = get_option( $prefix . 'fb_app_id' );
			$app_secret = get_option( $prefix . 'fb_app_secret' );
			$page_id = get_option( $prefix . 'fb_page_id' );

			$fb = new \Facebook\Facebook( [
				'app_id' => $app_id,
				'app_secret' => $app_secret,
				'default_graph_version' => 'v10.0',
			] );

			$helper = $fb->getRedirectLoginHelper();
			try {
			  $accessToken = $helper->getAccessToken();
			} catch(\Facebook\Exception\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(\Facebook\Exception\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}

			if (isset($accessToken)) {
			  // Logged in!
			  $short_live_token =  (string) $accessToken;

				// OAuth 2.0 client handler
				$oAuth2Client = $fb->getOAuth2Client();

				// Exchanges a short-lived access token for a long-lived one
				$user_access_token = $oAuth2Client->getLongLivedAccessToken($short_live_token);

				// Sets the default fallback access token so we don't have to pass it to each request
				$fb->setDefaultAccessToken($user_access_token);

				try {
					$response = $fb->sendRequest('GET', $page_id, ['fields' => 'access_token'])
					  ->getDecodedBody();
				} catch(\Facebook\Exception\FacebookResponseException $e) {
				  // When Graph returns an error
				  echo 'Graph returned an error: ' . $e->getMessage();
				  exit;
				} catch(\Facebook\Exception\FacebookSDKException $e) {
				  // When validation fails or other local issues
				  echo 'Facebook SDK returned an error: ' . $e->getMessage();
				  exit;
				}

				update_option( $prefix . 'fb_access_token', $response['access_token'] );

				wp_redirect( admin_url( 'edit.php?post_type=fb_group&page=settings' ) );
			}

			return;
		}

		if ( isset( $_GET[ 'publish' ] ) ) {
			$order_id = $_GET[ 'publish' ];
			$ads = get_post_meta( $order_id, '_ad_data', true );
			if ( ! wp_next_scheduled( 'fb_buy_ads_publish_ads' ) ) {
				wp_schedule_event( time(), 'daily', 'fb_publish_post', [ $ads, $order_id ] );
			}
			// foreach ( $ads as &$ad ) {
				
			// 	( new Facebook_Controller() )->publish_post( $ad, $order_id );

			// 	$ad[ 'remaining' ] = $ad[ 'remaining' ] - 1;
			// 	if ( $ad[ 'remaining' ] == 0) {
			// 		$ad[ 'completed' ] = 1;
			// 	}
			// 	$order = wc_get_order( $order_id );
			// 	update_post_meta( $order_id, '_ad_data', $ads );
			// 	update_post_meta( $order_id, '_ad_published', 1 );
			// }
			wp_redirect( admin_url( 'edit.php?post_type=fb_group&page=settings&published=' . $order_id ) );
			return;
		}
		if ( isset( $_GET[ 'published' ] ) ) {
			$id = $_GET[ 'published' ];

			$order = wc_get_order( $id );
			$order->update_meta_data( '_ad_published', 1 );

			echo '<div class="wrap"><p>Ad has been published. <a href="'. admin_url( 'post.php?post='. $id .'&action=edit' ) .'">Go Back</a></p></div>';
			
			return;
		}

		View::render( 'pages.settings', compact( 'tab' ) );
	}

	/**
	 * Displays the upgrade to pro version page
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function show_upgrade_page() {
		View::render( 'pages.upgrade' );
	}

	
}
