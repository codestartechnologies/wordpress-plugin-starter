<?php
/**
 * Logger trait file.
 *
 * This file contains Logger trait for logging errors to a log files.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @link       https://codestar.com.ng
 * @since      1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Traits;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! trait_exists( 'Logger' ) ) {
    /**
     * Trait Logger
     *
     * This trait is used for logging informations to a log file.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    trait Logger {
        /**
         * Log a message to a log file
         *
         * @access public
         * @param string $file          The full path to the file that triggered the logger
         * @param string $message       The message to log
         * @param string $type          The message type. Can be: "error", "warning", "info", or "debug"
         * @return void
         * @since 1.0.0
         */
        public function log( string $file, string $message, string $type = 'error' ) : void
        {

            if ( ! in_array( $type, array( 'error', 'warning', 'info', 'debug' ) ) ) {
                $type = 'error';
            }

            if ( defined( 'WPS_LOGS_PATH' ) ) {
                $timezone_id = wps_config( 'date.timezone_id' ) ?? WPS_TIMEZONE_ID;
                date_default_timezone_set( $timezone_id );
                $message = sprintf( '[%1$s][%2$s][%3$s] %4$s', date( 'Y-m-d H:i:s' ), $type, $file, $message );
                $log_file = $this->get_log_file()[ $type ];

                if ( ! error_log( $message . PHP_EOL, 3, WPS_LOGS_PATH . $log_file ) ) {
                    $this->write_log( $message . PHP_EOL, WPS_LOGS_PATH . $log_file );
                }
            }
        }

        /**
         * get the file for logging a message
         *
         * @final
         * @access public
         * @return array
         * @since 1.0.0
         */
        final public function get_log_file() : array
        {
            return array(
                'error'     => 'error.log',
                'warning'   => 'warning.log',
                'info'      => 'info.log',
                'debug'     => 'debug.log',
            );
        }

        /**
         * Fallback logger method
         *
         * @param string $message
         * @param string $path
         * @return void
         */
        private function write_log( string $message, string $path ) : void
        {
            $resource = fopen( $path, 'a' );
            fwrite( $resource, $message );
            fclose( $resource );
        }
    }
}