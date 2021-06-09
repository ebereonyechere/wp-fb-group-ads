<?php


namespace Facebook_Group_Ads\Providers;

use Facebook_Group_Ads\Controllers\Menus_Controller;
use Facebook_Group_Ads\Plugin;

class Menu_Service_Provider extends Base_Service_Provider {

	private $menus_controller;

	public function __construct() {
		$this->menus_controller = new Menus_Controller();
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
	}

	/**
	 * Callback function for the registered hooks and filters
	 *
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	public function run() {
		// add_menu_page( 'Infinity Bar', 'Infinity Bar', 'manage_options', 'infinity_bar', [ $this->menus_controller, 'render_admin_app' ], '', null );
		add_submenu_page( 'edit.php?post_type=fb_group', 'Settings', 'Settings', 'manage_options', 'settings', [ $this->menus_controller, 'render_settings_page' ]);
	}
}
