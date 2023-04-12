<?php
/**
 * This file contains functions for loading classes and files
 *
 * @package WordPressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link    https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license GNU/AGPLv3
 * @since   1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSAutoLoader class
 *
 * @package WordPressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSAutoLoader
{
    /**
     * Prefix to add to namespace
     *
     * @static
     * @var string|null
     * @since 1.0.0
     */
    public static ?string $prefix = null;

    /**
     * Auto load class mappings
     *
     * @access protected
     * @static
     * @var array
     * @since 1.0.0
     */
    protected static array $class_autoloads = array(
        "WPS_Plugin\\App" => "app",
        "Codestartechnologies\\WordpressPluginStarter" => "src",
    );

    /**
     * handles autoloading for classes and files
     *
     * @static
     * @return void
     * @since 1.0.0
     */
    public static function autoload() : void
    {
        spl_autoload_register( array( __CLASS__, 'wps_autoloader' ) );
    }

    /**
     * handles autoloading for classes
     *
     * @static
     * @param string $class
     * @return void
     * @since 1.0.0
     */
    public static function wps_autoloader( string $class ) : void
    {
        $prefix = isset( self::$prefix ) ? self::$prefix . "\\" : '';

        foreach ( self::$class_autoloads as $namespace => $dir ) {
            $namespace = $prefix . $namespace;

            if ( strpos( $class, $namespace ) === 0 ) {
                $class = str_replace( $namespace, '', $class );
                $class = str_replace( '\\', DIRECTORY_SEPARATOR, $class ) . '.php';
                $path = trailingslashit( plugin_dir_path( __FILE__ ) ) . $dir . DIRECTORY_SEPARATOR . $class;

                if ( is_readable( $path ) ) {
                    require_once( $path );
                }
            }
        }
    }
}

\Codestartechnologies\WordpressPluginStarter\WPSAutoLoader::autoload();