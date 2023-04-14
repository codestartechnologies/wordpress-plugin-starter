<?php
/**
 * Plugin Class
 *
 * This file contains Plugin Class which is designed using singletone design pattern.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter;

use WPS_Plugin\App\Admin\Hooks as AdminHooks;
use WPS_Plugin\App\Bindings;
use WPS_Plugin\App\Hooks;
use WPS_Plugin\App\Public\Hooks as PublicHooks;
use WPS_Plugin\App\Constants as AppConstants;
use Codestartechnologies\WordpressPluginStarter\Core\Activator;
use Codestartechnologies\WordpressPluginStarter\Core\Bootstrap;
use Codestartechnologies\WordpressPluginStarter\Core\Constants;
use Codestartechnologies\WordpressPluginStarter\Core\Deactivator;
use Codestartechnologies\WordpressPluginStarter\Core\Router;
use Codestartechnologies\WordpressPluginStarter\Core\Uninstaller;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Plugin Class
 *
 * This class is used to create a WordPress plugin. It is the main file of your plugin.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @since   0.1.0
 */
final class Plugin
{
    /**
     * The plugin instance
     *
     * @access private
     * @static
     * @var Plugin
     * @since 1.0.0
     */
    private static Plugin $instance;

    /**
     * Object that bootstrap the core functionalities of the plugin.
     *
     * @access private
     * @var Bootstrap
     * @since 1.0.0
     */
    private Bootstrap $bootstrap;

    /**
     * Plugin constructor
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function __construct()
    {
        // Require composer autoloader file for autoloading classes.
        require_once trailingslashit( plugin_dir_path( WPS_FILE ) ) . 'vendor/autoload.php';

        // Require wordpress plugin starter autoloader file for autoloading classes.
        require_once trailingslashit( plugin_dir_path( WPS_FILE ) ) . 'autoload.php';

        // Define core constants required by wordpress plugin starter.
        Constants::define_core_constants();

        // Define custom constants.
        AppConstants::define_constants();

        // Sets the activation hook for a plugin.
        register_activation_hook( WPS_FILE, function () {
            $this->activate( new Activator() );
        } );

        // Sets the deactivation hook for a plugin.
        register_deactivation_hook( WPS_FILE, function () {
            $this->deactivate( new Deactivator() );
        } );

        // Sets the uninstallation hook for a plugin.
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
     * @return Plugin
     * @since 1.0.0
     */
    public static function get_instance() : Plugin
    {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Initialize classes.
     *
     * @access private
     * @param array $classes
     * @return array
     * @since 1.0.0
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