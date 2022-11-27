<?php
/**
 * PostColumns abstract class file.
 *
 * This file contains PostColumns abstract class which contains contracts for classes that will register post columns.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Interfaces\PostsColumn;
use Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'PostColumns' ) ) {
    /**
     * Class PostColumns
     *
     * This class contains contracts that will be used to register post columns.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class PostColumns implements PostsColumn {
        use ViewLoader;

        /**
         * The post type slug
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $post_type;

        /**
         * The meta key to retrieve.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $meta_key;

        /**
         * Optional. Whether to return a single value. This parameter has no effect if $key is not specified. Default false.
         *
         * @access protected
         * @var boolean
         * @since 1.0.0
         */
        protected bool $is_single_key = false;

        /**
         * The post column key identifier. Should only be separated by an underscore.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $column_key;

        /**
         * The post column title
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $column_title;

        /**
         * The post column view
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $view;

        /**
         * Register add_filter() and remove_filter().
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function register_add_filter() : void
        {
            add_filter( "manage_{$this->post_type}_posts_columns", array( $this, 'manage_posts_columns' ) );
            add_filter( "manage_{$this->post_type}_posts_custom_column", array( $this, 'manage_posts_custom_column' ), 10, 2 );
        }

        /**
         * "manage_{$post_type}_posts_columns" filter hook callback
         *
         * Filters the columns displayed in the Posts list table for a specific post type.
         *
         * @final
         * @access public
         * @param string[] $post_columns An associative array of column headings.
         * @return string[] An associative array of column headings.
         * @since 1.0.0
         */
        final public function manage_posts_columns( array $post_columns ) : array
        {
            $post_columns[ $this->column_key ] = $this->column_title;
            return $post_columns;
        }

        /**
         * "manage_{$post_type}_posts_custom_column" filter hook callback
         *
         * Fires in each custom column in the Posts list table.
         *
         * @final
         * @access public
         * @param string $column_name The name of the column to display.
         * @param int    $post_id     The current post ID.
         * @since 1.0.0
         */
        final public function manage_posts_custom_column( string $column_name, int $post_id ) : void
        {
            if ( $column_name === $this->column_key ) {
                $meta_value = get_post_meta( $post_id, $this->meta_key, $this->is_single_key );
                $this->load_view( $this->view, array(
                    'post_id'       => $post_id,
                    'meta_key'      => $this->meta_key,
                    'meta_value'    => $meta_value,
                ), 'admin', false );
            }
        }
    }
}