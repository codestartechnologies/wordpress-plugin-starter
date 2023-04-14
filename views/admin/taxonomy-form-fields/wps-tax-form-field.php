<?php
/**
 * This is a part file that is used to display a setting section for a taxonomy form.
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
