<?php


namespace Facebook_Group_Ads\Controllers;

use Facebook_Group_Ads\Plugin;
use Facebook_Group_Ads\Helpers\View;


/**
 * Class SettingsController
 * @package SuperAffiliateLinks\Controllers
 *
 * @since 1.0.0
 */
class Settings_Controller extends Base_Controller {

	/**
	 * Display help text for general settings tab
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function display_general_settings() {
		// echo 'General Settings';
	}
	
	/**
	 * Displays the relevant settings field
	 *
	 * @param array $args
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function display_setting_field( $args ) {
		$view    = 'settings.' . $args['field'];
		$prefix  = Plugin::get_instance()->prefix;
		$setting = get_option( $args['field'] );

		View::render( $view, compact( 'prefix' ) );
	}

}
