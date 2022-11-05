<?php
/**
 * PostsColumn interface file.
 *
 * This file contains PostsColumn interface. Classes that will register post columns will need to implement this interface.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Interfaces;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! interface_exists( 'PostsColumn' ) ) {
    /**
     * Interface PostsColumn
     *
     * Classes that will register post columns will need to implement this interface.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    interface PostsColumn extends FilterHook {
        /**
         * "manage_{$post_type}_posts_columns" filter hook callback
         *
         * Filters the columns displayed in the Posts list table for a specific post type.
         *
         * @access public
         * @param string[] $post_columns An associative array of column headings.
         * @return string[] An associative array of column headings.
         * @since 1.0.0
         */
        public function manage_posts_columns( array $post_columns ) : array;

        /**
         * "manage_{$post_type}_posts_custom_column" filter hook callback
         *
         * Fires for each custom column of a specific post type in the Posts list table.
         *
         * @access public
         * @param string $column_name The name of the column to display.
         * @param integer $post_id The current post ID.
         * @return void
         * @since 1.0.0
         */
        public function manage_posts_custom_column( string $column_name, int $post_id ) : void;
    }
}