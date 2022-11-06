<?php
/**
 * Settings abstract class file.
 *
 * This file contains Settings abstract class which contains contracts for classes that will register settings.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Traits\Callbacks;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Settings' ) ) {
    /**
     * Class Settings
     *
     * This class contains contracts that will be used to register settings.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class Settings implements ActionHook {
        use Callbacks;

        /**
         * Register add_action() and remove_action().
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function register_add_action(): void
        {
            add_action( 'admin_init', array( $this, 'settings_page' ) );
            add_action( 'rest_api_init', array( $this, 'settings_page' ) );
            $this->action_update_settings();
        }

        /**
         * "admin_init" action hook callback
         *
         * Fires as an admin screen or script is being initialized.
         *
         * @final
         * @access public
         * @return void
         * @since 1.0.0
         */
        final public function settings_page() : void
        {
            $this->init_section();
            $this->init_settings();
            $this->init_fields();
        }

        /**
         * "update_option_{$option_name}" action hook
         *
         * Adds callback methods that will run when settings are updated
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function action_update_settings() : void
        {
            if ( ! empty( $this->get_settings() ) ) {
                foreach ( $this->get_settings() as $setting_key => $setting ) {
                    if ( isset( $setting['update_cb'] ) && method_exists( $this, $setting['update_cb'] ) ) {
                        add_action( "update_option_{$setting['option_name']}", array( $this, $setting['update_cb'] ), 10, 3 );
                    }
                }
            }
        }

        /**
         * Deletes settings from database.
         *
         * @final
         * @static
         * @since 1.0.0
         * @return void
         * @since 1.0.0
         */
        final public static function delete_settings() : void
        {
            if ( ! empty( self::get_settings() ) ) {
                foreach ( self::get_settings() as $setting_key => $setting ) {
                    if ( get_option( $setting['option_name'] ) ) {
                        delete_option( $setting['option_name'] );
                    }
                }
            }
        }

        /**
         * Registers a setting section
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function init_section() : void
        {
            $section = $this->get_section();
            if ( ! empty( $section ) ) {
                add_settings_section(
                    $section['id'],
                    $section['title'],
                    $this->get_valid_callback( $section['callback'] ),
                    $section['page']
                );
            }
        }

        /**
         * Registers multiple settings
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function init_settings() : void
        {
            $page = $this->get_section()['page'] ?? null;

            if ( ! empty( $this->get_settings() ) ) {
                foreach ( $this->get_settings() as $setting_key => $setting ) {
                    $args = wp_parse_args( $setting['args'], $this->default_args_for_register_setting() );
                    register_setting(
                        $page,
                        $setting['option_name'],
                        $args
                    );
                }
            }
        }

        /**
         * Registers multiple setting fields
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function init_fields() : void
        {
            $section = $this->get_section();
            $settings = $this->get_settings();

            if ( ! empty( $this->get_fields() ) ) {
                foreach ( $this->get_fields() as $field ) {
                    $setting = 
                    $args = array(
                        'label_for'     => $field['id'],
                        'option_name'   => $settings[ $field['setting_key'] ]['option_name'],
                    );
                    add_settings_field(
                        $field['id'],
                        $field['title'],
                        $this->get_valid_callback( array( $this, $field['callback'] ) ),
                        $section['page'],
                        $section['id'],
                        $args
                    );
                }
            }
        }

        /**
         * Default arguements passed to register_setting()
         *
         * @access private
         * @return array
         * @since 1.0.0
         */
        private function default_args_for_register_setting() : array
        {
            return array(
                'type'                  => 'string',
                'description'           => '',
                'sanitize_callback'     => null,
                'show_in_rest'          => true,
                'default'               => null,
            );
        }

        /**
         * Arguements needed to add the section for the settings.
         *
         * @abstract
         * @access public
         * @return array
         * @since 1.0.0
         */
        abstract public function get_section() : array;

        /**
         * Arrays of arguements for registering the settings associated with the section.
         *
         * Settings are saved as arrays. `$setting_id[ $setting_field_id ] = value;`
         *
         * To get a setting, use the format: `get_option( $setting_id )[ $setting_field_id ]`
         *
         * @abstract
         * @access public
         * @return array
         * @since 1.0.0
         */
        abstract public function get_settings() : array;

        /**
         * Arrays of arguements to add the fields associated with the section.
         *
         * @abstract
         * @access public
         * @return array
         * @since 1.0.0
         */
        abstract public function get_fields() : array;
    }
}