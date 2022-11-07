<?php
/**
 * WPSMenu class file.
 *
 * This file contains WPSMenu class that will register a custom admin menu page.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\Menus;

use Codestartechnologies\WordpressPluginStarter\Abstracts\Menus;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSMenu' ) ) {
    /**
     * WPSMenu Class
     *
     * This class registers a custom admin menu page.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSMenu extends Menus {
        /**
         * WPSMenu constructor
         *
         */
        public function __construct()
        {
            $this->page_title   = esc_html__( 'WPS Admin Menu Page', 'wps' );
            $this->menu_title   = esc_html__( 'WPS Menu', 'wps' );
            $this->capability   = 'manage_options';
            $this->menu_slug    = 'wps-menu';
            $this->icon_url     = 'dashicons-menu';
            $this->position     = null;
            $this->view         = 'admin-menu-pages.wps-menu';
        }

        /**
         * Fires before a particular screen is loaded. Example can be to handle POST or GET request sent to the menu page
         *
         * @return void
         */
        public function load_page() : void
        {
            //
        }

        /**
         * Arguements to pass to the menu page view
         *
         * @return array
         */
        public function menu_page_view_args() : array
        {
            return array(
                'random_text'   => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis cupiditate corrupti quibusdam sapiente ea nisi odit molestias, id consectetur explicabo molestiae fugiat perspiciatis rem nemo ipsam pariatur perferendis corporis sed?',
            );
        }

        /**
         * The content to display in the footer of the admin menu page
         *
         * @param string $text
         * @return string
         */
        public function get_footer_content( string $text ) : string
        {
            $text = sprintf( '<b>%s</b>', esc_html__( 'WPS Admin Menu Page - Created Using WordPress Plugin Starter.', 'wps' ) );

            return $text;
        }
    }
}