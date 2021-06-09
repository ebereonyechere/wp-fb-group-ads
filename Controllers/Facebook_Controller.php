<?php

namespace Facebook_Group_Ads\Controllers;

use Facebook_Group_Ads\Plugin;
use Facebook_Group_Ads\Helpers\View;

class Facebook_Controller extends Base_Controller {

    public function __construct() {
        $this->prefix = Plugin::get_instance()->get_prefix();

        $this->app_id  = get_option( $this->prefix . 'fb_app_id' );
        $this->app_secret = get_option( $this->prefix . 'fb_app_secret' );
        $this->page_id = get_option( $this->prefix . 'fb_page_id' );

        $this->fb = new \Facebook\Facebook( [
            'app_id' => $this->app_id,
            'app_secret' => $this->app_secret,
            'default_graph_version' => 'v10.0',
        ] );

        $this->fb->setDefaultAccessToken( get_option( $this->prefix . 'fb_access_token' ) );
    }
    
    public function publish_post( $ad, $order_id ) {
        try {
                $group_id = get_post_meta( $ad[ 'group_id' ], 'group_id', true );
                if ( !$ad[ 'media' ] ) {
                    $reponse = $this->fb->post( $group_id . '/feed' , ['message' => $ad[ 'content' ] ] );
                } else {
                    $response = $this->fb->post( $group_id . '/photos' , [
                        'url' => $ad[ 'media' ],
                        'caption' => $ad[ 'content' ]
                     ] );
                }
        } catch ( \Exception $e ) {}
    }
}