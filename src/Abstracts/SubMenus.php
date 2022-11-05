<?php
/**
 * SubMenus abstract class file.
 *
 * This file contains SubMenus abstract class which contains contracts for classes that will register admin sub-menu pages.
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

if ( ! class_exists( 'SubMenus' ) ) {
    /**
     * Class SubMenus
     *
     * This class contains contracts that will be used to register admin sub-menu pages.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class SubMenus extends Menus {
        /**
         * The slug name for the parent menu.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $parent_slug;

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
            add_submenu_page(
                $this->parent_slug,
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
            return $this->parent_slug . '_page_' . $this->menu_slug;
        }
    }
}