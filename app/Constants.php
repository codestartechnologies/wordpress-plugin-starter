<?php
/**
 * Constants class file.
 *
 * This file contains Constants class which defines needed constants that will be used in your plugin development.
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
 * Class Constants
 *
 * This class defines needed constants that will be used in your plugin development.
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
        if ( ! defined( 'WPS_PLUGIN_NAME' ) ) {
            define( 'WPS_PLUGIN_NAME', 'WPS Plugin' );
        }

        // Plugin Version
        if ( ! defined( 'WPS_PLUGIN_VERSION' ) ) {
            define( 'WPS_PLUGIN_VERSION', '1.0.0' );
        }
    }
}