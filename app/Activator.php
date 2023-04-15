<?php
/**
 * Activator class file.
 *
 * This file contains Activator class which is used to handle works that will run after plugin is activated.
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
 * Activator class
 *
 * This class is used to handles tasks that will run after plugin is activated.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
class Activator
{
    /**
     * Handles tasks that will run during plugin activation.
     *
     * @static
     * @return void
     * @since 1.0.0
     */
    public static function run() : void {

        /**
         * Define custom actions you wish to run when this plugin is activated.
         */

        // wp_die("testing activation");
    }
}