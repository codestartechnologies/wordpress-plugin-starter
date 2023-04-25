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
     * PluginCore class
     *
     * Main class for managing all plugin functionalities.
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
     * Post Types
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $post_types;

    /**
     * Taxonomies
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $taxonomies;

    /**
     * Database Tables
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $database_tables;

    /**
     * Settings
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $settings;

    /**
     * Post Meta boxes
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $post_metaboxes;

    /**
     * Admin Pages
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $menus;

    /**
     * Sub Menu Pages
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $sub_menus;

    /**
     * "Settings" Pages
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $setting_menus;

    /**
     * "Plugins" Pages
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $plugin_menus;

    /**
     * Shortcodes
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $shortcodes;

    /**
     * Nav Menu Meta Boxes
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $nav_menu_metaboxes;

    /**
     * Admin Notices
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $admin_notices;

    /**
     * Admin Ajax Requests
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $admin_ajax_requests;

    /**
     * Front-end Ajax Requests
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $public_ajax_requests;

    /**
     * Post Columns
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $post_columns;

    /**
     * Taxonomy Form Fields
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $taxonomy_fields;

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

        // Initialize WPSPlugin class properties.
        $this->setup();

        // Initialize DatabaseUpgrade class for performing database upgrade when needed.
        $this->database_upgrade = new DatabaseUpgrade( $this->database_tables );

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
     * Sets up plugin dependencies
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function setup() : void
    {
        $this->post_types = self::create_objects( Bindings::$post_types );
        $this->taxonomies = self::create_objects( Bindings::$taxonomies );
        $this->database_tables = self::create_objects( Bindings::$database_tables );
        $this->settings = self::create_objects( Bindings::$settings );
        $this->post_metaboxes = self::create_objects( Bindings::$post_metaboxes );
        $this->menus = self::create_objects( Bindings::$menus );
        $this->sub_menus = self::create_objects( Bindings::$sub_menus );
        $this->setting_menus = self::create_objects( Bindings::$setting_menus );
        $this->plugin_menus = self::create_objects( Bindings::$plugin_menus );
        $this->shortcodes = self::create_objects( Bindings::$shortcodes );
        $this->nav_menu_metaboxes = self::create_objects( Bindings::$nav_menu_metaboxes );
        $this->admin_notices = self::create_objects( Bindings::$admin_notices );
        $this->admin_ajax_requests = self::create_objects( Bindings::$admin_ajax_requests );
        $this->public_ajax_requests = self::create_objects( Bindings::$public_ajax_requests );
        $this->post_columns = self::create_objects( Bindings::$post_columns );
        $this->taxonomy_fields = self::create_objects( Bindings::$taxonomy_fields );
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
            $this->post_types,
            $this->taxonomies
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
            $this->post_types,
            $this->taxonomies
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
            self::create_objects( Bindings::$settings ),
            self::create_objects( Bindings::$post_metaboxes ),
            new DatabaseUpgrade( self::create_objects( Bindings::$database_tables ) )
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
     * Create objects from classes.
     *
     * @access private
     * @param array $classes
     * @return array
     * @since 1.0.0
     */
    private static function create_objects( array $classes = array() ) : array
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
     * Initialize plugin with functionalities.
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
            $this->menus,
            $this->sub_menus,
            $this->setting_menus,
            $this->plugin_menus,
            $this->post_types,
            $this->taxonomies,
            $this->shortcodes,
            $this->post_metaboxes,
            $this->nav_menu_metaboxes,
            $this->settings,
            $this->admin_notices,
            $this->admin_ajax_requests,
            $this->public_ajax_requests,
            $this->post_columns,
            $this->taxonomy_fields
        );
        $this->plugin_core->init();
    }
}