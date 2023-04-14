<?php
/**
 * WPSPublicAjaxRequest class file.
 *
 * This file contains WPSPublicAjaxRequest class that will register a custom public ajax request.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Public\AjaxRequests;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PublicAjax;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WPSPublicAjaxRequest
 *
 * This class registers a custom admin public request.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSPublicAjaxRequest extends PublicAjax
{
    /**
     * WPSPublicAjaxRequest Class Constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->ajax_action          = 'wps_public_ajax_request';
        $this->nonce_action         = 'wps_public_ajax_request_nonce';
        $this->script_handle        = 'wps_public_ajax_js';
        $this->script_src           = WPS_JS_BASE_URL . 'public-ajax.js';
        $this->script_dependencies  = array( 'jquery' );
        $this->script_version       = false;
        $this->script_in_footer     = true;
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