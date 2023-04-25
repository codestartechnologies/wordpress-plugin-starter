<?php
/**
 * WPSUsersTable class file.
 *
 * This file contains WPSUsersTable class which creates a custom table in the database.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace WPS_Plugin\App\Admin\DatabaseTables;

use Codestartechnologies\WordpressPluginStarter\Abstracts\DatabaseTables;
use Codestartechnologies\WordpressPluginStarter\Traits\DatabaseTables as TraitsDatabaseTables;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSUsersTable Class
 *
 * This class creates a custom table in the database.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSUsersTable extends DatabaseTables
{

    use TraitsDatabaseTables;

    /**
     * Database table prefix
     *
     * @static
     * @var string
     * @since 1.0.0
     */
    public string $prefix = 'wps_';

    /**
     * WPSUsersTable constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->table_name = $this->prefix . 'users';
    }

    /**
     * SQL query string for creating the table.
     *
     * @access protected
     * @return string
     * @since 1.0.0
     */
    protected function get_create_table_query_string() : string
    {
        return "
            CREATE TABLE IF NOT EXISTS `{$this->table_name}` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `admin_name` VARCHAR(50) NOT NULL,
                `admin_email` VARCHAR(50) NOT NULL,
                `admin_password` VARCHAR(50) NOT NULL,
                PRIMARY KEY (`id`)
            )
        ";
    }

    /**
     * SQL query string for modifying the table column(s).
     *
     * @access protected
     * @return string
     * @since 1.0.0
     */
    protected function get_modify_column_query_string() : string
    {
        $sql = "ALTER TABLE `{$this->table_name}` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `admin_password`;";
        return $sql;
    }
}
