<?php
/**
 * AdminAjax abstract class file.
 *
 * This file contains AdminAjax abstract class which contains contracts for classes that will handle admin ajax requests.
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

if ( ! class_exists( 'AdminAjax' ) ) {
    /**
     * Class AdminAjax
     *
     * This class contains contracts that will be used to handle admin ajax requests.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class AdminAjax implements ActionHook {
        /**
         * Ajax Action
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $ajax_action;

        /**
         * Nonce Action
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $nonce_action;

        /**
         *  Name of the javascript file that will be enqueued. Should be unique.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $script_handle;

        /**
         * Full URL of the script, or path of the script relative to the WordPress root directory.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $script_src;

        /**
         * An array of registered script handles the script depends on.
         *
         * @access protected
         * @var array
         * @since 1.0.0
         */
        protected array $script_dependencies;

        /**
         * String specifying script version number
         *
         * @access protected
         * @var string|boolean|null
         * @since 1.0.0
         */
        protected string|bool|null $script_version;

        /**
         * Whether to enqueue the script before
         *
         * @access protected
         * @var boolean
         * @since 1.0.0
         */
        protected bool $script_in_footer;

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
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
            add_action( "wp_ajax_{$this->ajax_action}", array( $this, 'handle_admin_ajax_request' ) );
        }

        /**
         * "admin_enqueue_scripts" action hook callback
         *
         * Enqueue the javascript file needed to make the ajax request
         *
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function enqueue_scripts( string $hook_suffix ) : void
        {
            if ( $this->can_enqueue_script( $hook_suffix ) ) {
                wp_enqueue_script( $this->script_handle, $this->script_src, $this->script_dependencies, $this->script_version, $this->script_in_footer );
                wp_add_inline_script( $this->script_handle, $this->get_ajax_data(), 'before' );
            }
        }

        /**
         * "wp_ajax_{$action}" action hook callback
         *
         * Fires authenticated Ajax actions for logged-in users.
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function handle_admin_ajax_request() : void
        {
            check_ajax_referer( $this->nonce_action );
            $this->handle_request();
        }

        /**
         * Generates javascript constant containing ajax data that can be accessible in the javascript file
         *
         * @access private
         * @return string
         * @since 1.0.0
         */
        private function get_ajax_data() : string
        {
            $data = json_encode( array(
                'ajax_url'  => admin_url( 'admin-ajax.php' ),
                'nonce'     => wp_create_nonce( $this->nonce_action ),
                'action'    => $this->ajax_action,
            ) );

            return "const WPS_ADMIN_AJAX_REQUEST = {$data};";
        }

        /**
         * Method to determine which admin page to enqueue the javascript file for making ajax request
         *
         * @abstract
         * @access public
         * @param string $hook_suffix
         * @return boolean
         * @since 1.0.0
         */
        abstract public function can_enqueue_script( string $hook_suffix ) : bool;

        /**
         * Method for handling the ajax request after ajax nonce action have been validated.
         *
         * @abstract
         * @access public
         * @return void
         * @since 1.0.0
         */
        abstract public function handle_request() : void;
    }
}