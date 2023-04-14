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
 * $random_text     - Passed to the view by WPSMenu Class.
 */

?>

<div class="wrap">

    <h1> <?php echo get_admin_page_title(); ?> </h1>
    <p>
        <b>This is a random text:</b> <?php $random_text; ?>
    </p>

</div>
