<?php
/**
 * WPSPostColumn class file.
 *
 * This file contains WPSPostColumn class that will create a custom table column under wps_post.
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
 * This class creates a custom table column under wps_post.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSPostColumn extends PostColumns
{
    /**
     * The slug for the post type where the post column will be added.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $post_type = 'wps_post';

    /**
     * Meta key that will be used to display data on the column.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $meta_key = 'wps_post_text';

    /**
     * The post column key identifier
     *
     * @var string
     * @since 1.0.0
     */
    protected string $column_key = 'wps_post_text';

    /**
     * The view for displaying the post column
     *
     * @var string
     * @since 1.0.0
     */
    protected string $view = 'post-columns.wps-post-column';

    /**
     * WPSPostColumn constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->is_single_key    = true;
        $this->column_title     = esc_html__( 'Custom Heading', 'wps' );
    }
}