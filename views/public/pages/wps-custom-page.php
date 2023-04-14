<?php
/**
 * This is a part file that is used to display the contents for a page in the front-end area of the site.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link    https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license GNU/AGPLv3
 * @since   1.0.0
 */

get_header();

?>

<br /><br />
<h2>
    <center> <?php printf( __( 'This is a custom page created by <b><i>%s</i></b> plugin.', 'wps' ), WPS_PLUGIN_NAME ?? '' ); ?> </center>
</h2>
<br /><br /><br />

<?php get_footer(); ?>