<?php
/**
 * WPSPluginMenu class file.
 *
 * This file contains WPSPluginMenu class that will register a custom admin plugin menu page.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\Menus;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PluginMenus;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSPluginMenu Class
 *
 * This class registers a custom admin plugin menu page.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSPluginMenu extends PluginMenus
{
    /**
     * WPSPluginMenu constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->page_title   = esc_html__( 'WPS Admin Plugin Menu Page', 'wps' );
        $this->menu_title   = esc_html__( 'WPS Plugin Menu', 'wps' );
        $this->capability   = 'manage_options';
        $this->menu_slug    = 'wps-plugin-menu';
        $this->view         = 'admin-menu-pages.wps-plugin-menu';
    }

    /**
     * Fires before a particular screen is loaded. Example can be to handle POST or GET request sent to the menu page
     *
     * @return void
     * @since 1.0.0
     */
    public function load_page() : void
    {
        //
    }

    /**
     * Arguements to pass to the menu page view
     *
     * @return array
     * @since 1.0.0
     */
    public function menu_page_view_args() : array
    {
        return array();
    }

    /**
     * The content to display in the footer of the admin menu page
     *
     * @param string $text
     * @return string
     * @since 1.0.0
     */
    public function get_footer_content( string $text ) : string
    {
        return $text;
    }
}