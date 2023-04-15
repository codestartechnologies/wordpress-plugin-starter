<?php
/**
 * Uninstaller class file.
 *
 * This file contains Uninstaller class which handles tasks that will run when the plugin is deleted.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace WPS_Plugin\App;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Uninstaller class
 *
 * This class handles tasks that will run when plugin is deleted.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class Uninstaller
{
    /**
     * Handles tasks that will run when plugin is deleted.
     *
     * @static
     * @return void
     * @since 1.0.0
     */
    public static function run() : void
    {

        /**
         * Define custom actions you wish to run when this plugin is deleted.
         */

        // wp_die("testing uninstallation");
    }
}