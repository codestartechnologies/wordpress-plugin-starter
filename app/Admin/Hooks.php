<?php
/**
 * Hooks class file.
 *
 * This file contains Hooks class which registers hooks that will run in admin area.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace WPS_Plugin\App\Admin;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Interfaces\FilterHook;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Hooks class
 *
 * This class registers hooks that will run in admin area.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class Hooks implements ActionHook, FilterHook
{
    /**
     * Register add_action() and remove_action().
     *
     * @return void
     * @since 1.0.0
     */
    public function register_add_action() : void
    {
        /**
         * Add your custom action hooks below.
         */


        // add_action( 'hook', array( $this, 'callback' ) );
    }

    /**
     * Register add_filter() and remove_filter().
     *
     * @return void
     * @since 1.0.0
     */
    public function register_add_filter() : void
    {
        /**
         * Add your custom filter hooks below.
         */


        // add_filter( 'hook', array( $this, 'callback' ) );
    }
}