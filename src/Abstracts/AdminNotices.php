<?php
/**
 * AdminNotices abstract class file.
 *
 * This file contains AdminNotices abstract class which contains contracts for classes that will register admin notifications.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'AdminNotices' ) ) {
    /**
     * Class AdminNotices
     *
     * This class contains contracts that will be used to register admin notifications.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class AdminNotices implements ActionHook {
        use ViewLoader;

        /**
         * The view for displaying the notice.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $view;

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
            add_action( 'admin_notices', array( $this, 'notification' ) );
        }

        /**
         * "admin_notices" action hook callback
         *
         * Prints admin screen notices.
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function notification() : void
        {
            $this->load_view( $this->view, $this->view_args() );
        }

        /**
         * The arguements to pass to the view
         *
         * @abstract
         * @access public
         * @return array
         * @since 1.0.0
         */
        abstract public function view_args() : array;
    }
}