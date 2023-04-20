<?php
/**
 * WPSSubMenu class file.
 *
 * This file contains WPSSubMenu class that will register a custom admin submenu page.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\Menus;

use Codestartechnologies\WordpressPluginStarter\Abstracts\SubMenus;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSSubMenu Class
 *
 * This class registers a custom admin submenu page.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSSubMenu extends SubMenus
{
    /**
     * WPSSubMenu constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->parent_slug  = 'wps-menu';
        $this->page_title   = esc_html__( 'WPS Sub Menu Page', 'wps' );
        $this->menu_title   = esc_html__( 'WPS Sub Menu', 'wps' );
        $this->capability   = 'manage_options';
        $this->menu_slug    = 'wps-sub-menu';
        $this->view         = 'admin-menu-pages.wps-submenu';
    }

    /**
     * An array containing settings for enqueuing css stylesheets on the page
     *
     * @return array
     * @since 1.0.0
     */
    protected function get_styles() : array
    {
        return array(
            array(
                'handle'    => 'wps-button',
                'src'       => WPS_CSS_BASE_URL . 'button.css',
            ),
        );
    }
}