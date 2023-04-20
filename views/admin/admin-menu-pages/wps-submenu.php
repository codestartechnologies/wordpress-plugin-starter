<?php
/**
 * This is a part file that is used to display view for an admin page.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link    https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license GNU/AGPLv3
 * @since   1.0.0
 */

/**
 * Below are default variables that are passed to this file.
 *
 * $page_title     - The page title. Passed to the view by Menus abstract class.
 * $menu_title     - The menu link name. Passed to the view by Menus abstract class.
 *
 */

?>

<div class="wrap">

    <h1> <?php esc_html_e( 'Admin Ajax Request', 'wps' ); ?> </h1>

    <button type="button" data-id="wps_admin_ajax_btn"> <?php esc_html_e( 'Test Admin Ajax Request', 'wps' ); ?> </button>

</div>
