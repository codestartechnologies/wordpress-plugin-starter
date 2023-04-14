<?php
/**
 * FilterHook interface file.
 *
 * This file contains FilterHook interface. Classes that make use of add_filter() and remove_filter()
 * need to implement this interface.
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
 * Interface FilterHook
 *
 * Classes that make use of add_filter() and remove_filter() need to implement this interface.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
interface FilterHook
{
    /**
     * Register add_filter() and remove_filter().
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function register_add_filter() : void;
}