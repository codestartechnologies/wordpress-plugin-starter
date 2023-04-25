<?php
/**
 * This file contains configuration settings for creating database tables
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

return array(

    /**
     * Current plugin database version.
     *
     * Note: Must be an integer, and incremented with each new database version. Should only be incremented when a
     * new table is meant to be created or modified in the database.
     */
    'db_version'    => PLUGIN_DB_VERSION,

    /**
     * Setting Name for last database version.
     *
     * Option name used to store the plugin last database version in the database. Example: plugin_name_db_version.
     */
    'last_db_version_name'  => PLUGIN_DB_VERSION_SETTING_NAME,

);
