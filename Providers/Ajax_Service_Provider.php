<?php

namespace Facebook_Group_Ads\Providers;


use Facebook_Group_Ads\Plugin;
use Facebook_Group_Ads\Controllers\Ads_Controller;

class Ajax_Service_Provider extends Base_Service_Provider {

    public $ads_controller;

    public function __construct() {
        $this->ads_controller = new Ads_Controller();
    }

    public function register() {
        add_action( 'wp_ajax_ad_save_order_session', [ $this->ads_controller, 'save_order_session' ] );
        add_action( 'wp_ajax_nopriv_ad_save_order_session', [ $this->ads_controller, 'save_order_session' ] );
    }

    public function run() {
        
    }
}