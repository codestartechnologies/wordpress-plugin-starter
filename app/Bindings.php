<?php
/**
 * Bindings class file.
 *
 * This file contains Bindings class which returns classes that will be registered with the plugin.
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
 * Class Bindings
 *
 * This class returns classes that will be registered with the plugin.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class Bindings
{
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
        WPSBasicShortcode::class,
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
        WPSAdvancedPostMetabox::class,
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