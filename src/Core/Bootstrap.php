<?php
/**
 * Bootstrap class file.
 *
 * This file contains Bootstrap class which bootstraps all the functionalties needed by your plugin.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://codestar.com.ng
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

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Bootstrap' ) ) {
    /**
     * Class Bootstrap
     *
     * This class handles and manages all functionalities needed by this plugin.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Bootstrap implements ActionHook {
        use Validator;

        /**
         * This class handles routes that will be registered in the frontend.
         *
         * @access protected
         * @var Router
         * @since 1.0.0
         */
        protected Router $router;

        /**
         * This class registers hooks that will run at the fornt-end and admin area.
         *
         * @access protected
         * @var Hooks
         * @since 1.0.0
         */
        protected Hooks $hooks;

        /**
         * This class registers hooks that will run in admin area.
         *
         * @access protected
         * @var AdminHooks
         * @since 1.0.0
         */
        protected AdminHooks $admin_hooks;

        /**
         * This class registers hooks that will run in site frontend.
         *
         * @access protected
         * @var PublicHooks
         * @since 1.0.0
         */
        protected PublicHooks $public_hooks;

        /**
         * Bindings for classes that register admin menus
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\Menus[]
         * @since 1.0.0
         */
        protected array $menu_pages;

        /**
         * Bindings for classes that register sub menus
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\SubMenus[]
         * @since 1.0.0
         */
        protected array $sub_menu_pages;

        /**
         * Bindings for classes that register setting menus
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\OptionsMenus[]
         * @since 1.0.0
         */
        protected array $options_pages;

        /**
         * Bindings for classes that register plugin menus
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\PluginMenus[]
         * @since 1.0.0
         */
        protected array $plugin_pages;

        /**
         * Bindings for classes that register post types
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\PostTypes[]
         * @since 1.0.0
         */
        protected array $post_types;

        /**
         * Bindings for classes that register taxonomies
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\Taxonomies[]
         * @since 1.0.0
         */
        protected array $taxonomies;

        /**
         * Bindings for classes that register shortcodes
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\Shortcodes[]
         * @since 1.0.0
         */
        protected array $shortcodes;

        /**
         * Bindings for classes that register post metaboxes
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\PostMetaboxes[]
         * @since 1.0.0
         */
        protected array $post_metaboxes;

        /**
         * Bindings for classes that register nav menus metaboxes
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\NavMenuMetaboxes[]
         * @since 1.0.0
         */
        protected array $nav_menu_metaboxes;

        /**
         * Bindings for classes that register settings
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\Settings[]
         * @since 1.0.0
         */
        protected array $settings;

        /**
         * Bindings for classes that register admin notices
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\AdminNotices[]
         * @since 1.0.0
         */
        protected array $notices;

        /**
         * Bindings for classes that register admin ajax requests
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\AdminAjax[]
         * @since 1.0.0
         */
        protected array $admin_ajax_requests;

        /**
         * Bindings for classes that register public ajax requests
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\PublicAjax[]
         * @since 1.0.0
         */
        protected array $public_ajax_requests;

        /**
         * Bindings for classes that register post columns
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\PostColumns[]
         * @since 1.0.0
         */
        protected array $post_columns;

        /**
         * Bindings for classes that register taxonomy fields
         *
         * @access protected
         * @var \Codestartechnologies\WordpressPluginStarter\Abstracts\TaxonomyFormFields[]
         * @since 1.0.0
         */
        protected array $taxonomy_form_fields;

        /**
         * Bootstrap Class Constructor
         *
         * @access public
         * @param Router|null $router
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
            Hooks $hooks = null,
            AdminHooks $admin_hooks = null,
            PublicHooks $public_hooks = null,
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

            if ( ! is_null( $router ) ) {
                $this->router = $router;
            }

            if ( ! is_null( $hooks ) ) {
                $this->hooks = $hooks;
            }

            if ( ! is_null( $admin_hooks ) ) {
                $this->admin_hooks = $admin_hooks;
            }

            if ( ! is_null( $public_hooks ) ) {
                $this->public_hooks = $public_hooks;
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
         * Method to run plugin functionalities
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

            $this->set_ajax_handlers();
        }

        /**
         * Register add_action() and remove_action().
         *
         * @access public
         * @return void
         * @since 1.0.0
         */
        public function register_add_action() : void
        {
            if ( isset( $this->hooks ) ) {
                $this->hooks->register_add_action();
                $this->hooks->register_add_filter();
            }

            if ( is_admin() ) {

                $this->set_menus();

                $this->set_settings();

                $this->set_admin_notices();

                $this->set_post_columns();

                add_action( 'load-post.php', array( $this, 'set_posts_metaboxes' ) );

                add_action( 'load-post-new.php', array( $this, 'set_posts_metaboxes' ) );

                add_action( 'load-nav-menus.php', array( $this, 'set_nav_menus_metaboxes' ) );

                $this->set_taxonomy_form_fields();

                if ( isset( $this->admin_hooks ) ) {
                    $this->admin_hooks->register_add_action();
                    $this->admin_hooks->register_add_filter();
                }
            } else {

                $this->router->register_add_action();
                $this->router->register_add_filter();

                if ( isset( $this->public_hooks ) ) {
                    $this->public_hooks->register_add_action();
                    $this->public_hooks->register_add_filter();
                }
            }
        }

        /**
         * Method to set menu pages
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
         * Method to register settings
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
         * Method to set admin notices.
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
         * Method to set post columns
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
         * Method to set post types.
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
         * Method to set taxonomies.
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
         * Method to set shortcodes.
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
         * Method to set post metaboxes.
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
         * Method to set navigation menus metaboxes.
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
         * Method to set taxonomy form fields.
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
         * Method to set AJAX request that will be made to the admin and public end.
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
    }
}