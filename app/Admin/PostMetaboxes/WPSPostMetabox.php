<?php
/**
 * WPSPostMetabox class file.
 *
 * This file contains WPSPostMetabox class that will be used to create a custom metabox for wps_post.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\PostMetaboxes;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PostMetaboxes;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSPostMetabox Class
 *
 * This class will create a custom metabox for wps_post.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSPostMetabox extends PostMetaboxes
{
    /**
     * Metadata key.
     *
     * @var string
     * @since 1.0.0
     */
    public string $meta_key = 'wps_post_type_id';

    /**
     * Meta box ID
     *
     * @var string
     * @since 1.0.0
     */
    protected string $id = 'wps_post_metabox';

    /**
     * The context within the screen where the box should display.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $context = 'side';

    /**
     * The priority within the context where the box should show.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $priority = 'high';

    /**
     * The metabox view
     *
     * @var string
     * @since 1.0.0
     */
    protected string $metabox_view = 'posts-meta-boxes.wps-post-metabox';

    /**
     * WPSPostMetabox constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->title = esc_html__( 'WPS - Post Type ID', 'wps' );
        $this->screens = array( 'wps_post', );
        $this->is_single_key = true;
        $this->is_unique_key = true;
        $this->nonce_action = 'handle ' . $this->id;
        $this->nonce_name = $this->meta_key . '_metabox_nonce';
    }
}