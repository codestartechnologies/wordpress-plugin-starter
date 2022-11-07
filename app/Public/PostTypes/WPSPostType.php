<?php
/**
 * WPSPostType class file.
 *
 * This file contains WPSPostType class that will register a custom post type.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Public\PostTypes;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PostTypes;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSPostType' ) ) {
    /**
     * Class WPSPostType
     *
     * This class registers a custom post type.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSPostType extends PostTypes {
        /**
         * WPSPostType Class Constructor
         *
         */
        public function __construct()
        {
            $this->post_type = 'wps_post';
        }

        /**
         * Returns arguements needed to register the custom post type.
         *
         * @return array
         */
        public function post_type_args() : array
        {
            return array(
                'labels'                => $this->get_labels(),
                'description'           => esc_html__( 'Archive for displaying WPS Posts.', 'wps' ),
                'public'                => true,
                'publicly_queryable'    => true,
                'show_in_rest'          => true,
                'menu_position'         => 6,
                'menu_icon'             => 'dashicons-rss',
                'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'post-formats', 'comments', ),
                'has_archive'           => true,
                'rewrite'               => array( 'slug' => 'wps_posts', ),
                'delete_with_user'      => false,
            );
        }

        /**
         * Returns labels for the custom post type.
         *
         * @return array
         */
        public function get_labels() : array
        {
            return array(
                'name'                      => esc_html_x( 'WPS Posts', 'post type general name', 'wps' ),
                'singular_name'             => esc_html_x( 'WPS Post', 'post type singular name', 'wps' ),
                'add_new_item'              => esc_html__( 'Add New WPS Post', 'wps' ),
                'edit_item'                 => esc_html__( 'Edit WPS Post', 'wps' ),
                'new_item'                  => esc_html__( 'New WPS Post', 'wps' ),
                'view_item'                 => esc_html__( 'View WPS Post', 'wps' ),
                'view_items'                => esc_html__( 'View WPS Posts', 'wps' ),
                'search_items'              => esc_html__( 'Search WPS Post', 'wps' ),
                'not_found'                 => esc_html__( 'No wps post found', 'wps' ),
                'not_found_in_trash'        => esc_html__( 'No wps post found in Trash', 'wps' ),
                'all_items'                 => esc_html__( 'All WPS Posts', 'wps' ),
                'archives'                  => esc_html__( 'WPS Post Archives', 'wps' ),
                'attributes'                => esc_html__( 'WPS Post Attributes', 'wps' ),
                'insert_into_item'          => esc_html__( 'Insert into wps post', 'wps' ),
                'uploaded_to_this_item'     => esc_html__( 'Uploaded to this wps post', 'wps' ),
                'filter_items_list'         => esc_html__( 'Filter wps post list', 'wps' ),
                'items_list_navigation'     => esc_html__( 'WPS Post list navigation', 'wps' ),
                'items_list'                => esc_html__( 'WPS Post list', 'wps' ),
                'item_published'            => esc_html__( 'WPS Post published', 'wps' ),
                'item_published_privately'  => esc_html__( 'WPS Post published privately', 'wps' ),
                'item_reverted_to_draft'    => esc_html__( 'WPS Post reverted to draft', 'wps' ),
                'item_scheduled'            => esc_html__( 'WPS Post scheduled', 'wps' ),
                'item_updated'              => esc_html__( 'WPS Post updated', 'wps' ),
                'item_link'                 => esc_html__( 'WPS Post Link', 'wps' ),
                'item_link_description'     => esc_html__( 'A link to a wps post', 'wps' ),
            );
        }
    }
}