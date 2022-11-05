<?php
/**
 * Validator trait file.
 *
 * This file contains Validator trait for validating valid classes.
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

if ( ! trait_exists( 'Validator' ) ) {
    /**
     * Trait Validator
     *
     * This trait is used for validating classes that match an abstract class.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    trait Validator {
        /**
         * This method will check the parent class of each objects in an array and return valid and invalid matches.
         *
         * @access public
         * @final
         * @param array $objects        Array containing objects
         * @param string $class_type    Class type to check against
         * @return array
         * @since 1.0.0
         */
        final public function validate( array $objects, string $type ) : array
        {
            $result['valid'] = [];
            $result['invalid'] = [];

            foreach ( $objects as $object ) {
                if ( get_parent_class( $object ) == $type ) {
                    $result['valid'][] = $object;
                } else {
                    $result['invalid'][] = $object;
                }
            }

            return $result;
        }

        /**
         * This method will check the parent class of each objects in an associative array and return valid and invalid matches.
         *
         * @access public
         * @final
         * @param array $objects        An associative array containing objects
         * @param string $class_type    Class type to check against
         * @return array
         * @since 1.0.0
         */
        final public function validate_assoc_array( array $objects, string $type ) : array
        {
            $result['valid'] = [];
            $result['invalid'] = [];

            foreach ( $objects as $object_key => $object ) {
                if ( get_parent_class( $object ) == $type ) {
                    $result['valid'][ $object_key ] = $object;
                } else {
                    $result['invalid'][ $object_key ] = $object;
                }
            }

            return $result;
        }
    }
}