<?php


namespace Facebook_Group_Ads\Providers;

use Facebook_Group_Ads\Controllers\Menus_Controller;
use Facebook_Group_Ads\Helpers\View;
use Facebook_Group_Ads\Plugin;

class Short_Codes_Service_Provider extends Base_Service_Provider {

    public function __construct() {
    }

    /**
     * Registers wordpress action hooks and filters.
     *
     * @return mixed|void
     *
     * @since 1.0.0
     */
    public function register() {
        add_action( 'init', [ $this, 'run' ] );
    }

    /**
     * Callback function for the registered hooks and filters
     *
     * @return void
     * 
     * @since 1.0.0
     */
    public function run() {
        add_shortcode( 'facebook_group_buy_ads', [ $this, 'do' ] );
    }

    public function do( $atts, $content, $shortcode_tag ) {
        if ( ! is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
            View::render( 'pages.buy_ads' );
        }
    }
}
