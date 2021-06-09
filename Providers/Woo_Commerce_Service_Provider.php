<?php

namespace Facebook_Group_Ads\Providers;


use Facebook_Group_Ads\Plugin;
use Facebook_Group_Ads\Controllers\Ads_Controller;
use Facebook_Group_Ads\Controllers\Woo_Commerce_Controller;

class Woo_Commerce_Service_Provider extends Base_Service_Provider {

    public $woo_commerce_controller;

    public function __construct() {
        $this->woo_commerce_controller = new Woo_Commerce_Controller();
    }

    public function register() {
        add_action( 'woocommerce_review_order_before_order_total', [ $this->woo_commerce_controller, 'display_order_details' ] );
        add_action( 'woocommerce_thankyou', [ $this->woo_commerce_controller, 'display_thank_you' ], 10, 1 );
        add_filter( 'woocommerce_calculated_total',  [ $this->woo_commerce_controller, 'update_cart_total' ], 10, 2 );
        add_filter( 'woocommerce_checkout_cart_item_quantity', [ $this->woo_commerce_controller, 'remove_cart_quantity_checkout' ], 10, 2 );
        add_action( 'woocommerce_before_calculate_totals', [ $this->woo_commerce_controller, 'update_cart_price_checkout' ], 1000, 1 );
        add_filter( 'woocommerce_cart_item_product', [ $this->woo_commerce_controller, 'remove_cart_price_checkout' ], 10, 3 );
        add_filter( 'woocommerce_thankyou_item_product', [ $this->woo_commerce_controller, 'remove_cart_price_checkout' ], 10, 3 );
        add_filter( 'woocommerce_cart_item_subtotal', [ $this->woo_commerce_controller, 'remove_cart_subtotal_checkout' ], 10, 3 );
        add_filter( 'woocommerce_thankyou_item_subtotal', [ $this->woo_commerce_controller, 'remove_cart_subtotal_checkout' ], 10, 3 );
        // add_action( 'woocommerce_payment_complete', [ $this->woo_commerce_controller, 'process_order'] );
    }

    public function run() {
        
    }
}