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

?>

<p>
    <input type="text" name="<?php echo $meta_key; ?>" value="<?php echo esc_attr( $meta_value ); ?>" required />
</p>
