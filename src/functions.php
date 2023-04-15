<?php
/**
 * This file contains general helper functions for your plugin.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

if ( ! function_exists( 'wps_is_theme_installed' ) ) {
    /**
     * Check if a theme is installed
     *
     * @param string $theme_dir_name    The directory name of the theme
     * @return boolean
     * @since 1.0.0
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
     * @since 1.0.0
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

if ( ! function_exists( 'wps_log' ) ) {
    /**
     * Function for logging message to a file.
     *
     * @param string $log_message   Log Message.
     * @param string $path          Path to the log file.
     * @return void
     * @since 1.0.0
     */
    function wps_log( string $log_message, string $path ) : void
    {
        if ( ! error_log( $log_message . PHP_EOL, 3, $path ) ) {
            $resource = fopen( $path, 'a' );
            fwrite( $resource, $log_message );
            fclose( $resource );
        }
    }
}

if ( ! function_exists( 'wps_view_not_found_message' ) ) {
    /**
     * Prints error message for non existing views.
     *
     * @param string $type  Path to the view file
     * @return void
     * @since 1.0.0
     */
    function wps_view_not_found_message( $file_path ) : void
    {
        $markup = array_filter( ( array ) wps_config( 'views.error_messages' ) );
        $markup = wp_parse_args( ( array ) $markup, array(
            'not_found'  => __(
                '<h3 style="color: red;">View could not be loaded!</h3><p>There was an error loading <b>%s</b>. Please check file exist and is readable. </p>',
                'wps'
            ),
        ) );

        printf( $markup['not_found'], $file_path );
    }
}

if ( ! function_exists( 'wps_load_view' ) ) {
    /**
     * loads a file from views/
     *
     * @param string $view              The relative path to the view file. Paths are separated using dots (`.`)
     * @param array $params             Parameters passed to the view. Default is an empty array
     * @param string $type              The directory to search for the view. Can be either `admin` or `public`. Default is `admin`
     * @param bool $once                Whether to include the view only once. Default true
     * @param string|null $base_path    Path to the root directory where the folder containing the views is located. i.e path to `views` folder.
     * @return void
     * @since 1.0.0
     */
    function wps_load_view( string $view, array $params = array(), string $type = 'admin', bool $once = true, ?string $base_path = null ) : void
    {
        $view = str_replace( '.', '/', $view );
        $base_path = is_null( $base_path ) ? WPS_PATH : $base_path;
        $base_path .= ( 'admin' === $type ) ? WPS_ADMIN_VIEWS_PATH : WPS_PUBLIC_VIEWS_PATH;
        $full_path = $base_path . $view . '.php';

        if ( is_readable( $full_path ) ) {

            if ( ! empty( $params ) ) {
                extract( $params );
            }

            if ( $once ) {
                require_once $full_path;
            } else {
                require $full_path;
            }
        } else {
            wps_view_not_found_message( $full_path );
        }
    }
}
