<?php
/**
 * PluginMenus abstract class file.
 *
 * This file contains PluginMenus abstract class which contains contracts for classes that will register admin plugin menu pages.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'PluginMenus' ) ) {
    /**
     * Class PluginMenus
     *
     * This class contains contracts that will be used to register admin plugin menu pages.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class PluginMenus extends Menus {
        /**
         * Method to create admin menu page.
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function menu_page() : void
        {
            $hook_suffix = add_plugins_page(
                $this->page_title,
                $this->menu_title,
                $this->capability,
                $this->menu_slug,
                array( $this, 'menu_page_cb' ),
                $this->position
            );
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
            return '';
        }
    }
}