<?php
/**
 * Logger trait file.
 *
 * This file contains Logger trait for logging data to a log file.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Traits;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Logger Trait
 *
 * This trait is used for logging information to a log file.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
trait Logger
{
    /**
     * Log a message to a log file
     *
     * @final
     * @static
     * @param string $file      The full path to the file that triggered the logger
     * @param string $message   The message to log
     * @param string $type      The message type. Can be: "error", "warning", "info", or "debug"
     * @return void
     * @since 1.0.0
     */
    final public static function log( string $file, string $message, string $type = 'error' ) : void
    {

        if ( ! in_array( $type, array( 'error', 'warning', 'info', 'debug' ) ) ) {
            $type = 'error';
        }

        if ( defined( 'WPS_LOGS_PATH' ) ) {
            $timezone_id = wps_config( 'date.timezone_id' ) ?? WPS_TIMEZONE_ID;
            date_default_timezone_set( $timezone_id );
            $message = sprintf( '[%1$s][%2$s][%3$s] %4$s', date( 'Y-m-d H:i:s' ), $type, $file, $message );
            $log_file = self::get_log_file()[ $type ];
            wps_log( $message, WPS_LOGS_PATH . $log_file );
        }
    }

    /**
     * Returns the name of a log file.
     *
     * @final
     * @access private
     * @static
     * @return array
     * @since 1.0.0
     */
    final private static function get_log_file() : array
    {
        return array(
            'error'     => 'error.log',
            'warning'   => 'warning.log',
            'info'      => 'info.log',
            'debug'     => 'debug.log',
        );
    }
}