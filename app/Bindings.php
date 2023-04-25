<?php
/**
 * Bindings class file.
 *
 * This file contains Bindings class which is used to register classes that will add functionalities to the plugin.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App;

use WPS_Plugin\App\Admin\AdminNotices\WPSAdminNotice;
use WPS_Plugin\App\Admin\AjaxRequests\WPSAdminAjaxRequest;
use WPS_Plugin\App\Admin\DatabaseTables\WPSUsersTable;
use WPS_Plugin\App\Admin\Menus\WPSMenu;
use WPS_Plugin\App\Admin\Menus\WPSPluginMenu;
use WPS_Plugin\App\Admin\Menus\WPSSettingMenu;
use WPS_Plugin\App\Admin\Menus\WPSSubMenu;
use WPS_Plugin\App\Admin\NavMenuMetaboxes\WPSNavMenuMetabox;
use WPS_Plugin\App\Admin\PostColumns\WPSPostColumn;
use WPS_Plugin\App\Admin\PostMetaboxes\WPSAdvancedPostMetabox;
use WPS_Plugin\App\Admin\PostMetaboxes\WPSPostMetabox;
use WPS_Plugin\App\Admin\Settings\WPSSetting;
use WPS_Plugin\App\Admin\TaxonomyFormFields\WPSTaxonomyFormField;
use WPS_Plugin\App\Public\AjaxRequests\WPSPublicAjaxRequest;
use WPS_Plugin\App\Public\PostTypes\WPSPostType;
use WPS_Plugin\App\Public\Shortcodes\WPSBasicShortcode;
use WPS_Plugin\App\Public\Shortcodes\WPSShortcode;
use WPS_Plugin\App\Public\Taxonomies\WPSTaxonomy;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Bindings class
 *
 * This class is used to register classes that will add functionalities to the plugin.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class Bindings
{
    /**
     * Classes that will create admin pages.
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
     * Classes that will create sub-menu pages.
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
     * Classes that will create admin pages under `Settings`.
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
     * Classes that will create admin pages under `Plugins`.
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
     * Classes that register custom post types
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
     * Classes that register custom taxonomies
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
     * Classes that register shortcodes
     *
     * @static
     * @access public
     * @var array
     * @since 1.0.0
     */
    public static array $shortcodes = array(
        WPSShortcode::class,
        WPSBasicShortcode::class,
    );

    /**
     * Classes that register post metaboxes
     *
     * @static
     * @access public
     * @var array
     * @since 1.0.0
     */
    public static array $post_metaboxes = array(
        WPSPostMetabox::class,
        WPSAdvancedPostMetabox::class,
    );

    /**
     * Classes that will create nav menu metaboxes
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
     * Classes that will create settings sections and fields.
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
     * Classes that will create admin notifications.
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
     * Classes that will handle ajax requests in the admin area.
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
     * Classes that will handle ajax requests on site front-end.
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
     * Classes that will create post columns.
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
     * Classes that will create taxonomy form fields.
     *
     * @static
     * @access public
     * @var array
     * @since 1.0.0
     */
    public static array $taxonomy_fields = array(
        WPSTaxonomyFormField::class,
    );

    /**
     * Classes that will create database tables.
     *
     * @static
     * @access public
     * @var array
     * @since 1.0.0
     */
    public static array $database_tables = array(
        WPSUsersTable::class,
    );
}