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
class Ads_Controller extends Base_Controller {

    public function save_order_session() {

        if ( isset( $_FILES['ad_media'] ) ) {
            require_once( ABSPATH . 'wp-admin/includes/admin.php' );
            $ad_media = wp_handle_upload( $_FILES['ad_media'], array( 'test_form' => false ) )['url'];
        } else {
            $ad_media = false;
        }

        $product_id = get_option( Plugin::get_instance()->prefix . 'woocomerce_product_id' );
        $ad = [
            'schedule' => $_POST['ad_schedule'],
            'times' => $_POST['ad_times'],
            'content' => $_POST['ad_content'],
            'group_id' => $_POST['group_id'],
            'media' => $ad_media
        ];
        array_push( $_SESSION['ads'], $ad );
        // echo $product_id;
        // die;
        WC()->cart->add_to_cart( $product_id, 1 );
        die;
    }


}