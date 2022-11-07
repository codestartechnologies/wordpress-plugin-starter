<?php
/**
 * WPSPostColumn class file.
 *
 * This file contains WPSPostColumn class that will register a custom post column.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\PostColumns;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PostColumns;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSPostColumn' ) ) {
    /**
     * Class WPSPostColumn
     *
     * This class registers a custom post column.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSPostColumn extends PostColumns {
        /**
         * WPSPostColumn constructor
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
}