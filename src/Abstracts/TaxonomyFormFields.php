<?php
/**
 * TaxonomyFormFields abstract class file.
 *
 * This file contains TaxonomyFormFields abstract class which contains contracts for classes that will register taxonomy form fields.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace Codestartechnologies\WordpressPluginStarter\Abstracts;

use Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'TaxonomyFormFields' ) ) {
    /**
     * Class TaxonomyFormFields
     *
     * This class contains contracts that will be used to register taxonomy form fields.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class TaxonomyFormFields implements ActionHook {
        use ViewLoader;

        /**
         * The post type slug for the form field
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $post_type;

        /**
         * The taxonomy slug for the form field.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $taxonomy;

        /**
         * Metadata key.
         *
         * Used in add_term_meta() and update_term_meta()
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $meta_key;

        /**
         * Nonce name
         *
         * Used to validate the field value before it is saved or updated.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $nonce_name;

        /**
         * Nonce Action name
         *
         * Used to validate the field value before it is saved or updated.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $nonce_action;

        /**
         * The capability to check before saving or updating the field value.
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $capability;

        /**
         * Optional. Whether the same key should not be added. Default false.
         *
         * Used in add_term_meta()
         *
         * @access protected
         * @var boolean
         * @since 1.0.0
         */
        protected bool $unique_key = false;

        /**
         * Optional. Whether to return a single value. This parameter has no effect if $key is not specified. Default false.
         *
         * Used in get_term_meta()
         *
         * @access protected
         * @var boolean
         * @since 1.0.0
         */
        protected bool $single_key = false;

        /**
         * The view used to add the field
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $view_create;

        /**
         * The view used to edit the field
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $view_edit;

        /**
         * Register add_action() and remove_action().
         *
         * @access public
         * @return void
         * @since 1.0.0
         */
        public function register_add_action() : void
        {
            add_action( "{$this->taxonomy}_term_new_form_tag", array( $this, 'taxonomy_term_new_form_tag' ) );
            add_action( "{$this->taxonomy}_term_edit_form_tag", array( $this, 'taxonomy_term_edit_form_tag' ) );
            add_action( "{$this->taxonomy}_add_form_fields", array( $this, 'add_form_field' ) );
            add_action( "{$this->taxonomy}_edit_form_fields", array( $this, 'edit_form_field' ), 10, 2 );
            add_action( "saved_{$this->taxonomy}", array( $this, 'save_taxonomy_term' ), 10, 3 );
            add_action( "edited_{$this->taxonomy}", array( $this, 'edit_taxonomy_term' ), 10, 2 );
        }

        /**
         * "{$taxonomy}_term_new_form_tag" action hook callback
         *
         * Fires inside the Add Tag form tag. Example: can be used to add enctype="multipart/form-data" attribute to the form tag.
         *
         * @access public
         * @return void
         * @since 1.0.0
         */
        public function taxonomy_term_new_form_tag() : void
        {
            //
        }

        /**
         * "{$taxonomy}_term_edit_form_tag" action hook callback
         *
         * Fires inside the Edit Term form tag. Example: can be used to add enctype="multipart/form-data" attribute to the form tag.
         *
         * @access public
         * @return void
         * @since 1.0.0
         */
        public function taxonomy_term_edit_form_tag() : void
        {
            //
        }

        /**
         * "{$taxonomy}_add_form_fields" action hook callback
         *
         * Fires after the Add Term form fields.
         *
         * @final
         * @access public
         * @param string $taxonomy The taxonomy slug.
         * @return void
         * @since 1.0.0
         */
        final public function add_form_field( string $taxonomy ) : void
        {
            $this->load_view( $this->view_create, array(
                'taxonomy_slug' => $taxonomy,
                'meta_key'      => $this->meta_key,
                'nonce_name'    => $this->nonce_name,
                'nonce_action'  => $this->nonce_action,
            ) );
        }

        /**
         * "{$taxonomy}_edit_form_fields" action hook callback
         *
         * Fires after the Edit Term form fields are displayed.
         *
         * @final
         * @access public
         * @param \WP_Term $tag      Current taxonomy term object.
         * @param string   $taxonomy Current taxonomy slug.
         * @return void
         * @since 1.0.0
         */
        final public function edit_form_field( \WP_Term $tag, string $taxonomy ) : void
        {
            $meta_value = get_term_meta( $tag->term_id, $this->meta_key, $this->single_key );
            $this->load_view( $this->view_edit, array(
                'taxonomy'      => $tag,
                'taxonomy_slug' => $taxonomy,
                'meta_key'      => $this->meta_key,
                'meta_value'    => $meta_value,
                'nonce_name'    => $this->nonce_name,
                'nonce_action'  => $this->nonce_action,
            ) );
        }

        /**
         * "saved_{$taxonomy}" action hook callback
         *
         * Fires after a term in a specific taxonomy has been saved, and the term cache has been cleared.
         *
         * @param int  $term_id Term ID.
         * @param int  $tt_id   Term taxonomy ID.
         * @param bool $update  Whether this is an existing term being updated.
         */
        final public function save_taxonomy_term( int $term_id, int $tt_id, bool $update ) : void
        {
            if ( $this->validate() ) {
                $meta_value = $this->term_meta_sanitize_cb( $_POST[ $this->meta_key ] );
                add_term_meta( $term_id, $this->meta_key, $meta_value, $this->unique_key );
            }
        }

        /**
         * "edited_{$taxonomy}" action hook callback
         *
         * Fires after a term for a specific taxonomy has been updated, and the term cache has been cleaned.
         *
         * @param int $term_id Term ID.
         * @param int $tt_id   Term taxonomy ID.
         */
        final public function edit_taxonomy_term( int $term_id, int $tt_id ) : void
        {
            if ( $this->validate() ) {
                $meta_value = $this->term_meta_sanitize_cb( $_POST[ $this->meta_key ] );
                update_term_meta( $term_id, $this->meta_key, $meta_value );
            }
        }

        /**
         * Method to validate nonce and and user capability when saving or updating taxonomy field.
         *
         * @access private
         * @return boolean
         * @since 1.0.0
         */
        private function validate() : bool
        {
            return (
                isset( $_POST[ $this->nonce_name ] ) &&
                wp_verify_nonce( $_POST[ $this->nonce_name ], $this->nonce_action ) &&
                current_user_can( $this->capability ) &&
                isset( $_POST[ $this->meta_key ] )
            );
        }

        /**
         * Method to sanitize the term meta value
         *
         * @abstract
         * @param mixed $term_meta
         * @return mixed
         * @since 1.0.0
         */
        abstract public function term_meta_sanitize_cb( mixed $term_meta ) : mixed;
    }
}