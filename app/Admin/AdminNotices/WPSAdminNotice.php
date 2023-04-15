<?php
/**
 * WPSAdminNotice class file.
 *
 * This file contains WPSAdminNotice class that will print a custom admin notification on the screen.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\AdminNotices;

use Codestartechnologies\WordpressPluginStarter\Abstracts\AdminNotices;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WPSAdminNotice
 *
 * This class displays a custom admin notification on the screen.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSAdminNotice extends AdminNotices
{
    /**
     * WPSAdminNotice constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->type = 'info';
    }

    /**
     * The arguements to pass to the view
     *
     * @return array
     * @since 1.0.0
     */
    public function get_message() : string
    {
        return esc_html__( 'Thanks for using WordPress Plugin Starter!', 'wps' );
    }
}