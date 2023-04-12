<?php
/*
Plugin Name:        WPS Plugin
Plugin URI:         
Description:        
Version:            1.0.0
Requires at least:  5.6.5
Requires PHP:       8.0
Author:             
Author URI:         
License:            AGPLv3
License URI:        https://www.gnu.org/licenses/agpl-3.0.en.html
Text Domain:        wps
Domain Path:        /languages
*/

/*
{Plugin Short Description}
Copyright (C) {Year} {Organisation}

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
*/


/*
 * You are free to change the header comment section to match information required by your theme. Items that can modified includes:
 *
 * 1. Plugin Name:      (required) The name of your plugin, which will be displayed in the Plugins list in the WordPress Admin.
 * 2. Plugin URI:       The home page of the plugin, which should be a unique URL, preferably on your own website.
 * 5. Description:      A short description of the plugin, as displayed in the Plugins section in the WordPress Admin.
 * 7. Version:          The current version number of the plugin, such as 1.0 or 1.0.3.
 * 3. Author:           The name of the plugin author. Multiple authors may be listed using commas.
 * 4. Author URI:       The author’s website or profile on another website, such as WordPress.org.
 * 8. Text Domain:      The gettext text domain of the plugin.
 *
 */


// Full-path to the plugin main file

use Codestartechnologies\WordpressPluginStarter\Plugin;

if ( ! defined( 'WPS_FILE' ) ) {
    define( 'WPS_FILE', __FILE__ );
}

// Require plugin main class file
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'wps.php';

// Initialize plugin main class
$wps_plugin = Plugin::get_instance();

// Run the plugin
$wps_plugin->run();