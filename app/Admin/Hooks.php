<?php
/**
 * Hooks class file.
 *
 * This file contains Hooks class which which registers hooks that will run in admin area.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://codestar.com.ng
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace App\Admin;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Interfaces\FilterHook;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Hooks' ) ) {
    /**
     * Class Hooks
     *
     * This class registers hooks that will run in admin area.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Hooks implements ActionHook, FilterHook {
        /**
         * Register add_action() and remove_action().
         *
         * @return void
         */
        public function register_add_action() : void
        {
            add_action( 'admin_enqueue_scripts', array( $this, 'action_admin_enqueue_scripts' ) );
            add_action( 'init', array( $this, 'action_init' ) );
        }

        /**
         * Register add_filter() and remove_filter().
         *
         * @return void
         */
        public function register_add_filter() : void
        {
            //
        }

        /**
         * "admin_enqueue_scripts" action hook callback
         *
         * Enqueue scripts for all admin pages.
         *
         * @param string $hook_suffix
         * @return void
         */
        public function action_admin_enqueue_scripts( string $hook_suffix ) : void
        {
            $screen = get_current_screen();

            // var_dump( $hook_suffix, $screen );

            if ( $screen->post_type === 'wps_post' && $screen->taxonomy === 'wps_post_category' && $screen->base === 'edit-tags' ) {

                wp_register_style( 'css-handle', 'path-to-css', array(), false, 'all' );

                wp_register_script( 'js-handle', 'path-to-js', array(), false, true );

                wp_set_script_translations( 'js-handle', 'wps' );

                wp_enqueue_style( 'css-handle' );

                wp_enqueue_script( 'js-handle' );

                wp_enqueue_editor();

                wp_enqueue_media();

                $data = 'jQuery( function ( $ ) { $.each( jQuery( ".wps-textarea" ), function ( index, editor ) { wp.editor.initialize( jQuery( editor ).attr( "id" ), { tinymce: true } ); } ); } );';
                wp_add_inline_script( 'editor', $data );

            }
        }

        /**
         * "init" action hook callback
         *
         * Fires after WordPress has finished loading but before any headers are sent.
         *
         * @return void
         */
        public function action_init() : void {
            add_post_type_support( 'wps_post', 'page-attributes' );
            remove_post_type_support( 'page', 'thumbnail' );
            remove_post_type_support( 'page', 'comments' );
        }
    }
}