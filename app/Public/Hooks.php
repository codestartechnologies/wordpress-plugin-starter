<?php
/**
 * Hooks class file.
 *
 * This file contains Hooks class which registers hooks that will run in site frontend.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace WPS_Plugin\App\Public;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Interfaces\FilterHook;
use WP_Query;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Hooks
 *
 * This class registers hooks that will run in site frontend.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
class Hooks implements ActionHook, FilterHook
{
    /**
     * Register add_action() and remove_action().
     *
     * @return void
     * @since 1.0.0
     */
    public function register_add_action() : void
    {
        /**
         * Add your custom action hooks below.
         *
         * Below are custom action hooks that are added by default. You can chose to delete or comment out the lines below if your plugin
         * will not need these features.
         */

        // Fires after the query variable object is created, but before the actual query is run.
        add_action( 'pre_get_posts', array( $this, 'action_pre_get_posts' ) );
    }

    /**
     * Register add_filter() and remove_filter().
     *
     * @return void
     * @since 1.0.0
     */
    public function register_add_filter() : void
    {
        /**
         * Add your custom filter hooks below.
         *
         * Below are custom filter hooks that are added by default. You can chose to delete or comment out the lines below if your plugin
         * will not need these features.
         */

        // Filters the post content.
        add_filter( 'the_content', array( $this, 'filter_the_content' ) );
    }

    /**
     * "pre_get_posts" action hook callback
     *
     * Fires after the query variable object is created, but before the actual query is run.
     *
     * @param \WP_Query $query The WP_Query instance (passed by reference).
     * @return void
     * @since 1.0.0
     */
    public function action_pre_get_posts( \WP_Query $query ) : void
    {
        if ( ! is_admin() && $query->is_main_query() ) {

            if ( is_post_type_archive( 'wps_post' ) ) {

                $tax_array = array();
                $tax_array['relation'] = 'AND';

                // sort items by taxonomy "wps_post_category"
                if ( isset( $_GET['category'] ) && ! empty( $_GET['category'] ) ) {
                    $tax_array[] = array(
                        'taxonomy'  => 'wps_post_category',
                        'field'     => 'slug',
                        'terms'     => sanitize_text_field( $_GET['category'] ),
                    );
                }

                $query->set( 'tax_query', $tax_array );

                // sort items by meta value "wps_post_type_id"
                if ( isset( $_GET['type'] ) && ! empty( $_GET['type'] ) ) {
                    $query->set( 'meta_key', 'wps_post_type_id' );
                    $query->set( 'meta_value', sanitize_text_field( $_GET['type'] ) );
                    $query->set( 'meta_compare', '=' );
                }

            }
        }
    }

    /**
     * "the_content" filter hook callback
     *
     * Filters the post content.
     *
     * @param string $content Content of the current post.
     * @return string Content of the current post.
     * @since 1.0.0
     */
    public function filter_the_content( string $content ) : string
    {
        // append ajax button to post content
        $ajax_button = __( '<p><br /><button data-id="wps_public_ajax_btn" style="padding: 9px;background-color: teal;color: #fff;cursor: pointer;border: 0;">Click to make an AJAX request!</button><br /><b>You must be logged out to test this functionality</b></p><br />', 'wps' );
        return $content .= $ajax_button;
    }

}