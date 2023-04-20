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
 * The variables below are passed from WPSSettingMenu class, and have overidden the default variables passed by Menus abstract class.
 *
 * $page - Page slug to display the setting.
 *
 */

?>

<div class="wrap">

    <form action="<?php echo esc_attr( admin_url( 'options.php') ); ?>" method="post">

        <?php

            settings_fields( $page );

            do_settings_sections( $page );

            submit_button();

        ?>

    </form>

</div>
