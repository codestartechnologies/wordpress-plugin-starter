<?php
/**
 * This file contains configuration settings for loading views.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since       1.0.0
 */

return array(

    /**
     * Customize markups used in displaying error messages when loading views
     */
    'error_messages'    => array(

        /**
         * Markup for not found error message when loading a view.
         *
         * %s is used to show the full path to the requested view.
         *
         * Default: <h3 style="color: red;">View could not be loaded!</h3><p>There was an error loading <b>%s</b>. Please check file exist and is readable. </p>
         */
        'not_found'     => '',

        /**
         * Markup for invalid view type error message when loading a view.
         *
         * %s is used to show the type of the requested view.
         *
         * Default: <h3 style="color: red;">View type does not exist!</h3><p>View of type <b>%s</b> is invalid. Valid types are <em>admin</em> and <em>site</em> </p>
         */
        'invalid_type'  => '',

    ),

);