<?php
/**
 * This is a part file that is used to display view for a taxonomy setting field.
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
 * $meta_key    - The meta key.
 * $meta_value  - The meta value.
 * $post        - The post object.
 */

$heading = $meta_value['heading'] ?? null;
$content = $meta_value['content'] ?? null;

?>

<p>
    <label for="wps_c_heading"> <?php esc_html_e( 'Custom Heading', 'wps' ); ?></label>
    <br /><br />
    <input type="text" name="<?php echo $meta_key; ?>[heading]" id="wps_c_heading" value="<?php echo esc_attr( $heading ); ?>" required />
</p>

<p>
    <label for="wps_post_text_content"> <?php esc_html_e( 'Custom Content', 'wps' ); ?></label>
    <br /><br />
    <textarea name="<?php echo $meta_key; ?>[content]" id="wps_post_text_content" rows="5" required><?php echo $content; ?></textarea>
</p>
