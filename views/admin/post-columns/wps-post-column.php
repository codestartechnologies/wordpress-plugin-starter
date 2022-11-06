<?php
/**
 * $post_id         - The current post ID. Passed to the view by default
 * $meta_key        - The meta key. Passed to the view by default
 * $meta_value      - The meta value. Passed to the view by default
 */

?>

<small> <?php echo $meta_value['heading'] ?? null; ?> </small> <b>-</b>
<a href="<?php echo admin_url( 'post.php?post=' . $post_id . '&action=edit' ); ?>">Edit</a>
