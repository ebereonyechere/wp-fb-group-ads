<?php


namespace Facebook_Group_Ads\Controllers;

use Facebook_Group_Ads\Plugin;
use Facebook_Group_Ads\Helpers\View;

/**
 * Class MetaBoxesController
 * @package SuperAffiliateLinks\Controllers
 *
 * @since 1.0.0
 */
class Meta_Boxes_Controller extends Base_Controller {

	private $prefix;

	/**
	 * MetaBoxesController constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->prefix = Plugin::get_instance()->prefix;
	}

	/**
	 * Replaces the default submit metabox with a custom one which has only a publish, update or delete button
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function display_submit_meta_box() {
		global $action, $post;

		$post_type        = $post->post_type; // get current post_type
		$post_type_object = get_post_type_object( $post_type );
		$can_publish      = current_user_can( $post_type_object->cap->publish_posts );

		View::render( 'metaboxes.submitdiv', compact( 'action', 'post', 'post_type', 'post_type_object', 'can_publish' ) );
	}

	/**
	 * Renders the required metabox view file
	 *
	 * @param object $post
	 * @param array $args
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function display_meta_box( $post, $args ) {

		$view   = 'metaboxes.' . $args['args']['metabox'];
		$prefix = Plugin::get_instance()->prefix;

		View::render( $view, compact( 'prefix', 'post' ) );
	}

	/**
	 * Handles the logic when a post is saved or updated
	 *
	 * @param integer $post_id
	 * @param object $post
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function save( $post_id, $post ) {

		if ( $post->post_type == 'fb_group' ) {
			$group_id = sanitize_text_field( $_POST[ 'group_id' ] );
			$ad_price_once = sanitize_text_field( $_POST[ 'ad_price_once' ] );
			$ad_price_weekly = sanitize_text_field( $_POST[ 'ad_price_weekly' ] );
			$ad_price_monthly = sanitize_text_field( $_POST[ 'ad_price_monthly' ] );
	
			update_post_meta( $post_id, 'group_id', $group_id );
			update_post_meta( $post_id, 'ad_price_once', $ad_price_once );
			update_post_meta( $post_id, 'ad_price_weekly', $ad_price_weekly );
			update_post_meta( $post_id, 'ad_price_monthly', $ad_price_monthly );
		}

		
	}


}
