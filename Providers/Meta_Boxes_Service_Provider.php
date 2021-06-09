<?php


namespace Facebook_Group_Ads\Providers;


use Facebook_Group_Ads\Controllers\Meta_Boxes_Controller;
use Facebook_Group_Ads\Plugin;

class Meta_Boxes_Service_Provider extends Base_Service_Provider {

	private $meta_boxes_controller;

	public function __construct() {
		$this->meta_boxes_controller = new Meta_Boxes_Controller();
	}

	/**
	 * Registers wordpress action hooks and filters.
	 *
	 * @return mixed|void
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_action( 'admin_menu', [ $this, 'run' ] );
		add_action( 'save_post', [ $this->meta_boxes_controller, 'save' ], 10, 2 );
	}

	public function run() {
		remove_meta_box( 'submitdiv', 'fb_group', 'side' );

		add_meta_box( 'submitdiv', 'Publish', [
			$this->meta_boxes_controller,
			'display_submit_meta_box'
		], 'fb_group', 'side' );

		add_meta_box( 'group_id', 'Group ID', [
			$this->meta_boxes_controller,
			'display_meta_box'
		], 'fb_group', 'normal', 'default', [ 'metabox' => 'group_id' ] );

		add_meta_box( 'ad_price', 'Ad Price', [
			$this->meta_boxes_controller,
			'display_meta_box'
		], 'fb_group', 'normal', 'default', [ 'metabox' => 'ad_price' ] );

		add_meta_box( 'ad_details', 'Ad Details', [
			$this->meta_boxes_controller,
			'display_meta_box'
		], 'shop_order', 'side', 'core', [ 'metabox' => 'ad_details' ] );
	}

}
