<?php
/**
 * Activator class file.
 *
 * This file contains Activator class which handles functionalities that run when plugin is activated.
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
use Codestartechnologies\WordpressPluginStarter\Traits\Validator;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Activator' ) ) {
    /**
     * Class Activator
     *
     * This class handles functionalities that run when plugin is activated.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Activator {
        use Logger, Validator;

        /**
         * An array containing valid classes for registering post types during activation
         *
         * @access private
         * @var PostTypes[]
         * @since 1.0.0
         */
        private array $post_types;

        /**
         * An array containing valid classes for registering taxonomies during activation
         *
         * @access private
         * @var Taxonomies[]
         * @since 1.0.0
         */
        private array $taxonomies;

        /**
         * Method that will run when plugin is activated
         *
         * @access public
         * @param array|null $post_types
         * @param [type] $taxonomies
         * @return void
         * @since 1.0.0
         */
        public function run( array $post_types = null, array $taxonomies = null ) : void
        {
            $this->setup( $post_types, $taxonomies );
            $this->log_activator_info();
            $this->register_post_types();
            $this->register_taxonomies();
            flush_rewrite_rules();
        }

        /**
         * Setup valid classes that will run when plugin is activated
         *
         * @access private
         * @param array|null $post_types
         * @param array|null $taxonomies
         * @return void
         * @since 1.0.0
         */
        private function setup( array $post_types = null, array $taxonomies = null ) : void
        {
            if ( ! is_null( $post_types ) ) {
                $this->post_types = $this->validate( $post_types, PostTypes::class )['valid'];
            }

            if ( ! is_null( $taxonomies ) ) {
                $this->taxonomies = $this->validate( $taxonomies, Taxonomies::class )['valid'];
            }
        }

        /**
         * Log information about the user that activated the plugin.
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function log_activator_info() : void
        {
            $current_user = wp_get_current_user();

            if ( is_object( $current_user ) ) {
                $message = sprintf(
                    esc_html__( 'The user with login of: %1$s and display name of %2$s, activated this plugin', 'wps' ),
                    $current_user->user_login,
                    $current_user->display_name
                );

                $this->log( __FILE__, $message, 'info' );
            }
        }

        /**
         * Register post types
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function register_post_types() : void
        {
            if ( isset( $this->post_types ) ) {
                foreach ( $this->post_types as $post_type ) {
                    $post_type->register();
                }
            }
        }

        /**
         * Register taxonomies
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function register_taxonomies() : void
        {
            if ( isset( $this->taxonomies ) ) {
                foreach ( $this->taxonomies as $taxonomy ) {
                    $taxonomy->register();
                }
            }
        }
    }
}