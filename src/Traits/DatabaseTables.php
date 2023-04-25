<?php
/**
 * DatabaseTables trait file.
 *
 * This file contains DatabaseTables trait for modifying database table columns.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Traits;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Trait DatabaseTables
 *
 * This trait is used for modifying database table columns.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
trait DatabaseTables
{
    /**
     * Modify the table column(s)
     *
     * @final
     * @return void
     * @since 1.0.0
     */
    final public function modify() : void
    {
        $queries = \explode( ";", $this->get_modify_column_query_string() );

        foreach ( $queries as $query ) {
            $this->wpdb->query( $query );
        }
    }

    /**
     * SQL query string for modifying the table column(s).
     *
     * @access protected
     * @abstract
     * @return string
     * @since 1.0.0
     */
    protected abstract function get_modify_column_query_string() : string;
}