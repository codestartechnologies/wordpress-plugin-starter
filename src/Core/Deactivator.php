<?php
/**
 * Deactivator class file.
 *
 * This file contains Deactivator class which handles functionalities that run when plugin is deactivated.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://codestar.com.ng
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Core;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PostTypes;
use Codestartechnologies\WordpressPluginStarter\Abstracts\Taxonomies;
use Codestartechnologies\WordpressPluginStarter\Traits\Logger;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Deactivator' ) ) {
    /**
     * Class Deactivator
     *
     * This class handles functionalities that run when plugin is deactivated.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Deactivator {
        use Logger;

        /**
         * An array of post types
         *
         * @access private
         * @var PostTypes[]
         * @since 1.0.0
         */
        private array $post_types;

        /**
         * An array of taxonomies
         *
         * @access private
         * @var Taxonomies[]
         * @since 1.0.0
         */
        private array $taxonomies;

        /**
         * Method that will run when plugin is deactivated
         *
         * @access public
         * @param array|null $post_types
         * @param array|null $taxonomies
         * @return void
         * @since 1.0.0
         */
        public function run( ?array $post_types = null, ?array $taxonomies = null ) : void
        {
            $this->post_types = $post_types;

            $this->taxonomies = $taxonomies;

            $this->log_deactivator_info();

            $this->unregister_post_types();

            $this->unregister_taxonomies();

            flush_rewrite_rules();
        }

        /**
         * Log information about the user that deactivated the plugin.
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function log_deactivator_info() : void
        {
            $current_user = wp_get_current_user();

            if ( is_object( $current_user ) ) {
                $message = sprintf(
                    esc_html__( 'The user with login of: %1$s and display name of %2$s, deactivated this plugin', 'wps' ),
                    $current_user->user_login,
                    $current_user->display_name
                );

                $this->log( __FILE__, $message, 'info' );
            }
        }

        /**
         * Unregister post types
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function unregister_post_types() : void
        {
            if ( ! empty( $this->post_types ) ) {
                foreach ( $this->post_types as $post_type ) {
                    $post_type->unregister();
                }
            }
        }

        /**
         * Unregister taxonomies
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function unregister_taxonomies() : void
        {
            if ( ! empty( $this->taxonomies ) ) {
                foreach ( $this->taxonomies as $taxonomy ) {
                    $taxonomy->unregister();
                }
            }
        }
    }
}