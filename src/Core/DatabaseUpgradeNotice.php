<?php
/**
 * DatabaseUpgradeNotice class file.
 *
 * This file contains DatabaseUpgradeNotice class that will print database upgrade notification on the admin screen.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Core;

use Codestartechnologies\WordpressPluginStarter\Abstracts\AdminNotices;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * DatabaseUpgradeNotice class
 *
 * This class will print database upgrade notification on the admin screen.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class DatabaseUpgradeNotice extends AdminNotices
{
    /**
     * Database version
     *
     * @access protected
     * @var integer
     * @since 1.0.0
     */
    protected int $database_version;

    /**
     * Last database version
     *
     * @access protected
     * @var integer
     * @since 1.0.0
     */
    protected int $last_database_version;

    /**
     * DatabaseUpgradeNotice constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->type = 'warning';
        $this->dismissible = false;
        $this->database_version = intval( wps_config( 'database.db_version' ) );
        $this->last_database_version = intval( get_option( wps_config( 'database.last_db_version_name' ) ) );
    }

    /**
     * The notification message
     *
     * @return string
     * @since 1.0.0
     */
    public function get_message() : string
    {
        $link = add_query_arg( '_wpnonce', wp_create_nonce( 'handle_db_upgrade' ), admin_url( '?wps_database_upgrade=1' ) );
        return sprintf(
            __( '<b>New database version of <span style="color: #2271b1;">%1$s</span> detected!</b> Previous version <span style="color: #b32d2e;">%2$s</span>. <a href="%3$s">Upgrade now!</a>', 'wps' ),
            $this->database_version,
            $this->last_database_version,
            $link
        );
    }

    /**
     * Check before the admin notice is printed
     *
     * @access protected
     * @return boolean
     * @since 1.0.0
     */
    protected function can_show_notice() : bool
    {
        return ( $this->database_version > $this->last_database_version );
    }
}