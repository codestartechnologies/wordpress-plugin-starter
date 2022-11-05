<?php
/**
 * Uninstaller class file.
 *
 * This file contains Uninstaller class which handles functionalities that run when plugin is deleted.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://codestar.com.ng
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Core;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PostMetaboxes;
use Codestartechnologies\WordpressPluginStarter\Abstracts\Settings;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Uninstaller' ) ) {
    /**
     * Class Uninstaller
     *
     * This class handles functionalities that run when plugin is deleted.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Uninstaller {

        /**
         * An array of settings
         *
         * @access private
         * @static
         * @var Settings[]
         * @since 1.0.0
         */
        private static array $settings;

        /**
         * An array of post metas
         *
         * @access private
         * @static
         * @var PostMetaboxes[]
         * @since 1.0.0
         */
        private static array $post_metas;

        /**
         * Method that will run when plugin is deleted.
         *
         * @access public
         * @param array|null $settings
         * @param array|null $post_metas
         * @return void
         * @since 1.0.0
         */
        public static function run( ?array $settings = null, ?array $post_metas = null ) : void
        {
            self::$settings = $settings;

            self::$post_metas = $post_metas;

            self::delete_settings();

            self::delete_post_metas();
        }

        /**
         * Delete settings
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private static function delete_settings() : void
        {
            if ( ! empty( self::$settings ) ) {
                foreach ( self::$settings as $setting ) {
                    $setting::delete_settings();
                }
            }
        }

        /**
         * Delete post metas
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private static function delete_post_metas() : void
        {
            if ( ! empty( self::$post_metas ) ) {
                foreach ( self::$post_metas as $post_meta ) {
                    $post_meta::delete();
                }
            }
        }
    }
}