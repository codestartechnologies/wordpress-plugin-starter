<?php
/**
 * WPSAdminAjaxRequest class file.
 *
 * This file contains WPSAdminAjaxRequest class that will register a custom admin ajax request.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\AjaxRequests;

use Codestartechnologies\WordpressPluginStarter\Abstracts\AdminAjax;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WPSAdminAjaxRequest
 *
 * This class registers a custom admin ajax request.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSAdminAjaxRequest extends AdminAjax
{
    /**
     * WPSAdminAjaxRequest Class Constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->ajax_action          = 'wps_admin_ajax_request';
        $this->nonce_action         = 'wps_admin_ajax_request_nonce';
        $this->script_handle        = 'wps_admin_ajax_js';
        $this->script_src           = WPS_JS_BASE_URL . 'admin-ajax.js';
        $this->script_dependencies  = array( 'jquery' );
        $this->script_version       = false;
        $this->script_in_footer     = true;
    }

    /**
     * Method to determine which admin page to enqueue the javascript file for making ajax request
     *
     * @param string $hook_suffix
     * @return boolean
     * @since 1.0.0
     */
    public function can_enqueue_script( string $hook_suffix ) : bool
    {
        return true;
    }

    /**
     * Method for handling the ajax request after ajax nonce action have been validated
     *
     * @return void
     * @since 1.0.0
     */
    public function handle_request() : void
    {
        $data = $_POST['wps_data'] ?? null;
        $message = ( $data === 'Hello WPS!' ) ? 'Your request data is valid!' : 'Your request data is not valid!';
        wp_send_json_success( array(
            'msg'  => $message . '(' . $data . ')',
        ) );
    }
}