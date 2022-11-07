<?php

spl_autoload_register( 'wps_autoloader' );

/**
 * Function to autoload classes starting with WTS_Theme namespace
 *
 * @param string $class
 * @return void
 * @since 1.0.0
 */
function wps_autoloader( string $class ) : void
{
    $namespace = 'WPS_Plugin\App';

    if ( strpos( $class, $namespace ) !== 0 ) {
        return;
    }

    $class = str_replace( $namespace, '', $class );
    $class = str_replace( '\\', DIRECTORY_SEPARATOR, $class ) . '.php';
    $path = plugin_dir_path( WPS_FILE ) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $class;

    if ( is_readable( $path ) ) {
        require_once( $path );
    }
}
