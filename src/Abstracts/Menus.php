<?php
/**
 * Menus abstract class file.
 *
 * This file contains Menus abstract class which contains contracts for classes that will register admin menu pages.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Interfaces\FilterHook;
use Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Menus' ) ) {
    /**
     * Class Menus
     *
     * This class contains contracts that will be used to register admin menu pages.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class Menus implements ActionHook, FilterHook {
        use ViewLoader;

        /**
         * The text to be displayed in the title tags of the page when the menu is selected.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $page_title;

        /**
         * The text to be used for the menu.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $menu_title;

        /**
         * The capability required for this menu to be displayed to the user.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $capability;

        /**
         * The slug name to refer to this menu by.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $menu_slug;

        /**
         * The URL to the icon to be used for this menu.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $icon_url = '';

        /**
         * The position in the menu order this item should appear.
         *
         * @access protected
         * @var integer
         * @since 1.0.0
         */
        protected ?int $position = null;

        /**
         * The view that will be rendered in the menu page.
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
            if ( $this->can_add_menupage() ) {
                $hook_suffix = $this->get_menu_hookname();
                add_action( 'admin_menu', array( $this, 'menu_page' ) );
                add_action( "load-{$hook_suffix}", array( $this, 'load_page' ) );
            }
        }

        /**
         * Register add_filter() and remove_filter().
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function register_add_filter(): void
        {
            add_filter( 'admin_footer_text', array( $this, 'footer_text' ) );
        }

        /**
         * Check before adding the menu page
         *
         * @access protected
         * @return boolean
         * @since 1.0.0
         */
        protected function can_add_menupage() : bool
        {
            return true;
        }

        /**
         * The menu page hook name
         *
         * @access protected
         * @return string
         * @since 1.0.0
         */
        protected function get_menu_hookname() : string
        {
            return 'toplevel_page_' . $this->menu_slug;
        }

        /**
         * "admin_menu" action hook callback
         *
         * Method to create admin menu page.
         *
         * @access public
         * @return void
         * @since 1.0.0
         */
        public function menu_page() : void
        {
            $hook_suffix = add_menu_page(
                $this->page_title,
                $this->menu_title,
                $this->capability,
                $this->menu_slug,
                array( $this, 'menu_page_cb' ),
                $this->icon_url,
                $this->position
            );
        }

        /**
         * "admin_footer_text" filter hook callback
         *
         * Filters the "Thank you" text displayed in the admin footer.
         *
         * @final
         * @access public
         * @param string $text The content that will be printed.
         * @return string The content that will be printed.
         * @since 1.0.0
         */
        final public function footer_text( string $text ) : string
        {
            if ( isset( $_GET['page'] ) && $this->menu_slug === $_GET['page'] ) {
                return call_user_func_array( array( $this, 'get_footer_content' ), array( $text ) );
            }

        	return $text;
        }

        /**
         * add_menu_page() callback
         *
         * The function to be called to output the content for this page.
         *
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function menu_page_cb() : void
        {
            if ( ! current_user_can( $this->capability ) ) {
                return;
            }

            $this->load_view( $this->view, $this->menu_page_view_args() );
        }

        /**
         * "load-{$page_hook}" action hook callback
         *
         * Fires before a particular screen is loaded. Example can be to handle POST or GET request sent to the menu page
         *
         * @abstract
         * @access public
         * @return void
         * @since 1.0.0
         */
        abstract public function load_page() : void;

        /**
         * Arguements to pass to the menu page view
         *
         * @abstract
         * @access public
         * @return array
         * @since 1.0.0
         */
        abstract public function menu_page_view_args() : array;

        /**
         * The content to display in the footer of the admin menu page
         *
         * @abstract
         * @access public
         * @param string $text
         * @return string
         * @since 1.0.0
         */
        abstract public function get_footer_content( string $text ) : string;
    }
}