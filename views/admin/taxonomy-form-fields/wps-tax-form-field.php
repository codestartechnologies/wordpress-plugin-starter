<?php
/**
 * $taxonomy_slug   - The taxonomy slug
 * $meta_key        - Metadata key
 * $nonce_name      - Nonce name
 * $nonce_action    - Nonce Action name
 *
 */

?>

<div class="form-field form-required term-<?php echo $meta_key; ?>-wrap">
    <label for="<?php echo $meta_key; ?>"> <?php esc_html_e( 'Extra Content', 'wps' ); ?> </label>
    <?php wp_nonce_field( $nonce_action, $nonce_name ); ?>
    <textarea name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" class="postbox" rows="5"></textarea>
    <p> <?php esc_html_e( 'The extra content to show on the taxonomy page', 'wps' ) ?> </p>
</div>
