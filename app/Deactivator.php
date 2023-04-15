<?php
/**
 * Deactivator class file.
 *
 * This file contains Deactivator class which handles tasks that will run when plugin is deactivated.
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
 * Deactivator class
 *
 * This class handles tasks that will run when plugin is deactivated.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class Deactivator
{
    /**
     * Handles tasks that will run during plugin deactivation.
     *
     * @static
     * @return void
     * @since 1.0.0
     */
    public static function run() : void
    {

        /**
         * Define custom actions you wish to run when this plugin is deactivated.
         */

        // wp_die("testing deactivation");
    }
}