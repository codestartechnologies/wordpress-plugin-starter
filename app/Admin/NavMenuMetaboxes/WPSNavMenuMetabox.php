<?php
/**
 * WPSNavMenuMetabox class file.
 *
 * This file contains WPSNavMenuMetabox class that will register a custom navigation menu metabox with items.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\NavMenuMetaboxes;

use Codestartechnologies\WordpressPluginStarter\Abstracts\NavMenuMetaboxes;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSNavMenuMetabox' ) ) {
    /**
     * WPSNavMenuMetabox class
     *
     * This class registers a custom navigation menu metabox with items.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSNavMenuMetabox extends NavMenuMetaboxes {
        /**
         * WPSNavMenuMetabox Class Constructor
         *
         */
        public function __construct()
        {
            $this->id = 'wps_pages_nav_menu_box';
            $this->title = esc_html__( 'WPS Pages', 'wps' );
            $this->plugin_slug = 'wps';
        }

        /**
         * Returns an array that contains array(s) of settings for a nav menu metabox items.
         *
         * Keys that are required in each array are:
         * menu_item_type_label     - Nav Menu Item Label
         * menu_item_title          - Nav Menu Item Title
         * menu_item_url            - Nav Menu Item Url
         *
         * @return array
         */
        public function metabox_items_data() : array
        {
            return array(
                array(
                    'menu_item_type_label'  => esc_html__( 'WPS Custom Page', 'wps' ),
                    'menu_item_title'       => esc_html__( 'WPS Page', 'wps' ),
                    'menu_item_url'         => site_url( 'wps-page' ),
                ),
                array(
                    'menu_item_type_label'  => esc_html__( 'WPS Custom Page 2', 'wps' ),
                    'menu_item_title'       => esc_html__( 'WPS Page 2', 'wps' ),
                    'menu_item_url'         => site_url( 'wps-page-2' ),
                ),
            );
        }
    }
}