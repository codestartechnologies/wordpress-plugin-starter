<?php
/**
 * This file contains general helper functions for your plugin
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @link        https://codestar.com.ng
 */

if ( ! function_exists( 'wps_is_theme_installed' ) ) {
    /**
     * Check if a theme is installed
     *
     * @param string $theme_dir_name    The directory name of the theme
     * @return boolean
     */
    function wps_is_theme_installed( string $theme_dir_name ) : bool
    {
        return wp_get_theme( $theme_dir_name )->exists();
    }
}

if ( ! function_exists( 'wps_is_theme_active' ) ) {
    /**
     * Check if a theme is active
     *
     * @param string $theme_name    The theme name
     * @return boolean
     */
    function wps_is_theme_active( string $theme_name ) : bool
    {
        $active_theme = get_option( 'current_theme' );
        return ( $active_theme === $theme_name );
    }
}

if ( ! function_exists( 'wps_is_plugin_active' ) ) {
    /**
     * Checks if a plugin is installed and activated
     *
     * @param string $dir_name      The plugin directory name
     * @param string $file_name     The plugin file name
     * @return boolean
     * @since 1.0.0
     */
    function wps_is_plugin_active( string $plugin_dir_name, string $plugin_file_name ) : bool
    {
        $path = trailingslashit( $plugin_dir_name ) . $plugin_file_name;
        return in_array( $path, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
    }
}

if ( ! function_exists( 'wps_config' ) ) {
    /**
     * Gets a configuration setting
     *
     * @param string $name  The name of the config file concatenated by the config key
     * @return mixed
     * @since 1.0.0
     */
    function wps_config( string $name ) : mixed
    {
        $name_arr = explode( '.', $name );
        $file_name = $name_arr[0] ?? null;
        $file_path = WPS_CONFIGS_PATH . $file_name . '.php';

        if ( is_file( $file_path ) ) {
            $config_arr = require $file_path;
            $config_key = $name_arr[1] ?? null;

            if ( array_key_exists( $config_key, $config_arr ) ) {
                return $config_arr[ $config_key ];
            }
        }

        return null;
    }
}

if ( ! function_exists( 'wps_get_date' ) ) {
    /**
     * Returns a date in custom format
     *
     * @param string $format
     * @param string $date
     * @return string|null
     * @since 1.0.0
     */
    function wps_get_date( string $format = 'd m Y', string $date = 'now' ) : string|null
    {
        return date( $format, strtotime( $date ) );
    }
}
