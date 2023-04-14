<?php
/**
 * This file contains configuration settings for custom routes that your plugin will register.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

return array(

    /**
     * This is where you will create custom route endpoints that can be accessible at the front-end area of the site.
     * Endpoints should start with a slash, followed by the slug. Example : /page-slug. The views for the enpoints are normally stored in the
     * views/public/pages directory.
     *
     * Below is a config setting for custom route endpoint: /wps-page
     */
    'routes'    => array(

        // Route endpoint for {site_url}/wps-page
        '/wps-page'     => array(

            // The part file that will display content on the page
            'view'  => 'pages.wps-custom-page',

            // The page title
            'title' => 'WPS Custom Page',

        ),

        /**
         * You can add your custom route endpoints below.
         */

    ),

);