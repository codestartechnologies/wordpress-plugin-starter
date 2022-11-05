<?php
/**
 * WPSConstants class file.
 *
 * This file contains WPSConstants class which defines needed constants that will be used in your plugin development.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @since      1.0.0
 */

namespace App;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSConstants' ) ) {
    /**
     * Class WPSConstants
     *
     * This class defines needed constants that will be used in your plugin development.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSConstants {
        /**
         * Define core constants.
         *
         * This methods defines custom constants that you will need to develop your plugin.
         *
         * @return void
         */
        public static function define_constants() : void
        {
            /**
             * Plugin name
             */
            if ( ! defined( 'WPS_PLUGIN_NAME' ) ) {
                define( 'WPS_PLUGIN_NAME', 'Custom Plugin Name' );
            }

            /**
             * Plugin version
             */
            if ( ! defined( 'WPS_PLUGIN_VERSION' ) ) {
                define( 'WPS_PLUGIN_VERSION', '1.0.0' );
            }
        }
    }
}


