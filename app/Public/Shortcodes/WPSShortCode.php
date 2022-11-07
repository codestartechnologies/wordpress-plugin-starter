<?php
/**
 * WPSShortcode class file.
 *
 * This file contains WPSShortcode class that will register a custom shortcode.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Public\Shortcodes;

use Codestartechnologies\WordpressPluginStarter\Abstracts\Shortcodes;
use Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSShortcode' ) ) {
    /**
     * Class WPSShortcode
     *
     * This class registers a custom shortcode.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSShortcode extends Shortcodes {
        use ViewLoader;

        /**
         * WPSShortcode Class Constructor
         *
         */
        public function __construct()
        {
            $this->tag = 'wps_shortcode';
        }

        /**
         * Method to check when to register the shortcode
         *
         * @return boolean
         */
        public function can_display_shortcode() : bool
        {
            return true;
        }

        /**
         * Default shortcode attributes
         *
         * @return array
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
         * @return string
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
}
