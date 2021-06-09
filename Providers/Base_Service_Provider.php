<?php


namespace Facebook_Group_Ads\Providers;


abstract class Base_Service_Provider {
	/**
	 * Registers wordpress action hooks and filters.
	 *
	 * @return mixed
	 *
	 * @since 1.0.0
	 */
	abstract public function register();

	/**
	 * Callback function for wordpress action hooks and filters
	 *
	 * @return mixed
	 *
	 * @since 1.0.0
	 */
	abstract public function run();
}
