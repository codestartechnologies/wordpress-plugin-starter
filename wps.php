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
use Codestartechnologies\WordpressPluginStarter\Core\PluginCore;
use Codestartechnologies\WordpressPluginStarter\Core\Constants;
use Codestartechnologies\WordpressPluginStarter\Core\DatabaseUpgrade;
use Codestartechnologies\WordpressPluginStarter\Core\DatabaseUpgradeNotice;
use Codestartechnologies\WordpressPluginStarter\Core\Deactivator;
use Codestartechnologies\WordpressPluginStarter\Core\Router;
use Codestartechnologies\WordpressPluginStarter\Core\Uninstaller;
use Dotenv\Dotenv;
use WPS_Plugin\App\Activator as AppActivator;
use WPS_Plugin\App\Deactivator as AppDeactivator;
use WPS_Plugin\App\Uninstaller as AppUninstaller;

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
     * @var PluginCore
     * @since 1.0.0
     */
    private PluginCore $plugin_core;

    /**
     * DatabaseUpgrade Class
     *
     * @access private
     * @var DatabaseUpgrade
     * @since 1.0.0
     */
    private DatabaseUpgrade $database_upgrade;

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

        // Set up phpdotenv for use in the application.
        $dotenv = Dotenv::createImmutable( __DIR__ );
        $dotenv->safeLoad();

        // Define core constants required by wordpress plugin starter.
        Constants::define_core_constants();

        // Define custom constants.
        AppConstants::define_constants();

        // Initialize DatabaseUpgrade class for performing database upgrade when needed.
        $this->database_upgrade = new DatabaseUpgrade( self::boot( Bindings::$database_tables ) );

        // Sets the activation hook for a plugin.
        register_activation_hook( WPS_FILE, function () {
            $this->activate( new Activator( $this->database_upgrade ) );
            AppActivator::run();
        } );

        // Sets the deactivation hook for a plugin.
        register_deactivation_hook( WPS_FILE, function () {
            $this->deactivate( new Deactivator() );
            AppDeactivator::run();
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
            self::boot( Bindings::$post_metaboxes ),
            new DatabaseUpgrade( self::boot( Bindings::$database_tables ) )
        );
        AppUninstaller::run();
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
        $this->plugin_core = new PluginCore(
            new Router(),
            $this->database_upgrade,
            new DatabaseUpgradeNotice(),
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
        $this->plugin_core->init();
    }
}