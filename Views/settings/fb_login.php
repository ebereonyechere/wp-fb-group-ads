<?php

$app_id  = get_option( $prefix . 'fb_app_id' );
$app_secret = get_option( $prefix . 'fb_app_secret' );
$page_id = get_option( $prefix . 'fb_page_id' );

if ( ! $app_id || ! $app_secret || ! $page_id ) {
    echo 'Please enter app id and secret and page id and save before you can login wihin facebook';
} else {
    
    $fb = new Facebook\Facebook( [
        'app_id' => $app_id,
        'app_secret' => $app_secret,
        'default_graph_version' => 'v10.0',
    ] );

    $helper = $fb->getRedirectLoginHelper();
    $permissions = [ 'public_profile', 'pages_show_list', 'publish_to_groups', 'pages_read_engagement', 'pages_manage_posts' ]; // optional
    $callback_url = admin_url( 'edit.php?post_type=fb_group&page=settings&fb=1' );
    $loginUrl = $helper->getLoginUrl( $callback_url, $permissions);

    echo '<p>This is the OAuth Redirect URI to use: </p>';
    echo '<p style="margin-bottom: 10px;">' . $callback_url . '</p>';

    if ( ! get_option( $prefix . 'fb_access_token' ) ) {
        echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    } else {
        echo '<p style="color: green;">You have authorized the app with facebook.</p>';
    }


}

?>