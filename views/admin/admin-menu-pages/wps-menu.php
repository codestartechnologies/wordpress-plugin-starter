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

 /**
  * The variables below are passed from WPSMenu class, and have overidden the default variables passed by Menus abstract class.
  *
  * $author    - Author name.
  */
?>

<div class="wrap">

    <h1> <?php echo get_admin_page_title(); ?> </h1>
    <p>
        <?php printf( __( 'WordPress Plugin starter created by <b>%s</b>.', 'wps' ), $author ); ?>
    </p>

</div>
