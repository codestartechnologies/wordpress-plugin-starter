<?php
/**
 * Constants class file.
 *
 * This file contains Constants class which defines needed constants to ease your plugin development processes.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Constants class
 *
 * This class defines needed constants to ease your plugin development processes.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class Constants
{
    /**
     * Defines custom constants
     *
     * This methods defines custom constants that you will need to develop your plugin.
     *
     * @return void
     * @since 1.0.0
     */
    public static function define_constants() : void
    {
        // Plugin Name
        if ( ! defined( 'PLUGIN_NAME' ) ) {
            define( 'PLUGIN_NAME', $_ENV['PLUGIN_NAME'] ?? 'YOUR_PLUGIN_NAME' );
        }

        // Plugin Version
        if ( ! defined( 'PLUGIN_VERSION' ) ) {
            define( 'PLUGIN_VERSION', $_ENV['PLUGIN_VERSION'] ?? 'YOUR_PLUGIN_VERSION' );
        }

        /**
         * Define your custom constants below. It is recommended you check for existence of a constant before defining it.
         */

    }
}