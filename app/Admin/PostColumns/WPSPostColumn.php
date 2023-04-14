<?php
/**
 * WPSPostColumn class file.
 *
 * This file contains WPSPostColumn class that will register a custom post column.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\PostColumns;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PostColumns;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WPSPostColumn
 *
 * This class registers a custom post column.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSPostColumn extends PostColumns
{
    /**
     * WPSPostColumn constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->post_type        = 'wps_post';
        $this->meta_key         = 'wps_post_text';
        $this->is_single_key    = true;
        $this->column_key       = 'wps_post_text';
        $this->column_title     = esc_html__( 'Custom Meta - Heading:', 'wps' );
        $this->view             = 'post-columns.wps-post-column';
    }
}