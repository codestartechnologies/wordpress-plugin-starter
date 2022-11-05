<?php
/**
 * Taxonomies abstract class file.
 *
 * This file contains Taxonomies abstract class which contains contracts for classes that will register custom taxonomies.
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

if ( ! class_exists( 'Taxonomies' ) ) {
    /**
     * Class Taxonomies
     *
     * This class contains contracts that will be used to register custom taxonomies.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class Taxonomies implements ActionHook {
        /**
         * Taxonomy key, must not exceed 32 characters.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $taxonomy;

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
            register_taxonomy( $this->taxonomy, $this->object_types(), $this->taxonomy_args() );

            foreach ( $this->object_types() as $object_type ) {
                register_taxonomy_for_object_type( $this->taxonomy, $object_type );
            }
        }

        /**
         * Unregister a taxonomy
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function unregister() : void
        {
            if ( taxonomy_exists( $this->taxonomy ) ) {
                unregister_taxonomy( $this->taxonomy );
            }

            foreach ( $this->object_types() as $object_type ) {
                if ( post_type_exists( $object_type ) ) {
                    unregister_taxonomy_for_object_type( $this->taxonomy, $object_type );
                }
            }
        }

        /**
         * An array of objects types the taxonomy belongs to
         *
         * @abstract
         * @access public
         * @return array
         * @since 1.0.0
         */
        abstract public function object_types() : array;

        /**
         * The taxonomy arguements
         *
         * @abstract
         * @access public
         * @return array
         * @since 1.0.0
         */
        abstract public function taxonomy_args() : array;
    }
}