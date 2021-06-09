<?php


namespace Facebook_Group_Ads\Providers;


use Facebook_Group_Ads\Controllers\Settings_Controller;
use Facebook_Group_Ads\Plugin;

class Settings_Service_Provider extends Base_Service_Provider {

	private $settings_controller;

	public function __construct() {
		$this->settings_controller = new Settings_Controller();
	}

	/**
	 * Registers wordpress action hooks and filters.
	 *
	 * @return mixed|void
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_action( 'admin_init', [ $this, 'run' ] );
	}

	public function run() {
		register_setting( 'general', Plugin::get_instance()->prefix . 'woocomerce_product_id' );
		register_setting( 'general', Plugin::get_instance()->prefix . 'fb_app_id' );
		register_setting( 'general', Plugin::get_instance()->prefix . 'fb_app_secret' );
		register_setting( 'general', Plugin::get_instance()->prefix . 'fb_page_id' );
		register_setting( 'general', Plugin::get_instance()->prefix . 'email' );

		add_settings_section( 'general', 'Settings', [
			$this->settings_controller,
			'display_general_settings'
		], 'general' );

		
		add_settings_field( Plugin::get_instance()->prefix . 'fb_app_id', 'Facebook App ID', [
			$this->settings_controller,
			'display_setting_field'
		], 'general', 'general', [ 'field' => 'fb_app_id' ] );
		
		add_settings_field( Plugin::get_instance()->prefix . 'fb_app_secret', 'Facebook App Secret', [
			$this->settings_controller,
			'display_setting_field'
		], 'general', 'general', [ 'field' => 'fb_app_secret' ] );

		add_settings_field( Plugin::get_instance()->prefix . 'fb_page_id', 'Facebook Page ID', [
			$this->settings_controller,
			'display_setting_field'
		], 'general', 'general', [ 'field' => 'fb_page_id' ] );
		
		add_settings_field( Plugin::get_instance()->prefix . 'woocomerce_product_id', 'Woocomerce Product ID for Ad', [
			$this->settings_controller,
			'display_setting_field'
		], 'general', 'general', [ 'field' => 'woocomerce_product_id' ] );

		add_settings_field( Plugin::get_instance()->prefix . 'email', 'Email for Notifications', [
			$this->settings_controller,
			'display_setting_field'
		], 'general', 'general', [ 'field' => 'email' ] );
		
		add_settings_field( Plugin::get_instance()->prefix . 'fb_login', 'Login & Authorize App with Facebook', [
			$this->settings_controller,
			'display_setting_field'
		], 'general', 'general', [ 'field' => 'fb_login' ] );
	}
}
