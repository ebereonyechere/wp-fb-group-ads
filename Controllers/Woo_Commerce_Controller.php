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
class Woo_Commerce_Controller extends Base_Controller {

    public function display_order_details() {
        $ads = $_SESSION[ 'ads' ];
        View::render( 'woocommerce.order-details', compact( 'ads' ) );
    }

    public function update_cart_total( $total, $cart ) {
        $ads = $_SESSION[ 'ads' ];

        $total = 0;

        foreach ( $ads as $ad ) {
            switch ( $ad[ 'schedule' ] ) {
                case 'once':
                    $total += get_post_meta( $ad[ 'group_id' ], 'ad_price_once', true );
                    break;
                case 'daily':
                    $total += ( get_post_meta( $ad[ 'group_id' ], 'ad_price_once', true ) * $ad[ 'times' ] );
                    break;
                case 'weekly':
                    $total += ( get_post_meta( $ad[ 'group_id' ], 'ad_price_weekly', true ) * $ad[ 'times' ] );
                    break;
                case 'monthly':
                    $total += ( get_post_meta( $ad[ 'group_id' ], 'ad_price_monthly', true ) * $ad[ 'times' ] );
                    break;
            }
        }

        return $total;
    }

    public function display_thank_you( $order_id ) {
        if ( ! get_post_meta( $order_id, '_ad_data', true ) ) {
            $order = wc_get_order( $order_id );

            $ads = $_SESSION[ 'ads' ];

            foreach ( $ads as $ad ) {
                $ad[ 'remaining' ] = $ad[ 'times' ];
                $ad[ 'completed' ] = 0;
                $ad[ 'next_run' ] = 0;
                $ad[ 'has_run' ] = 0;
                
            }

            unset( $_SESSION[ 'ads' ] );


            update_post_meta( $order_id, '_ad_data', $ads );
            update_post_meta( $order_id, '_ad_published', 0 );

            $order->save();

            $to = get_option( Plugin::get_instance()->prefix . 'email' );
            $review_url = admin_url( 'post.php?post=' . $order_id . '&action=edit' );
            $subject = 'New Ad has been ordered';
            $message = 'A new ad has been ordered. <a href="'. $review_url .'">Click Here to reveiw and approve it.</a>';

            wp_mail($to, $subject, $message );
        }

        $ads = get_post_meta( $order_id, '_ad_data', true );
        
        View::render( 'woocommerce.thank_you', compact( 'ads' ) );

    }

    public function remove_cart_quantity_checkout( $cart_item, $cart_item_key ) {
        return '';
    }

    public function update_cart_price_checkout( $cart ) {
        // This is necessary for WC 3.0+
        if ( is_admin() && ! defined( 'DOING_AJAX' ) )
            return;

        // Avoiding hook repetition (when using price calculations for example | optional)
        if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
            return;

        // Loop through cart items
        foreach ( $cart->get_cart() as $cart_item ) {
            $cart_item['data']->set_price( 0 );
        }
    }

    public function remove_cart_price_checkout( $cart_item_data, $cart_item, $cart_item_key ) {
        return '';
    }

    public function remove_cart_subtotal_checkout( $wc, $cart_item, $cart_item_key ) {
        return '';
    }

}