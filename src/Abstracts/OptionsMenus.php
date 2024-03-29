<?php
/**
 * OptionsMenus abstract class file.
 *
 * This file contains OptionsMenus abstract class which contains contracts for creating admin pages under `Settings` in the admin dashboard.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * OptionsMenus class
 *
 * This class contains contracts for creating admin pages under `Settings` in the admin dashboard.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
abstract class OptionsMenus extends Menus
{
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
        add_options_page(
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
        return 'settings_page_' . $this->menu_slug;
    }
}