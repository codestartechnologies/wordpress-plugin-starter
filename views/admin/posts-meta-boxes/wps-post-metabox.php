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
 * $meta_key    - The meta key. Passed to the view by default
 * $meta_value  - The meta value. Passed to the view by default
 * $post        - The post object. Passed to the view by default
 */

$heading = $meta_value['heading'] ?? null;
$content = $meta_value['content'] ?? null;

?>

<p>
    <label for="wps_post_text_heading"> <?php esc_html_e( 'Heading:', 'wps' ); ?></label><br /><br />
    <input type="text" name="<?php echo $meta_key; ?>[heading]" id="wps_post_text_heading"
        value="<?php printf( esc_attr( '%s' ), $heading ); ?>" required />
</p>

<br /><br />

<p>
    <label for="wps_post_text_content"> <?php esc_html_e( 'Content:', 'wps' ); ?></label><br /><br />
    <textarea name="<?php echo $meta_key; ?>[content]" id="wps_post_text_content" rows="5"
        required><?php printf( esc_attr( '%s' ), $content ); ?></textarea>
</p>
