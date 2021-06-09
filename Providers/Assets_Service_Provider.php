<?php


namespace Facebook_Group_Ads\Providers;


use Facebook_Group_Ads\Plugin;

class Assets_Service_Provider extends Base_Service_Provider {

	/**
	 * Registers wordpress action hooks and filters.
	 *
	 * @return mixed|void
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function run() {

	}

	/**
	 * Enqueues admin script and styles
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueue_admin_scripts() {

	    if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'infinity_bar' ) {
            
        }


	}

	/**
	 * Enqueues frontend script and styles
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		wp_register_style( 'fb-buy-ads-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css' );
		wp_register_style( 'fb-buy-ads', Plugin::get_instance()->get_url() . 'Assets/css/fb-buy-ads.css' );

		wp_register_script( 'fb-buy-ads-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js', [], false, true );

		wp_register_script( 'fb-buy-ads', Plugin::get_instance()->get_url() . 'Assets/js/fb-buy-ads.js', [ 'jquery', 'wp-util' ], false, true );

		wp_enqueue_style( 'fb-buy-ads-bootstrap' );
		wp_enqueue_script( 'fb-buy-ads-bootstrap' );
		wp_enqueue_style( 'fb-buy-ads' );
		wp_enqueue_script( 'fb-buy-ads' );

		wp_localize_script( 'fb-buy-ads', 'fb_buy_ads', [
			'ajax_url' => admin_url( 'admin-ajax.php' )
		] );
	}
}
