<?php
/**
 * WPSBasicShortcode class file.
 *
 * This file contains WPSBasicShortcode class that will register a custom shortcode.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Public\Shortcodes;

use Codestartechnologies\WordpressPluginStarter\Abstracts\Shortcodes;
use Codestartechnologies\WordpressPluginStarter\Traits\View;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSBasicShortcode class
 *
 * This class registers a custom shortcode.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSBasicShortcode extends Shortcodes
{

    use View;

    /**
     * WPSBasicShortcode Class Constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->type = 'basic';
        $this->tag = 'wps_basic_shortcode';
    }

    /**
     * Method to check when to register the shortcode
     *
     * @return boolean
     * @since 1.0.0
     */
    public function can_display_shortcode() : bool
    {
        return true;
    }

    /**
     * Default shortcode attributes
     *
     * @return array
     * @since 1.0.0
     */
    public function default_attributes() : array
    {
        // Since we are creating a basic shortcode without arguements, we return an empty array.
        return array();
    }

    /**
     * Method to display the contents of the shortcode. [wps_shortcode type=""]
     *
     * @return string
     * @since 1.0.0
     */
    public function display( array $filtered_attributes, string $content, string $tag ) : void
    {
        $this->load_view( 'shortcodes.wps-basic-shortcode', array(), 'public' );
    }
}