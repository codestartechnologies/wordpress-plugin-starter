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
 * $page - Passed to the view by WPSSettingMenu Class.
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
