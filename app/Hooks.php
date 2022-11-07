<?php
/**
 * Hooks class file.
 *
 * This file contains Hooks class which registers hooks that will run at the fornt-end and adminarea.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://codestar.com.ng
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace WPS_Plugin\App;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Interfaces\FilterHook;
use WP_Query;

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
     * This class registers hooks that will run at the fornt-end and admin area.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    class Hooks implements ActionHook, FilterHook {
        /**
         * Register add_action() and remove_action().
         *
         * @return void
         */
        public function register_add_action() : void
        {
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
         * Fires after WordPress has finished loading but before any headers are sent.
         *
         */
        public function action_init() : void {
            $path = dirname( plugin_basename( WPS_FILE ) ) . '/languages/';
            load_plugin_textdomain( 'wps', false, $path );
        }
    }
}