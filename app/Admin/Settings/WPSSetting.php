<?php
/**
 * WPSSetting class file.
 *
 * This file contains WPSSetting class that will register a custom setting.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\Settings;

use Codestartechnologies\WordpressPluginStarter\Abstracts\Settings;
use Codestartechnologies\WordpressPluginStarter\Traits\Logger;
use Codestartechnologies\WordpressPluginStarter\Traits\View;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSSetting class
 *
 * This class registers a custom setting.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSSetting extends Settings
{

    use View, Logger;

    /**
     * Arguements needed to add the section for the settings.
     *
     * @return array
     * @since 1.0.0
     */
    public function get_section() : array
    {
        return array(
            'author_section' => array(
                'id'            => 'wps_settings',
                'title'         => esc_html__( 'WordPress Plugin Starter Settings', 'wps' ),
                'page'          => 'wps-setting-menu',
                'callback'      => null,
            ),
        );
    }

    /**
     * Arrays of arguements for registering the settings associated with the section.
     *
     * Settings are saved as arrays. `$setting_id[ $setting_field_id ] = value;`
     * To get a setting, use the format: `get_option( $setting_id )[ $setting_field_id ]`
     *
     * @return array
     * @since 1.0.0
     */
    public function get_settings() : array
    {
        return array(
            'author_setting' => array(
                'option_name'   => 'wps_author_name',
                'args'          => array(
                    'description'  => esc_html__( 'The name of the author', 'wps' ),
                ),
                'update_cb'     => 'author_setting_update_cb',
                'page'          => 'wps-setting-menu',
            ),
        );
    }

    /**
     * Arrays of arguements to add the fields associated with the section.
     *
     * @return array
     * @since 1.0.0
     */
    public function get_fields() : array
    {
        return array(
            array(
                'id'            => 'wps_author_name_field',
                'title'         => esc_html__( 'Author Name', 'wps' ),
                'callback'      => 'wps_author_name_field_cb',
                'setting_key'   => 'author_setting',
                'section'       => 'author_section',
            ),
        );
    }

    /**
     * Function that echos out any content at the top of the section (between heading and fields).
     *
     * @return void
     * @since 1.0.0
     */
    public function section_cb() : void
    {
        esc_html_e( 'This section contains settings for the author name', 'wps' );
    }

    /**
     * Callback method for updating a setting
     *
     * Fires after the value of a specific option has been successfully updated.
     *
     * @param mixed  $old_value The old option value.
     * @param mixed  $value     The new option value.
     * @param string $option    Option name.
     * @return void
     * @since 1.0.0
     */
    public function author_setting_update_cb( $old_value, $value, string $option ) : void
    {
        $message = $old_value['wps_author_name_field'] . ' was updated to ' . $value['wps_author_name_field'];
        $this->log( __FILE__, sprintf( esc_html__( '%s', 'wps' ), $message ), 'info' );
    }

    /**
     * Function that fills the field with the desired form inputs. The function should echo its output.
     *
     * @param array $args   An array of arguements passed to add_settings_field()
     * @return void
     * @since 1.0.0
     */
    public function wps_author_name_field_cb( array $args ) : void
    {
        $this->load_view( 'settings.wps-setting', $args );
    }
}