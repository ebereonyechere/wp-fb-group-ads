let fb_buy_ads_group_id = 0;
jQuery(document).ready(function ($) {

    $( '#submit_ad' ).on( 'click', () => {
        $( '#submit_ad' ).html( '<div class="fb-ad-loader"></div>' );
        fb_buy_ads_submit_ad()
    } );

    $( '#add_ad' ).on( 'click', () => {
        $( '#add_ad' ).html( '<div class="fb-ad-loader"></div>' );
        fb_buy_ads_submit_ad( false )
    } );

});

function fb_buy_ads_set_group_id( id ) {
    fb_buy_ads_group_id = id;
} 

function fb_buy_ads_submit_ad( redirect = true) {
    data = new FormData();
    data.append( 'ad_media', jQuery('#ad_media')[0].files[0] );
    data.append( 'ad_content', jQuery('#ad_content').val() );
    data.append( 'ad_schedule', jQuery('#ad_schedule').val() );
    data.append( 'ad_times', jQuery('#ad_times').val() );
    data.append( 'action', 'ad_save_order_session' );
    data.append( 'group_id', fb_buy_ads_group_id );
    jQuery.ajax({
        type: 'POST',
        url: fb_buy_ads.ajax_url,
        // contentType: 'application/json; charset=utf-8',
        data: data,
        enctype: 'multipart/form-data',
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        // dataType: 'json',
        success: (data) => {
            if ( redirect ) {
                window.location.replace( '/checkout' )
            } else {
                jQuery( '#add_ad' ).html( 'Add Another Ad' );
                jQuery( '#ad_added_text' ).css( 'display', 'none' );
                const modal = new bootstrap.Modal ( jQuery( '#buy_ad_modal' ), {} );
                modal.hide();
            }
        },
        error: (err) => {console.log(err)}
    });
}

