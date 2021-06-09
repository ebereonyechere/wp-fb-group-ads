<?php

namespace Facebook_Group_Ads;

use Freemius;
use Facebook_Group_Ads\Controllers\Infinity_Bar_Template_Controller;

/**
 * Main plugin class, responsible for managing all service providers and freemius integration
 *
 * Class Plugin
 * @package Facebook_Group_Ads
 *
 * @since 1.0.0
 */
class Plugin {
	private static $instance = null;

	/**
	 * Plugin version
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $version = '1.0.0';

    /**
	 * Plugin unique prefix
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $prefix = 'fb_group_ads_';

    /**
	 * Plugin CPT name
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $cpt = 'fb_grp_ad';

    private $bootstrapper;
    /**
     * Plugin Service providers that hook plugin into wordpress via action hooks and filters
     * @var array
     *
     * @since 1.0.0
     */
    protected $providers = [
        Providers\Menu_Service_Provider::class,
         Providers\Assets_Service_Provider::class,
        Providers\Cpt_Service_Provider::class,
        Providers\Short_Codes_Service_Provider::class,
        Providers\Settings_Service_Provider::class,
        Providers\Meta_Boxes_Service_Provider::class,
        Providers\Ajax_Service_Provider::class,
        Providers\Woo_Commerce_Service_Provider::class,
    ];

    /**
	 * Plugin constructor.
	 *
	 * @access private
	 * @since 1.0.0
	 */
	private function __construct() {
		$this->bootstrapper = new Bootstrapper( $this->providers );
	}

	/**
	 * Init plugin and instantiate all service providers
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function init() {
		$this->bootstrapper->run();
	}

	/**
	 * Get the plugin's absolute path
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function get_path() {
		return plugin_dir_path( __FILE__ ) . '/';
	}

	/**
	 * Get the plugin's absolute url
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function get_url() {
		return plugin_dir_url( __FILE__ );
	}

    /**
     * Runs all code for plugin activation procedures
     *
     * @return void
     *
     * @since 1.0.0
     */
	public function activate() {
		$is_activated = get_option( $this->get_prefix() . 'activated', false);

		if ( ! $is_activated ) {
			update_option( $this->get_prefix() . 'activated', time() );
		}

		update_option( self::get_instance()->get_prefix() . 'version', self::get_instance()->get_version() );

	}

	/**
	 * Get current instance of plugin
	 *
	 * @return Plugin|null
	 *
	 * @since 1.0.0
	 */
	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

    /**
     * Runs all code for plugin deactivation procedures
     *
     * @return void
     *
     * @since 1.0.0
     */
	public function deactivate() {
		wp_clear_scheduled_hook( 'fb_buy_ads_publish_ads' );
	}

    /**
     * Runs all code for plugin uninstall procedures
     *
     * @return void
     *
     * @since 1.0.0
     */
	public function uninstall() {

	}

	/**
	 * Get plugin's unique prefix
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	public function get_prefix() {
		return $this->prefix;
	}

    /**
     * Get the current plugin version
     *
     * @return string
     *
     * @since 1.0.0
     */
	public function get_version() {
	    return $this->version;
    }

    /**
     * Get the namespace for all rest api routes
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function get_api_route_namespace() {
	    return 'facebook-group-ads/v1/';
    }
}
