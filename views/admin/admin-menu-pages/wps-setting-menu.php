<?php
/**
 * $page     - Passed to the view by WPSSettingMenu Class.
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
