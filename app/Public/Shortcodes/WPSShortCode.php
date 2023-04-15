<?php
/**
 * WPSShortcode class file.
 *
 * This file contains WPSShortcode class that will register a custom shortcode.
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
 * WPSShortcode class
 *
 * This class registers a custom shortcode.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSShortcode extends Shortcodes
{

    use View;

    /**
     * WPSShortcode Class Constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->type = 'advanced';
        $this->tag = 'wps_shortcode';
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
        return array(
            'type' => 'success',
        );
    }

    /**
     * Method to display the contents of the shortcode. [wps_shortcode type=""]
     *
     * @return void
     * @since 1.0.0
     */
    public function display( array $filtered_attributes, string $content, string $tag ) : void
    {
        switch ( $filtered_attributes['type'] ) {
            case 'success':
                $alert_message = 'Your action is set to success!';
                break;
            default :
                $alert_message = 'Your action can not be resolved!';
        }

        $this->load_view( 'shortcodes.wps-shortcode', array( 'alert' => $alert_message, ), 'public' );
    }
}