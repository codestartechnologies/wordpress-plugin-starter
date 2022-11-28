<?php
/**
 * This file contains configuration settings for custom routes that your plugin will register.
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
             * Specify the view displayed by the route
             */
            'view'  => 'pages.wps-custom-page',

            /**
             * Specify the page title
             */
            'title' => 'WPS Custom Page',

        ),

        /**
         * You can add your custom routes below
         */


    ),

);
