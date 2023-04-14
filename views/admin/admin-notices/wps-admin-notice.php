<?php
/**
 * This is a part file that is used to display view for an admin notification.
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
 * $message     - Passed to the view from WPSAdminNotice Class
 *
 */

?>

<div class="notice notice-info is-dismissible">
    <p> <?php echo $message; ?> </p>
</div>
