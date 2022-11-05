<?php
/**
 * This file contains configuration settings for custom routes
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @link        https://codestar.com.ng
 */

return array(
    /**
     * Set routes that need to be registered along with the views
     */
    'routes'    => array(
        /**
         * Add a route for {site_url}/wps-page
         *
         */
        '/wps-page'     => array(
            /**
             * The view displayed by the route
             */
            'view'  => 'pages.wps-custom-page',

            /**
             * The page title
             */
            'title' => 'WPS Custom Page',
        ),
    ),

);
