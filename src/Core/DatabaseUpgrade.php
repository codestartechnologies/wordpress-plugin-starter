<?php
/**
 * DatabaseUpgrade class file.
 *
 * This file contains DatabaseUpgrade class which handles database upgrade.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Core;

use Codestartechnologies\WordpressPluginStarter\Abstracts\DatabaseTables;
use Codestartechnologies\WordpressPluginStarter\Traits\Validator;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * DatabaseUpgrade class
 *
 * This class which handles database upgrade. This includes creating new tables, modifying, and deleting existing tables.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class DatabaseUpgrade
{

    use Validator;

    /**
     * An array containing classes for creating database tables during activation
     *
     * @access private
     * @var DatabaseTables[]
     * @since 1.0.0
     */
    private array $db_tables;

    /**
     * Option name used to store last database version in wp_options table
     *
     * @access private
     * @var string
     * @since 1.0.0
     */
    private string $last_db_version_option_name;

    /**
     * Plugin database version
     *
     * @access private
     * @var string
     * @since 1.0.0
     */
    private string $db_version;

    /**
     * DatabaseUpgrade constructor
     *
     * @param array|null $db_tables
     * @since 1.0.0
     */
    public function __construct( array $db_tables = null )
    {
        $this->db_version =  wps_config( 'database.db_version' );
        $this->last_db_version_option_name = wps_config( 'database.last_db_version_name' );

        if ( ! is_null( $db_tables ) ) {
            $this->db_tables = $this->validate( $db_tables, DatabaseTables::class )['valid'];
        }
    }

    /**
     * Check if database needs an upgrade
     *
     * @return boolean
     * @since 1.0.0
     */
    public function can_perform_upgrade() : bool
    {
        return ( intval( $this->db_version ) > intval( get_option( $this->last_db_version_option_name ) ) );
    }

    /**
     * Create tables or modify/alter table columns
     *
     * @return void
     * @since 1.0.0
     */
    public function run_upgrade() : void
    {
        $this->create_or_modify_database_tables( function( object $table ) {
            if ( method_exists( $table, 'modify' ) ) {
                $table->modify();
            }
        } );

        update_option( $this->last_db_version_option_name, $this->db_version );
    }

    /**
     * Create tables or modify/alter table columns
     *
     * @access protected
     * @param callable $callback
     * @return void
     * @since 1.0.0
     */
    protected function create_or_modify_database_tables( callable $callback = null ) : void
    {
        global $wpdb;

        if ( ! empty( $this->db_tables ) ) {
            foreach ( $this->db_tables as $table ) {
                $table->set_wpdb( $wpdb );
                $table->create();
                $callback( $table );
            }
        }
    }

    /**
     * Drop tables
     *
     * @return void
     * @since 1.0.0
     */
    public function drop_database_tables() : void
    {
        global $wpdb;

        if ( ! empty( $this->db_tables ) ) {
            foreach ( $this->db_tables as $table ) {
                $table->set_wpdb( $wpdb );
                $table->destroy();
            }
        }
    }
}