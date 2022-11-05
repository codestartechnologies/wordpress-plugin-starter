<?php
/**
 * PostMetaboxes abstract class file.
 *
 * This file contains PostMetaboxes abstract class which contains contracts for classes that will register metaboxes for post types.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;
use WP_Post;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'PostMetaboxes' ) ) {
    /**
     * Class PostMetaboxes
     *
     * This class contains contracts that will be used to register metaboxes for post types.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class PostMetaboxes implements ActionHook {
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
         * The screen or screens on which to show the box (such as a post type, 'link', or 'comment').
         * Accepts a single screen ID, WP_Screen object, or array of screen IDs. Default is the current screen.
         * If you have used add_menu_page() or add_submenu_page() to create a new screen (and hence screen_id),
         * make sure your menu slug conforms to the limits of sanitize_key() otherwise the 'screen' menu may not correctly render on your page.
         *
         * @access protected
         * @var array
         * @since 1.0.0
         */
        protected array $screens;

        /**
         * Optional. The context within the screen where the box should display. Available contexts vary from screen to screen.
         * Post edit screen contexts include 'normal', 'side', and 'advanced'. Comments screen contexts include 'normal' and 'side'.
         * Menus meta boxes (accordion sections) all use the 'side' context. Global default is 'advanced'.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $context = 'advanced';

        /**
         * Optional. The priority within the context where the box should show. Accepts 'high', 'core', 'default', or 'low'. Default 'default'.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $priority = 'default';

        /**
         * Metadata key.
         *
         * Used in add_post_meta() and update_post_meta()
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $meta_key;

        /**
         * Optional. Whether to return a single value. This parameter has no effect if $key is not specified. Default false.
         *
         * Used in get_post_meta()
         *
         * @var boolean
         */
        protected bool $is_single_key = false;

        /**
         *  Action name for generating nonce field.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $nonce_action;

        /**
         * Nonce name for generating nonce field.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $nonce_name;

        /**
         * Optional. Whether the same key should not be added. Default false.
         *
         * Used in add_post_meta()
         *
         * @var boolean
         */
        protected bool $is_unique_key = false;

        /**
         * The metabox view
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $metabox_view;

        /**
         * Register add_action() and remove_action().
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function register_add_action() : void
        {
            add_action( 'add_meta_boxes', array( $this, 'metabox' ), 10, 2 );
            add_action( 'save_post', array( $this, 'save' ), 10, 3 );
        }

        /**
         * "add_meta_boxes" action hook callback
         *
         * Fires after all built-in meta boxes have been added.
         *
         * @final
         * @access public
         * @param string   $post_type Post type.
         * @param \WP_Post $post      Post object.
         * @since 1.0.0
         */
        final public function metabox( string $post_type, \WP_Post $post ) : void
        {
            if ( in_array( $post_type, $this->screens, true ) && current_user_can( 'manage_options' ) ) {
                add_meta_box( $this->id, $this->title, array( $this, 'metabox_cb' ), $post_type, $this->context, $this->priority );
            }
        }

        /**
         * "save_post" action hook callback
         *
         * Fires once a post has been saved.
         *
         * @final
         * @access public
         * @param int      $post_ID Post ID.
         * @param \WP_Post $post    Post object.
         * @param bool     $update  Whether this is an existing post being updated.
         * @since 1.0.0
         */
        final public function save( int $post_ID, \WP_Post $post, bool $update ) : void
        {
            if ( in_array( $post->post_type, $this->screens) && $this->validate_save( $post_ID ) ) {
                if ( $update ) {
                    update_post_meta( $post_ID, $this->meta_key, $this->get_meta_value() );
                } else {
                    add_post_meta( $post_ID, $this->meta_key, $this->get_meta_value(), $this->is_unique_key );
                }
            }
        }

        /**
         * add_meta_box() callback
         *
         * Method that fills the box with the desired content. The function should echo its output.
         *
         * @abstract
         * @access public
         * @param \WP_Post $post
         * @return void
         * @since 1.0.0
         */
        final public function metabox_cb( \WP_Post $post ) : void
        {
            wp_nonce_field( $this->nonce_action, $this->nonce_name );
            $meta_value = get_post_meta( $post->ID, $this->meta_key, $this->is_single_key );
            $this->load_view( $this->metabox_view, array(
                'meta_key'      => $this->meta_key,
                'meta_value'    => $meta_value,
                'post'          => $post,
            ) );
        }

        /**
         * Method to validate request made when adding a saving or updating a metabox value
         *
         * @access private
         * @param integer $post_ID
         * @return boolean
         * @since 1.0.0
         */
        private function validate_save( int $post_ID ) : bool
        {
            return (
                isset( $_POST[ $this->nonce_name ] ) &&
                wp_verify_nonce( $_POST[ $this->nonce_name ], $this->nonce_action ) &&
                current_user_can( 'manage_options' ) &&
                ! wp_is_post_autosave( $post_ID ) &&
                ! wp_is_post_revision( $post_ID ) &&
                ! ( is_multisite() && ms_is_switched() )
            );
        }

        /**
         * Method to sanitize and return the metabox value sent via a POST request. Can be inherited and customized by child classes.
         *
         * @access protected
         * @return mixed
         * @since 1.0.0
         */
        protected function get_meta_value() : mixed
        {
            return ( is_array( $_POST[ $this->meta_key ] ) )
                ? wp_kses_post_deep( $_POST[ $this->meta_key ] )
                : wp_strip_all_tags( $_POST[ $this->meta_key ] );
        }

        /**
         * Deletes the registered post meta
         *
         * @final
         * @static
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public static function delete() : void
        {
            delete_post_meta_by_key( self::$meta_key );
        }
    }
}