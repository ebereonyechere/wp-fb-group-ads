<?php


namespace Facebook_Group_Ads\Providers;

use Facebook_Group_Ads\Plugin;

class Cpt_Service_Provider extends Base_Service_Provider {

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

	public function run() {

		register_post_type( 'fb_group', [
			'label' => 'Facebook Group Ads',
			'labels' => [
				'name' => 'Facebook Groups',
				'singular_name' => 'Facebook Group',
				'add_new' => 'Add Facebook Group',
				'add_new_item' => 'Add Facebook Group',
				'edit_item' => 'Edit Facebook Group',
				'new_item' => 'New Facebook Group',
				'view_item' => 'View Facebook Group',
				'view_items' => 'View Facebook Groups',
				'search_items' => 'Search Facebook Groups',
				'all_items' => 'All Facebook Groups',
				'menu_name' => 'Facebook Groups',
				'item_published' => 'Facebook Group added'
			],
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_in_nav_menus' => false,
			'show_in_admin_bar' => false,
			'show_in_rest' => false,
			'supports' => ['title']
		] );

		flush_rewrite_rules();
	}

}
