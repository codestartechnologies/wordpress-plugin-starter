<?php
/**
 * Callbacks trait file.
 *
 * This file contains Callbacks trait for handling arguments with callbacks.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @link       https://codestar.com.ng
 * @since      1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Traits;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! trait_exists( 'Callbacks' ) ) {
    /**
     * Trait Callbacks
     *
     * This trait is used for handling callback arguements.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    trait Callbacks {
        /**
         * This method will check if a value is a valid callback, and return it.
         *
         * @final
         * @access public
         * @param mixed $callback
         * @return mixed
         * @since 1.0.0
         */
        final public function get_valid_callback( mixed $callback ) : mixed
        {
            return ( is_callable( $callback ) ) ? $callback : ( ( is_callable( array( $this, $callback ) ) ) ? array( $this, $callback ) : null );
        }

        /**
         * This method will check if a value in an array is a valid callback, and return the array.
         *
         * @final
         * @access public
         * @param array $setting
         * @param string $callback
         * @return array
         * @since 1.0.0
         */
        final function get_valid_callback_for_arrays( array $setting, string $callback ) : array
        {
            if ( isset( $setting[ $callback ] ) && ! empty( $setting[ $callback ] ) ) {
                $setting[$callback] = ( is_callable( $setting[$callback] ) )
                    ? $setting[$callback]
                    : ( ( is_callable( array( $this, $setting[$callback] ) ) ) ? array( $this, $setting[$callback] ) : null );
            }

            return $setting;
        }
    }
}