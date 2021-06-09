<?php


namespace Facebook_Group_Ads;

/**
 * Instantiates all service providers and gets plugin ready for use.
 *
 * Class Bootstrapper
 * @package Facebook_Group_Ads
 *
 * @since 1.0.0
 */
class Bootstrapper {

	private $providers = [];

	public function __construct( $providers ) {
		$this->providers = $providers;
	}

	public function run() {
		foreach ( $this->providers as $provider ) {
			$service = new $provider;
			$service->register();
		}
	}

}
