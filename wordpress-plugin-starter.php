<?php
/*
Plugin Name: WPS Plugin
Plugin URI:
Description: A boiler-plate for wordpress plugin
Version: 1.0.0
Requires at least: 5.7
Requires PHP: 8.0
Author: Codestar Technologies
Author URI: https://codestar.com.ng
License: AGPLv3
License URI:
Text Domain: wps
Domain Path: /languages
*/
/*
{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the {License}
along with {Plugin Name}. If not, see {License URI}.
*/

/**
 * The full-path and file name of the plugin file
 */
if ( ! defined( 'WPS_FILE' ) ) {
    define( 'WPS_FILE', __FILE__ );
}

require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'wps.php';
