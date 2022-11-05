<?php
/**
 * Bindings class file.
 *
 * This file contains Bindings class which returns classes that will be registered with the plugin.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @since      1.0.0
 */

namespace App;

use App\Admin\AdminNotices\WPSAdminNotice;
use App\Admin\AjaxRequests\WPSAdminAjaxRequest;
use App\Admin\Menus\WPSMenu;
use App\Admin\Menus\WPSPluginMenu;
use App\Admin\Menus\WPSSettingMenu;
use App\Admin\Menus\WPSSubMenu;
use App\Admin\NavMenuMetaboxes\WPSNavMenuMetabox;
use App\Admin\PostColumns\WPSPostColumn;
use App\Admin\PostMetaboxes\WPSPostMetabox;
use App\Admin\Settings\WPSSetting;
use App\Admin\TaxonomyFormFields\WPSTaxonomyFormField;
use App\Public\AjaxRequests\WPSPublicAjaxRequest;
use App\Public\PostTypes\WPSPostType;
use App\Public\Shortcodes\WPSShortcode;
use App\Public\Taxonomies\WPSTaxonomy;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Bindings' ) ) {
    /**
     * Class Bindings
     *
     * This class returns classes that will be registered with the plugin.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Bindings {
        /**
         * Bindings for classes that register admin menus
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $menus = array(
            WPSMenu::class,
        );

        /**
         * Bindings for classes that register submenus
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $sub_menus = array(
            WPSSubMenu::class,
        );

        /**
         * Bindings for classes that register setting menus
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $setting_menus = array(
            WPSSettingMenu::class,
        );

        /**
         * Bindings for classes that register plugin menus
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $plugin_menus = array(
            WPSPluginMenu::class,
        );

        /**
         * Bindings for classes that register post types
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $post_types = array(
            WPSPostType::class,
        );

        /**
         * Bindings for classes that register taxonomies
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $taxonomies = array(
            WPSTaxonomy::class,
        );

        /**
         * Bindings for classes that register shortcodes
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $shortcodes = array(
            WPSShortcode::class,
        );

        /**
         * Bindings for classes that register post metaboxes
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $post_metaboxes = array(
            WPSPostMetabox::class,
        );

        /**
         * Bindings for classes that register nav menu metaboxes
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $nav_menu_metaboxes = array(
            WPSNavMenuMetabox::class,
        );

        /**
         * Bindings for classes that register settings
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $settings = array(
            WPSSetting::class,
        );

        /**
         * Bindings for classes that create admin notices
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $admin_notices = array(
            WPSAdminNotice::class,
        );

        /**
         * Bindings for classes that create admin ajax requests
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $admin_ajax_requests = array(
            WPSAdminAjaxRequest::class,
        );

        /**
         * Bindings for classes that create public ajax requests
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $public_ajax_requests = array(
            WPSPublicAjaxRequest::class,
        );

        /**
         * Bindings for classes that create post columns
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $post_columns = array(
            WPSPostColumn::class,
        );

        /**
         * Bindings for classes that create taxonomy fields
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $taxonomy_fields = array(
            WPSTaxonomyFormField::class,
        );
    }
}


