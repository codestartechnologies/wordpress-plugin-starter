<?php
/**
 * WPSSettingMenu class file.
 *
 * This file contains WPSSettingMenu class that will register a custom admin setting menu page.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\Menus;

use Codestartechnologies\WordpressPluginStarter\Abstracts\OptionsMenus;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSPluginMenu Class
 *
 * This class registers a custom admin setting menu page.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSSettingMenu extends OptionsMenus
{
    /**
     * WPSSettingMenu Constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->page_title   = esc_html__( 'WPS Settings Page', 'wps' );
        $this->menu_title   = esc_html__( 'WPS Settings Menu', 'wps' );
        $this->capability   = 'manage_options';
        $this->menu_slug    = 'wps-setting-menu';
        $this->view         = 'admin-menu-pages.wps-setting-menu';
    }

    /**
     * Check before adding the admin page.
     *
     * @return boolean
     * @since 1.0.0
     */
    public function can_add_menupage() : bool
    {
        return true;
    }

    /**
     * Arguements to pass to the menu page view
     *
     * @return array
     * @since 1.0.0
     */
    public function menu_page_view_args() : array
    {
        return array(
            'page'  => $this->menu_slug,
        );
    }
}