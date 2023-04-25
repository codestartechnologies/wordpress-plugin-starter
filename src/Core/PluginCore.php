<?php
/**
 * PluginCore class file.
 *
 * This file contains PluginCore class which is the main class responsible for registering and managing all functionalties for your plugin.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Core;

use WPS_Plugin\App\Admin\Hooks as AdminHooks;
use WPS_Plugin\App\Hooks;
use WPS_Plugin\App\Public\Hooks as PublicHooks;
use Codestartechnologies\WordpressPluginStarter\Abstracts\AdminAjax;
use Codestartechnologies\WordpressPluginStarter\Abstracts\AdminNotices;
use Codestartechnologies\WordpressPluginStarter\Abstracts\Menus;
use Codestartechnologies\WordpressPluginStarter\Abstracts\NavMenuMetaboxes;
use Codestartechnologies\WordpressPluginStarter\Abstracts\OptionsMenus;
use Codestartechnologies\WordpressPluginStarter\Abstracts\PluginMenus;
use Codestartechnologies\WordpressPluginStarter\Abstracts\PostColumns;
use Codestartechnologies\WordpressPluginStarter\Abstracts\PostMetaboxes;
use Codestartechnologies\WordpressPluginStarter\Abstracts\PostTypes;
use Codestartechnologies\WordpressPluginStarter\Abstracts\PublicAjax;
use Codestartechnologies\WordpressPluginStarter\Abstracts\Settings;
use Codestartechnologies\WordpressPluginStarter\Abstracts\Shortcodes;
use Codestartechnologies\WordpressPluginStarter\Abstracts\SubMenus;
use Codestartechnologies\WordpressPluginStarter\Abstracts\Taxonomies;
use Codestartechnologies\WordpressPluginStarter\Abstracts\TaxonomyFormFields;
use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Traits\Validator;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * PluginCore class
 *
 * This class is the main class responsible for registering and managing all functionalties for your plugin.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class PluginCore implements ActionHook
{

    use Validator;

    /**
     * Router class
     *
     * Handles custom route endpoints.
     *
     * @access protected
     * @var Router
     * @since 1.0.0
     */
    protected Router $router;

    /**
     * DatabaseUpgrade class
     *
     * Performs database upgrade.
     *
     * @access protected
     * @var DatabaseUpgrade
     * @since 1.0.0
     */
    protected DatabaseUpgrade $database_upgrade;

    /**
     * DatabaseUpgradeNotice class
     *
     * Database upgrade notification.
     *
     * @access protected
     * @var DatabaseUpgradeNotice
     * @since 1.0.0
     */
    protected DatabaseUpgradeNotice $database_upgrade_notice;

    /**
     * Hooks class
     *
     * Register's hooks that will run at the fornt-end and admin area.
     *
     * @access protected
     * @var Hooks
     * @since 1.0.0
     */
    protected Hooks $hooks;

    /**
     * AdminHooks class
     *
     * Registers hooks that will run in admin area only.
     *
     * @access protected
     * @var AdminHooks
     * @since 1.0.0
     */
    protected AdminHooks $admin_hooks;

    /**
     * Classes used for registering admin pages.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\Menus[]
     * @since 1.0.0
     */
    protected array $menu_pages;

    /**
     * Classes used for registering sub-menu pages.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\SubMenus[]
     * @since 1.0.0
     */
    protected array $sub_menu_pages;

    /**
     * Classes used for registering admin pages under "Settings" menu page.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\OptionsMenus[]
     * @since 1.0.0
     */
    protected array $options_pages;

    /**
     * Classes used for registering admin pages under "Plugins" menu page.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\PluginMenus[]
     * @since 1.0.0
     */
    protected array $plugin_pages;

    /**
     * Classes used for registering custom post types.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\PostTypes[]
     * @since 1.0.0
     */
    protected array $post_types;

    /**
     * Classes used for registering custom taxonomies.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\Taxonomies[]
     * @since 1.0.0
     */
    protected array $taxonomies;

    /**
     * Classes used for registering shortcodes.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\Shortcodes[]
     * @since 1.0.0
     */
    protected array $shortcodes;

    /**
     * Classes used for registering metaboxes for different post types.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\PostMetaboxes[]
     * @since 1.0.0
     */
    protected array $post_metaboxes;

    /**
     * Classes used for registering nav menu metaboxes.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\NavMenuMetaboxes[]
     * @since 1.0.0
     */
    protected array $nav_menu_metaboxes;

    /**
     * Classes used for registering setting sections and fields.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\Settings[]
     * @since 1.0.0
     */
    protected array $settings;

    /**
     * Classes used for printing admin notifications.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\AdminNotices[]
     * @since 1.0.0
     */
    protected array $notices;

    /**
     * Classes used for handling ajax requests for admin area.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\AdminAjax[]
     * @since 1.0.0
     */
    protected array $admin_ajax_requests;

    /**
     * Classes used for handling ajax requests for site front-end.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\PublicAjax[]
     * @since 1.0.0
     */
    protected array $public_ajax_requests;

    /**
     * Classes used for registering post columns.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\PostColumns[]
     * @since 1.0.0
     */
    protected array $post_columns;

    /**
     * Classes used for registering setting fields for taxonomies.
     *
     * @access protected
     * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\TaxonomyFormFields[]
     * @since 1.0.0
     */
    protected array $taxonomy_form_fields;

    /**
     * PluginCore constructor
     *
     * @access public
     * @param Router|null $router
     * @param DatabaseUpgrade $database_upgrade
     * @param DatabaseUpgradeNotice $database_upgrade_notice
     * @param Hooks|null $hooks
     * @param AdminHooks|null $admin_hooks
     * @param PublicHooks|null $public_hooks
     * @param array|null $menu_pages
     * @param array|null $sub_menu_pages
     * @param array|null $options_pages
     * @param array|null $plugin_pages
     * @param array|null $post_types
     * @param array|null $taxonomies
     * @param array|null $shortcodes
     * @param array|null $post_metaboxes
     * @param array|null $nav_menu_metaboxes
     * @param array|null $settings
     * @param array|null $notices
     * @param array|null $admin_ajax_requests
     * @param array|null $public_ajax_requests
     * @param array|null $post_columns
     * @param array|null $taxonomy_form_fields
     * @since 1.0.0
     */
    public function __construct(
        Router $router = null,
        DatabaseUpgrade $database_upgrade = null,
        DatabaseUpgradeNotice $database_upgrade_notice = null,
        Hooks $hooks = null,
        AdminHooks $admin_hooks = null,
        array $menu_pages = null,
        array $sub_menu_pages = null,
        array $options_pages = null,
        array $plugin_pages = null,
        array $post_types = null,
        array $taxonomies = null,
        array $shortcodes = null,
        array $post_metaboxes = null,
        array $nav_menu_metaboxes = null,
        array $settings = null,
        array $notices = null,
        array $admin_ajax_requests = null,
        array $public_ajax_requests = null,
        array $post_columns = null,
        array $taxonomy_form_fields = null
    )
    {
        if ( ! is_null( $router ) && ( $router instanceof Router ) ) {
            $this->router = $router;
        }

        if ( ! is_null( $database_upgrade ) && ( $database_upgrade instanceof DatabaseUpgrade ) ) {
            $this->database_upgrade = $database_upgrade;
        }

        if ( ! is_null( $database_upgrade_notice ) && ( $database_upgrade_notice instanceof DatabaseUpgradeNotice ) ) {
            $this->database_upgrade_notice = $database_upgrade_notice;
        }

        if ( ! is_null( $hooks ) && ( $hooks instanceof Hooks ) ) {
            $this->hooks = $hooks;
        }

        if ( ! is_null( $admin_hooks ) && ( $admin_hooks instanceof AdminHooks ) ) {
            $this->admin_hooks = $admin_hooks;
        }

        if ( ! is_null( $menu_pages ) ) {
            $this->menu_pages = $this->validate( $menu_pages, Menus::class )['valid'];
        }

        if ( ! is_null( $sub_menu_pages ) ) {
            $this->sub_menu_pages = $this->validate( $sub_menu_pages, SubMenus::class )['valid'];
        }

        if ( ! is_null( $options_pages ) ) {
            $this->options_pages = $this->validate( $options_pages, OptionsMenus::class )['valid'];
        }

        if ( ! is_null( $plugin_pages ) ) {
            $this->plugin_pages = $this->validate( $plugin_pages, PluginMenus::class )['valid'];
        }

        if ( ! is_null( $post_types ) ) {
            $this->post_types = $this->validate( $post_types, PostTypes::class )['valid'];
        }

        if ( ! is_null( $taxonomies ) ) {
            $this->taxonomies = $this->validate( $taxonomies, Taxonomies::class )['valid'];
        }

        if ( ! is_null( $shortcodes ) ) {
            $this->shortcodes = $this->validate( $shortcodes, Shortcodes::class )['valid'];
        }

        if ( ! is_null( $post_metaboxes ) ) {
            $this->post_metaboxes = $this->validate( $post_metaboxes, PostMetaboxes::class )['valid'];
        }

        if ( ! is_null( $nav_menu_metaboxes ) ) {
            $this->nav_menu_metaboxes = $this->validate( $nav_menu_metaboxes, NavMenuMetaboxes::class )['valid'];
        }

        if ( ! is_null( $settings ) ) {
            $this->settings = $this->validate( $settings, Settings::class )['valid'];
        }

        if ( ! is_null( $notices ) ) {
            $this->notices = $this->validate( $notices, AdminNotices::class )['valid'];
        }

        if ( ! is_null( $admin_ajax_requests ) ) {
            $this->admin_ajax_requests = $this->validate( $admin_ajax_requests, AdminAjax::class )['valid'];
        }

        if ( ! is_null( $public_ajax_requests ) ) {
            $this->public_ajax_requests = $this->validate( $public_ajax_requests, PublicAjax::class )['valid'];
        }

        if ( ! is_null( $post_columns ) ) {
            $this->post_columns = $this->validate( $post_columns, PostColumns::class )['valid'];
        }

        if ( ! is_null( $taxonomy_form_fields ) ) {
            $this->taxonomy_form_fields = $this->validate( $taxonomy_form_fields, TaxonomyFormFields::class )['valid'];
        }
    }

    /**
     * Sets up plugin functionalities
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function init() : void
    {
        $this->register_add_action();

        $this->set_post_types();

        $this->set_taxonomies();

        $this->set_shortcodes();

        $this->set_routes();

        $this->set_hooks();

        $this->set_ajax_handlers();

        if ( is_admin() ) {

            $this->set_menus();

            $this->set_settings();

            $this->set_admin_notices();

            $this->set_post_columns();

            $this->set_taxonomy_form_fields();

            $this->set_admin_hooks();

            $this->show_database_notification();
        }
    }

    /**
     * Register action and filter hooks.
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function register_add_action() : void
    {
        add_action( 'admin_init', array( $this, 'action_admin_init' ) );

        if ( is_admin() ) {

            add_action( 'load-post.php', array( $this, 'set_posts_metaboxes' ) );

            add_action( 'load-post-new.php', array( $this, 'set_posts_metaboxes' ) );

            add_action( 'load-nav-menus.php', array( $this, 'set_nav_menus_metaboxes' ) );
        }
    }

    /**
     * Register custom post types.
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_post_types() : void
    {
        if ( isset( $this->post_types ) ) {
            foreach ( $this->post_types as $post_type ) {
                $post_type->register_add_action();
            }
        }
    }

    /**
     * Register custom taxonomies.
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_taxonomies() : void
    {
        if ( isset( $this->taxonomies ) ) {
            foreach ( $this->taxonomies as $taxonomy ) {
                $taxonomy->register_add_action();
            }
        }
    }

    /**
     * Register shortcodes.
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_shortcodes() : void
    {
        if ( isset( $this->shortcodes ) ) {
            foreach ( $this->shortcodes as $shortcode ) {
                $shortcode->register_add_action();
            }
        }
    }

    /**
     * Register custom route endpoints for site front-end.
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_routes() : void
    {
        if ( isset( $this->router ) ) {
            $this->router->register_add_action();
            $this->router->register_add_filter();
        }
    }

    /**
     * Register hooks that will run at both the admin and front-end area.
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_hooks() : void
    {
        if ( isset( $this->hooks ) ) {
            $this->hooks->register_add_action();
            $this->hooks->register_add_filter();
        }
    }

    /**
     * Handle AJAX request for admin area and front-end.
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function set_ajax_handlers() : void
    {
        if ( isset( $this->admin_ajax_requests ) ) {
            foreach ( $this->admin_ajax_requests as $ajax_request ) {
                $ajax_request->register_add_action();
            }
        }

        if ( isset( $this->public_ajax_requests ) ) {
            foreach ( $this->public_ajax_requests as $ajax_request ) {
                $ajax_request->register_add_action();
            }
        }
    }

    /**
     * Register admin pages
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_menus() : void
    {
        if ( isset( $this->menu_pages ) ) {
            foreach ( $this->menu_pages as $menu_page ) {
                $menu_page->register_add_action();
                $menu_page->register_add_filter();
            }
        }

        if ( isset( $this->sub_menu_pages ) ) {
            foreach ( $this->sub_menu_pages as $sub_menu_page ) {
                $sub_menu_page->register_add_action();
                $sub_menu_page->register_add_filter();
            }
        }

        if ( isset( $this->options_pages ) ) {
            foreach ( $this->options_pages as $option_page ) {
                $option_page->register_add_action();
                $option_page->register_add_filter();
            }
        }

        if ( isset( $this->plugin_pages ) ) {
            foreach ( $this->plugin_pages as $plugin_page ) {
                $plugin_page->register_add_action();
                $plugin_page->register_add_filter();
            }
        }
    }

    /**
     * Register setting sections and fields
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_settings() : void
    {
        if ( isset( $this->settings ) ) {
            foreach ( $this->settings as $setting ) {
                $setting->register_add_action();
            }
        }
    }

    /**
     * Register admin notices.
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_admin_notices() : void
    {
        if ( isset( $this->notices ) ) {
            foreach ( $this->notices as $notice ) {
                $notice->register_add_action();
            }
        }
    }

    /**
     * Register custom post columns
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_post_columns() : void
    {
        if ( isset( $this->post_columns ) ) {
            foreach ( $this->post_columns as $column ) {
                $column->register_add_filter();
            }
        }
    }

    /**
     * Register custom form fields for taxonomies.
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function set_taxonomy_form_fields() : void
    {
        if ( isset( $this->taxonomy_form_fields ) ) {
            foreach ( $this->taxonomy_form_fields as $form_field ) {
                $form_field->register_add_action();
            }
        }
    }

    /**
     * Register hooks that will run only at the admin area
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_admin_hooks() : void
    {
        if ( isset( $this->admin_hooks ) ) {
            $this->admin_hooks->register_add_action();
            $this->admin_hooks->register_add_filter();
        }
    }

    /**
     * Print database upgrade notification
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function show_database_notification() : void
    {
        if ( isset( $this->database_upgrade_notice ) ) {
            $this->database_upgrade_notice->register_add_action();
        }
    }

    /**
     * Fires as an admin screen or script is being initialized.
     *
     * @return void
     * @since 1.0.0
     */
    public function action_admin_init() : void
    {
        // Handle database upgrade
        if ( isset( $_GET['wps_database_upgrade'] ) && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'handle_db_upgrade' ) ) {
            $this->handle_database_upgrade();
        }
    }

    /**
     * Register metaboxes for different post types.
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function set_posts_metaboxes() : void
    {
        if ( isset( $this->post_metaboxes ) ) {
            foreach ( $this->post_metaboxes as $metabox ) {
                $metabox->register_add_action();
            }
        }
    }

    /**
     * Register metaboxes for navigation menus.
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function set_nav_menus_metaboxes() : void
    {
        if ( isset( $this->nav_menu_metaboxes ) ) {
            foreach ( $this->nav_menu_metaboxes as $metabox ) {
                $metabox->metabox();
            }
        }
    }

    /**
     * Perform database upgrade
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function handle_database_upgrade() : void
    {
        if ( $this->database_upgrade->can_perform_upgrade() ) {
            $this->database_upgrade->run_upgrade();
        }

        wp_safe_redirect( admin_url() );
        exit;
    }
}