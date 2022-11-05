<?php
/**
 * PostTypes abstract class file.
 *
 * This file contains PostTypes abstract class which contains contracts for classes that will register custom post types.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'PostTypes' ) ) {
    /**
     * Class PostTypes
     *
     * This class contains contracts that will be used to register custom post types.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class PostTypes implements ActionHook {
        /**
         * Post type key. Must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $post_type;

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
            add_action( 'init', array( $this, 'register' ) );
        }

        /**
         * "init" action hook callback
         *
         * Fires after WordPress has finished loading but before any headers are sent.
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function register() : void
        {
            register_post_type( $this->post_type, $this->post_type_args() );
        }

        /**
         * Unregister a post type
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function unregister() : void
        {
            if ( post_type_exists( $this->post_type ) ) {
                unregister_post_type( $this->post_type );
            }
        }

        /**
         * Post type arguements arguements
         *
         * @abstract
         * @access public
         * @return array
         * @since 1.0.0
         */
        abstract public function post_type_args() : array;
    }
}