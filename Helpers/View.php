<?php


namespace Facebook_Group_Ads\Helpers;


use Facebook_Group_Ads\Plugin;

class View {

	private static $base = 'Views/';

	public static function render( $view, $vars = [] ) {

		foreach ( $vars as $var => $value ) {
			$$var = $value;
		}

		if ( $view_parts = explode( '.', $view ) ) {
			include_once Plugin::get_instance()->get_path() . self::$base . implode( '/', $view_parts ) . '.php';
		} else {
			include_once Plugin::get_instance()->get_path() . self::$base . $view . '.php';
		}
	}
}
