<?php
/**
 * NavMenuMetaboxes abstract class file.
 *
 * This file contains NavMenuMetaboxes abstract class which contains contracts for classes that will register navigation menu metaboxes.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;
use Walker_Nav_Menu_Checklist;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'NavMenuMetaboxes' ) ) {
    /**
     * Class NavMenuMetaboxes
     *
     * This class contains contracts that will be used to register navigation menu metaboxes.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class NavMenuMetaboxes {
        use ViewLoader;

        /**
         * Meta box ID (used in the 'id' attribute for the meta box).
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $id;

        /**
         * Title of the meta box.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $title;

        /**
         * Plugin Slug
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $plugin_slug;

        /**
         * Method to add metaboxes to nav menu screens
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function metabox() : void
        {
            add_meta_box( $this->id, $this->title, array( $this, 'metabox_cb' ), 'nav-menus', 'side', 'core' );
        }

        /**
         * add_meta_box() callback
         *
         * Function that fills the box with the desired content. The function should echo its output.
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function metabox_cb() : void
        {
            global $nav_menu_selected_id;

            // Create an array of objects that imitate Post objects
            $my_items = array();

            foreach ( $this->metabox_items_data() as $setting ) {
                $my_items[] = ( object ) array(
                    'ID'                => 1,
                    'object_id'         => 1,
                    'type_label'        => $setting['menu_item_type_label'] ?? null,
                    'title'             => $setting['menu_item_title'] ?? null,
                    'url'               => $setting['menu_item_url'] ?? null,
                    'type'              => 'custom',
                    'object'            => $this->plugin_slug . '-' . $this->id . '-slug',
                    'db_id'             => 0,
                    'menu_item_parent'  => 0,
                    'post_parent'       => 0,
                    'target'            => '',
                    'attr_title'        => '',
                    'description'       => '',
                    'classes'           => array(),
                    'xfn'               => '',
                );
            }

            $db_fields = false;

            // If your links will be hierarchical, adjust the $db_fields array below

            if ( ! $db_fields ) {
                $db_fields = array( 'parent' => 'parent', 'id' => 'post_parent' );
            }

            $walker = new Walker_Nav_Menu_Checklist( $db_fields );
            $removed_args = array( 'action', 'customlink-tab', 'edit-menu-item', 'menu-item', 'page-tab', '_wpnonce', );

            $this->load_core_view( 'wps-nav-menu-metabox', array(
                'nav_menu_selected_id'  => $nav_menu_selected_id,
                'my_items'              => $my_items,
                'walker'                => $walker,
                'identifier'            => $this->plugin_slug . '-' . $this->id,
            ) );
        }

        /**
         * Returns an array that contains array(s) of settings for a nav menu metabox items.
         *
         * Keys that are required in each array are:
         * menu_item_type_label     - Nav Menu Item Label
         * menu_item_title          - Nav Menu Item Title
         * menu_item_url            - Nav Menu Item Url
         *
         * @abstract
         * @access public
         * @return array
         * @since 1.0.0
         */
        abstract public function metabox_items_data() : array;
    }
}