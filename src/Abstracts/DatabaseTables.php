<?php
/**
 * DatabaseTables class file.
 *
 * This file contains DatabaseTables abstract class which will be inherited by classes that will create database tables.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Interfaces\DatabaseTables as InterfacesDatabaseTables;
use wpdb;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * DatabaseTables Class
 *
 * This class will be inherited by classes that will create database tables.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
abstract class DatabaseTables implements InterfacesDatabaseTables
{
    /**
     * The name for the table
     *
     * @static
     * @var string
     * @since 1.0.0
     */
    public static string $table_name;

    /**
     * wpdb class
     *
     * @access protected
     * @var wpdb
     * @since 1.0.0
     */
    protected wpdb $wpdb;

    /**
     * Setter for wpdb class
     *
     * @final
     * @param wpdb $wpdb - instantiation of the wpdb class
     * @return void
     */
    final public function set_wpdb( wpdb $wpdb ) : void
    {
        $this->wpdb = $wpdb;
    }

    /**
     * Check if the table exists in the database
     *
     * @final
     * @return boolean
     * @since 1.0.0
     */
    final public function exists() : bool
    {
        return \wps_db_table_exists( $this->table_name );
    }

    /**
     * Create the table
     *
     * @final
     * @return boolean
     * @since 1.0.0
     */
    final public function create() : bool
    {
        return $this->wpdb->query( $this->get_create_table_query_string() . ' ' . $this->wpdb->get_charset_collate() );
    }

    /**
     * Remove the table
     *
     * @final
     * @return boolean
     * @since 1.0.0
     */
    final public function destroy() : bool
    {
        return ( $this->exists() ) ? $this->wpdb->query( "DROP TABLE `{$this->table_name}`" ) : false;
    }

    /**
     * SQL query string for creating the table.
     *
     * @access protected
     * @abstract
     * @return string
     * @since 1.0.0
     */
    protected abstract function get_create_table_query_string() : string;
}