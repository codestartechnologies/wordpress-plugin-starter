<?php
/**
 * AdminNotices abstract class file.
 *
 * This file contains AdminNotices abstract class used for printing admin notifications on the screen.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * AdminNotices class
 *
 * This class contains contracts that will be used for printing admin notifications on the screen.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
abstract class AdminNotices implements ActionHook
{
    /**
     * The type of the notification.
     *
     * Accepted values are: error, warning, success, and info.
     *
     * @access protected
     * @var string
     * @since 1.0.0
     */
    protected string $type;

    /**
     * If the notification can be dismissed by the admin.
     *
     * @access protected
     * @var boolean
     * @since 1.0.0
     */
    protected bool $dismissible = true;

    /**
     * Register add_action() and remove_action().
     *
     * @final
     * @access public
     * @return void
     * @since 1.0.0
     */
    final public function register_add_action() : void
    {
        add_action( 'admin_notices', array( $this, 'notification' ) );
    }

    /**
     * "admin_notices" action hook callback
     *
     * Prints admin screen notices.
     *
     * @final
     * @access public
     * @return void
     * @since 1.0.0
     */
    final public function notification() : void
    {
        if ( $this->can_show_notice() ) {
            $class = array( 'notice' );
            $class[] = $this->get_notice_type()[$this->type] ?? 'notice-error';
            $class[] = ( $this->dismissible ) ? 'is-dismissible' : null;
            printf( '<div class="%1$s"><p>%2$s</p></div>', implode( ' ', $class ), wp_kses_post( $this->get_message() ) );
        }
    }

    /**
     * Check before the admin notice is printed
     *
     * @access protected
     * @return bool
     * @since 1.0.0
     */
    protected function can_show_notice() : bool
    {
        return true;
    }

    /**
     * Get the type of notification
     *
     * @return array
     * @since 1.0.0
     */
    private function get_notice_type() : array
    {
        return array(
            'error'     => 'notice-error',
            'warning'   => 'notice-warning',
            'success'   => 'notice-success',
            'info'      => 'notice-info',
        );
    }

    /**
     * The notification message
     *
     * @abstract
     * @access public
     * @return string
     * @since 1.0.0
     */
    abstract public function get_message() : string;
}