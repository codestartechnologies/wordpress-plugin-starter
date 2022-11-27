<?php

use WPS_Plugin\App\Admin\Hooks as AdminHooks;
use WPS_Plugin\App\Bindings;
use WPS_Plugin\App\Hooks;
use WPS_Plugin\App\Public\Hooks as PublicHooks;
use WPS_Plugin\App\WPSConstants;
use Codestartechnologies\WordpressPluginStarter\Core\Activator;
use Codestartechnologies\WordpressPluginStarter\Core\Bootstrap;
use Codestartechnologies\WordpressPluginStarter\Core\Constants;
use Codestartechnologies\WordpressPluginStarter\Core\Deactivator;
use Codestartechnologies\WordpressPluginStarter\Core\Router;
use Codestartechnologies\WordpressPluginStarter\Core\Uninstaller;


/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSPlugin Class
 *
 * This class is used to create a WordPress plugin. It is the main file of your plugin.
 *
 * @package WordpressPluginStarter
 * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link https://codestar.com.ng
 * @license GNU/AGPLv3
 * @since 0.1.0
 */
final class WPSPlugin {
    /**
     * The plugin instance
     *
     * @access private
     * @static
     * @var WPSPlugin
     * @since 1.0.0
     */
    private static WPSPlugin $instance;

    /**
     * Object that bootstrap the core functionalities of the plugin.
     *
     * @access private
     * @var Bootstrap
     * @since 1.0.0
     */
    private Bootstrap $bootstrap;

    /**
     * WPSPlugin constructor
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function __construct()
    {
        require_once trailingslashit( plugin_dir_path( WPS_FILE ) ) . 'vendor/autoload.php';

        require_once trailingslashit( plugin_dir_path( WPS_FILE ) ) . 'autoload.php';

        Constants::define_core_constants();

        WPSConstants::define_constants();

        register_activation_hook( WPS_FILE, function () {
            $this->activate( new Activator() );
        } );

        register_deactivation_hook( WPS_FILE, function () {
            $this->deactivate( new Deactivator() );
        } );

        register_uninstall_hook( WPS_FILE, array( __CLASS__, 'uninstall' ) );
    }

    /**
     * Fires when plugin is activated
     *
     * @access public
     * @param Activator $activator
     * @return void
     * @since 1.0.0
     */
    public function activate( Activator $activator ) : void
    {
        $activator->run(
            self::boot( Bindings::$post_types ),
            self::boot( Bindings::$taxonomies )
        );
    }

    /**
     * Fires when plugin is deactivated
     *
     * @access public
     * @param Deactivator $deactivator
     * @return void
     * @since 1.0.0
     */
    public function deactivate( Deactivator $deactivator ) : void
    {
        $deactivator->run(
            self::boot( Bindings::$post_types ),
            self::boot( Bindings::$taxonomies )
        );
    }

    /**
     * Fires when plugin is deleted
     *
     * @access public
     * @static
     * @return void
     * @since 1.0.0
     */
    public static function uninstall() : void
    {
        Uninstaller::run(
            self::boot( Bindings::$settings ),
            self::boot( Bindings::$post_metaboxes )
        );
    }

    /**
     * Creates or returns the plugin instance
     *
     * @access public
     * @return WPSPlugin
     * @since 1.0.0
     */
    public static function get_instance() : WPSPlugin
    {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Initialize classes.
     *
     * @param array $classes
     * @return array
     */
    private static function boot( array $classes = array() ) : array
    {
        $objects_array = array();

        if ( ! empty( $classes ) ) {
            foreach ( $classes as $class ) {
                if ( class_exists( $class ) ) {
                    $objects_array[] = new $class();
                }
            }
        }

        return $objects_array;
    }

    /**
     * Method to bootstrap all plugin functionalities.
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function run() : void
    {
        $this->bootstrap = new Bootstrap(
            new Router( wps_config( 'routes.routes' ) ),
            new Hooks,
            new AdminHooks(),
            new PublicHooks(),
            self::boot( Bindings::$menus ),
            self::boot( Bindings::$sub_menus ),
            self::boot( Bindings::$setting_menus ),
            self::boot( Bindings::$plugin_menus ),
            self::boot( Bindings::$post_types ),
            self::boot( Bindings::$taxonomies ),
            self::boot( Bindings::$shortcodes ),
            self::boot( Bindings::$post_metaboxes ),
            self::boot( Bindings::$nav_menu_metaboxes ),
            self::boot( Bindings::$settings ),
            self::boot( Bindings::$admin_notices ),
            self::boot( Bindings::$admin_ajax_requests ),
            self::boot( Bindings::$public_ajax_requests ),
            self::boot( Bindings::$post_columns ),
            self::boot( Bindings::$taxonomy_fields )
        );
        $this->bootstrap->init();
    }
}

$wps_plugin = WPSPlugin::get_instance();
$wps_plugin->run();
