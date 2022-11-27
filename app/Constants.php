<?php
/**
 * Constants class file.
 *
 * This file contains Constants class which defines needed constants that will be used in your plugin development.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @since      1.0.0
 */

namespace WPS_Plugin\App;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Constants' ) ) {
    /**
     * Class Constants
     *
     * This class defines needed constants that will be used in your plugin development.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Constants {
        /**
         * Define app constants.
         *
         * This methods defines custom constants that you will need to develop your plugin.
         *
         * @return void
         */
        public static function define_constants() : void
        {
            /**
             * Plugin Name
             *
             * You can modifiy this definition to match your plugin name.
             */
            if ( ! defined( 'WPS_PLUGIN_NAME' ) ) {
                define( 'WPS_PLUGIN_NAME', 'WPS Plugin' );
            }

            /**
             * Plugin Version
             *
             * You can modifiy this definition to match your plugin version.
             */
            if ( ! defined( 'WPS_PLUGIN_VERSION' ) ) {
                define( 'WPS_PLUGIN_VERSION', '1.0.0' );
            }
        }
    }
}


