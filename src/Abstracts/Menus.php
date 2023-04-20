<?php
/**
 * Menus abstract class file.
 *
 * This file contains Menus abstract class which contains contracts used to create admin menu pages.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Interfaces\FilterHook;
use Codestartechnologies\WordpressPluginStarter\Traits\View;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Menus class
 *
 * This class contains contracts that will be used to create admin menu pages.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
abstract class Menus implements ActionHook, FilterHook
{

    use View;

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
     * Check for whether WordPress media JS API files can be enqueued on the page.
     *
     * @access protected
     * @var boolean
     * @since 1.0.0
     */
    protected bool $can_enqueue_media = false;

    /**
     * Check for whether WordPress editor css and js files can be enqueued on the page.
     *
     * @access protected
     * @var boolean
     * @since 1.0.0
     */
    protected bool $can_enqueue_editor = false;

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
            add_action( 'admin_enqueue_scripts', array( $this, 'action_admin_enqueue_scripts' ) );
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
    final public function register_add_filter() : void
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
     * "load-{$page_hook}" action hook callback.
     *
     * Fires before a particular screen is loaded. Example can be to handle POST or GET request sent to the menu page.
     * Can be modified by a child class to handle tasks that will run before the particular page is loaded.
     *
     * @return void
     * @since 1.0.0
     */
    public function load_page() : void
    {
        //
    }

    /**
     * "admin_enqueue_scripts" action hook callback
     *
     * Enqueue scripts for all admin pages.
     *
     * @final
     * @param string $hook_suffix
     * @return void
     * @since 1.0.0
     */
    final public function action_admin_enqueue_scripts( string $hook_suffix ) : void
    {
        if ( $hook_suffix === $this->get_menu_hookname() ) {

            $this->set_script_translations();

            $this->enqueue_css_files();

            $this->enqueue_js_files();

            if ( $this->can_enqueue_editor ) {
                wp_enqueue_editor();
            }

            if ( $this->can_enqueue_media ) {
                wp_enqueue_media();
            }
        }
    }

    /**
     * Sets translated strings for a script.
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function set_script_translations() : void
    {
        foreach ( $this->get_script_translations() as $translation_setting ) {
            $translation_setting = wp_parse_args( $translation_setting, array(
                'handle'    => '',
                'domain'    => '',
                'path'      => null,
            ) );
            wp_set_script_translations( $translation_setting['handle'], $translation_setting['domain'], $translation_setting['path'] );
        }
    }

    /**
     * Adds CSS stylesheets on the page.
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function enqueue_css_files() : void
    {
        foreach ( $this->get_styles() as $style_setting ) {
            $style_setting = wp_parse_args( $style_setting, array(
                'handle'    => '',
                'src'       => '',
                'deps'      => array(),
                'ver'       => false,
                'media'     => 'all',
            ) );
            wp_enqueue_style(
                $style_setting['handle'],
                $style_setting['src'],
                $style_setting['deps'],
                $style_setting['ver'],
                $style_setting['media']
            );
        }
    }

    /**
     * Adds Javascfript files on the page.
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function enqueue_js_files() : void
    {
        foreach ( $this->get_scripts() as $script_setting ) {
            $script_setting = wp_parse_args( $script_setting, array(
                'handle'    => '',
                'src'       => '',
                'deps'      => array(),
                'ver'       => false,
                'in_footer' => false,
            ) );
            wp_enqueue_script(
                $script_setting['handle'],
                $script_setting['src'],
                $script_setting['deps'],
                $script_setting['ver'],
                $script_setting['in_footer']
            );
        }
    }

    /**
     * Arguements that will passed to the page view.
     *
     * @access protected
     * @return array
     * @since 1.0.0
     */
    protected function menu_page_view_args() : array
    {
        return array(
            'page_title' => $this->page_title,
            'menu_title' => $this->menu_title,
        );
    }

    /**
     * The content to display in the footer of the admin menu page.
     *
     * @access protected
     * @param string $text
     * @return string
     * @since 1.0.0
     */
    protected function get_footer_content( string $text ) : string
    {
        return $text;
    }

    /**
     * An array containing settings for adding script translations.
     *
     * @access protected
     * @return array
     * @since 1.0.0
     */
    protected function get_script_translations() : array
    {
        return array();
    }

    /**
     * An array containing settings for enqueuing css stylesheets on the page
     *
     * @access protected
     * @return array
     * @since 1.0.0
     */
    protected function get_styles() : array
    {
        return array();
    }

    /**
     * An array containing settings for enqueuing javascript files on the page
     *
     * @access protected
     * @return array
     * @since 1.0.0
     */
    protected function get_scripts() : array
    {
        return array();
    }
}