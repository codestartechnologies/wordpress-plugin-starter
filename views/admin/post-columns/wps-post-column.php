<?php
/**
 * This is a part file that is used to display view for a post column.
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
 * $post_id         - The current post ID. Passed to the view by default
 * $meta_key        - The meta key. Passed to the view by default
 * $meta_value      - The meta value. Passed to the view by default
 */

?>

<small> <?php echo $meta_value['heading'] ?? null; ?> </small> <b>-</b>
<a href="<?php echo admin_url( 'post.php?post=' . $post_id . '&action=edit' ); ?>">Edit</a>
