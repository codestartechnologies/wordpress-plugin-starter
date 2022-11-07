<?php
/**
 * WPSTaxonomyFormField class file.
 *
 * This file contains WPSTaxonomyFormField class that will register a custom taxonomy form field.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\TaxonomyFormFields;

use Codestartechnologies\WordpressPluginStarter\Abstracts\TaxonomyFormFields;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSTaxonomyFormField' ) ) {
    /**
     * Class WPSTaxonomyFormField
     *
     * This class registers a custom taxonomy form field.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSTaxonomyFormField extends TaxonomyFormFields {

        /**
         * WPSTaxonomyFormField constructor
         */
        public function __construct()
        {
            $this->capability   = 'manage_options';
            $this->post_type    = 'wps_post';
            $this->taxonomy     = 'wps_post_category';
            $this->meta_key     = 'wps_extra_content';
            $this->nonce_name   = 'wps_extra_content_nonce';
            $this->nonce_action = 'handle wps extra content';
            $this->unique_key   = true;
            $this->single_key   = true;
            $this->view_create  = 'taxonomy-form-fields.wps-tax-form-field';
            $this->view_edit    = 'taxonomy-form-fields.wps-tax-form-field-edit';
        }

        /**
         * Fires inside the Add Tag form tag.
         *
         * @return void
         */
        public function taxonomy_term_new_form_tag() : void
        {
            echo 'data-wps-id="wps_tax_form"';
        }

        /**
         * Fires inside the Edit Term form tag.
         *
         * @return void
         */
        public function taxonomy_term_edit_form_tag() : void
        {
            echo 'data-wps-id="wps_tax_form"';
        }

        /**
         * Method to sanitize the term meta value
         *
         * @param mixed $term_meta
         * @return mixed
         */
        public function term_meta_sanitize_cb( mixed $term_meta ) : mixed
        {
            return sanitize_text_field( $term_meta );
        }
    }
}