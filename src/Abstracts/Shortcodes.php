<?php
/**
 * Shortcodes abstract class file.
 *
 * This file contains Shortcodes abstract class which contains contracts for classes that will register shortcodes.
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

if ( ! class_exists( 'Shortcodes' ) ) {
    /**
     * Class Shortcodes
     *
     * This class contains contracts that will be used to register shortcodes.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class Shortcodes implements ActionHook {
        /**
         * Shortcode tag to be searched in post content.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $tag;

        /**
         * Shortcode Type
         *
         * Can be **basic** or **advanced**. **advanced** is used for shortcodes with parameters. Default advanced
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $type = 'advanced';

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
            if ( $this->can_display_shortcode() ) {
                add_action( 'init', array( $this, 'add_code' ) );
            }
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
        final public function add_code() : void
        {
            switch ( $this->type ) {
                case 'basic':
                    add_shortcode( $this->tag, array( $this, 'simple_shortcode_cb' ) );
                    break;
                case 'advanced':
                    add_shortcode( $this->tag, array( $this, 'shortcode_cb' ) );
                    break;
            }
        }

        /**
         * shortcode callback
         *
         * @final
         * @access public
         * @param array  $atts    attributes which can pass throw shortcode in front end
	     * @param string $content The content between starting and closing shortcode tag
	     * @param string $tag     The name of the shortcode tag
         * @return string
         * @since 1.0.0
         */
        final public function shortcode_cb( array $atts, string $content, string $tag ) : string
        {
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );
            $shortcode_attributes = shortcode_atts( $this->default_attributes(), $atts, $tag );
            ob_start();
            $this->display( $shortcode_attributes, $content, $tag );
            return ob_get_clean();
        }

        /**
         * Shortcode callback for shortcode without attributes
         *
         * @final
         * @access public
         * @return string
         * @since 1.0.0
         */
        final public function simple_shortcode_cb() : string
        {
            ob_start();
            $this->display( array(), '', '' );
            return ob_get_clean();
        }

        /**
         * Method to check when to register the shortcode
         *
         * @abstract
         * @access public
         * @return boolean
         * @since 1.0.0
         */
        abstract public function can_display_shortcode() : bool;

        /**
         * Default shortcode attributes
         *
         * @abstract
         * @access public
         * @return array
         * @since 1.0.0
         */
        abstract public function default_attributes() : array;

        /**
         * Method to display the contents of the shortcode
         *
         * @abstract
         * @access public
         * @param array  $filtered_attributes       The combined and filtered attribute list.
	     * @param string $content                   The content between starting and closing shortcode tag
	     * @param string $tag                       The name of the shortcode tag
         * @return void
         * @since 1.0.0
         */
        abstract public function display( array $filtered_attributes, string $content, string $tag ) : void;
    }
}