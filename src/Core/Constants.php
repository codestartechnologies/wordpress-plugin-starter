<?php
/**
 * Constants class file.
 *
 * This file contains Constants class which defines needed constants that will be used in Your plugin.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://codestar.com.ng
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Core;

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
     * This class defines needed constants that will be used in the theme development.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Constants {
        /**
         * Define core constants.
         *
         * This methods defines constants needed by WordpressPluginStarter package.
         *
         * @access public
         * @static
         * @return void
         * @since 1.0.0
         */
        public static function define_core_constants() : void
        {
            /**
             * Plugin minimum WordPress version
             */
            if ( ! defined( 'WPS_MIN_WP_VERSION' ) ) {
                define( 'WPS_MIN_WP_VERSION', '5.6.5' );
            }

            /**
             * Plugin minimum PHP version
             */
            if ( ! defined( 'WPS_MIN_PHP_VERSION' ) ) {
                define( 'WPS_MIN_PHP_VERSION', '8.0' );
            }

            /**
             * Plugin directory
             */
            if ( ! defined( 'WPS_PATH' ) ) {
                define( 'WPS_PATH', trailingslashit( plugin_dir_path( WPS_FILE ) ) );
            }

            /**
             * Plugin directory url
             */
            if ( ! defined( 'WPS_URL' ) ) {
                define( 'WPS_URL', trailingslashit( plugin_dir_url( WPS_FILE ) ) );
            }

            /**
             * Plugin js files directory
             */
            if ( ! defined( 'WPS_JS_BASE_URL' ) ) {
                define( 'WPS_JS_BASE_URL', trailingslashit( WPS_URL . 'assets/js' ) );
            }

            /**
             * Plugin css files directory
             */
            if ( ! defined( 'WPS_CSS_BASE_URL' ) ) {
                define( 'WPS_CSS_BASE_URL', trailingslashit( WPS_URL . 'assets/css' ) );
            }

            /**
             * Plugin images files directory
             */
            if ( ! defined( 'WPS_IMAGES_BASE_URL' ) ) {
                define( 'WPS_IMAGES_BASE_URL', trailingslashit( WPS_URL . 'assets/images' ) );
            }

            /**
             * Plugin admin views directory
             */
            if ( ! defined( 'WPS_ADMIN_VIEWS_PATH' ) ) {
                define( 'WPS_ADMIN_VIEWS_PATH', trailingslashit( 'views/admin' ) );
            }

            /**
             * Plugin public views directory
             */
            if ( ! defined( 'WPS_PUBLIC_VIEWS_PATH' ) ) {
                define( 'WPS_PUBLIC_VIEWS_PATH', trailingslashit( 'views/public' ) );
            }

            /**
             * Plugin logs directory
             */
            if ( ! defined( 'WPS_LOGS_PATH' ) ) {
                define( 'WPS_LOGS_PATH', trailingslashit( WPS_PATH . 'logs' ) );
            }

            /**
             * Plugin language translation files directory
             */
            if ( ! defined( 'WPS_LANGUAGES_PATH' ) ) {
                define( 'WPS_LANGUAGES_PATH', trailingslashit( WPS_PATH . 'languages' ) );
            }

            /**
             * Plugin configuration files directory
             */
            if ( ! defined( 'WPS_CONFIGS_PATH' ) ) {
                define( 'WPS_CONFIGS_PATH', trailingslashit( WPS_PATH . 'configs' ) );
            }

            /**
             * Default time zone id
             */
            if ( ! defined( 'WPS_TIMEZONE_ID' ) ) {
                define( 'WPS_TIMEZONE_ID', 'Africa/Lagos' );
            }
        }
    }
}


