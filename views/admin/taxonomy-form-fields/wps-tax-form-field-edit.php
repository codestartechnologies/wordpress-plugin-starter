<?php
/**
 * $taxonomy        - The taxonomy term object
 * $taxonomy_slug   - The taxonomy slug
 * $meta_key        - Metadata key
 * $meta_value      - Metadata value
 * $nonce_name      - Nonce name
 * $nonce_action    - Nonce Action name
 *
 */

?>

<tr class="form-field form-required term-<?php echo $meta_key; ?>-wrap">
    <th scope="row">
        <label for="<?php echo $meta_key; ?>"> <?php esc_html_e( 'Extra Content', 'wps' ); ?> </label>
    </th>
    <td>
        <?php wp_nonce_field( $nonce_action, $nonce_name ); ?>
        <textarea name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" class="postbox" rows="5"><?php echo $meta_value; ?></textarea>
        <p class="description"> <?php esc_html_e( 'The extra content to show on the taxonomy page', 'wps' ) ?> </p>
    </td>
</tr>
