<?php
/**
 * WPSTaxonomy class file.
 *
 * This file contains WPSTaxonomy class that will register a custom taxonomy.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Public\Taxonomies;

use Codestartechnologies\WordpressPluginStarter\Abstracts\Taxonomies;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WPSTaxonomy
 *
 * This class registers a custom taxonomy.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSTaxonomy extends Taxonomies
{
    /**
     * WPSTaxonomy Class Constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->taxonomy = 'wps_post_category';
    }

    /**
     * An array of objects types the taxonomy belongs to
     *
     * @return array
     * @since 1.0.0
     */
    public function object_types() : array
    {
        return array( 'wps_post' );
    }

    /**
     * The taxonomy arguements
     *
     * @return array
     * @since 1.0.0
     */
    public function taxonomy_args() : array
    {
        return array(
            'labels'                => $this->get_labels(),
            'description'           => esc_html__( 'Post categories in WPS Posts.', 'wps' ),
            'show_in_rest'          => true,
            'show_admin_column'     => true,
        );
    }

    /**
     * The taxonomy labels
     *
     * @return array
     * @since 1.0.0
     */
    public function get_labels() : array
    {
        return array(
            'name'                          => esc_html_x( 'WPS Post Categories', 'taxonomy general name', 'wps' ),
            'singular_name'                 => esc_html_x( 'WPS Post Category', 'taxonomy singular name', 'wps' ),
            'all_items'                     => esc_html__( 'All WPS Post Categories', 'wps' ),
            'edit_item'                     => esc_html__( 'Edit WPS Post Category', 'wps' ),
            'view_item'                     => esc_html__( 'View WPS Post Category', 'wps' ),
            'update_item'                   => esc_html__( 'Update WPS Post Category', 'wps' ),
            'add_new_item'                  => esc_html__( 'Add New WPS Post Category', 'wps' ),
            'new_item_name'                 => esc_html__( 'New WPS Post Category Name', 'wps' ),
            'search_items'                  => esc_html__( 'Search WPS Post Categories', 'wps' ),
            'popular_items'                 => esc_html__( 'Popular WPS Post Categories', 'wps' ),
            'separate_items_with_commas'    => esc_html__( 'Separate wps post categories with commas', 'wps' ),
            'add_or_remove_items'           => esc_html__( 'Add or remove wps post categories', 'wps' ),
            'choose_from_most_used'         => esc_html__( 'Choose from the most used wps post categories', 'wps' ),
            'not_found'                     => esc_html__( 'No wps post categories found', 'wps' ),
            'back_to_items'                 => esc_html__( '← Back to wps post categories', 'wps' ),
            'no_terms'                      => esc_html__( 'No wps post categories', 'wps' ),
            'items_list_navigation'         => esc_html__( 'WPS Post Categories list navigation', 'wps' ),
            'items_list'                    => esc_html__( 'WPS Post Categories list', 'wps' ),
            'item_link'                     => esc_html__( 'WPS Post Category Link', 'wps' ),
            'item_link_description'         => esc_html__( 'A link to a wps post category', 'wps' ),
        );
    }
}