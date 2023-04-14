<?php
/**
 * Routes interface file.
 *
 * This file contains Routes interface. Classes that generates custom routes will need to implement this interface.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Interfaces;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Interface Routes
 *
 * Classes that generates custom routes will need to implement this interface.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
interface Routes
{
    /**
     * Load a custom route page or view
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function render() : void;
}