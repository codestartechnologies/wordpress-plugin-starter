<?php
/**
 * This is a part file that is used to display a view for a setting field.
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
 * $option_name     - The option name. Passed to the view by default
 * $label_for       - The field id. Passed to the view by default
 *
 */

$option_name = esc_attr( $option_name );
$label_for = esc_attr( $label_for );
$option = get_option( $option_name );

?>

<input type="text" name="<?php echo $option_name . '[' . $label_for . ']'; ?>" id="<?php echo $label_for; ?>" class="regular-text"
    value="<?php echo $option[ $label_for ] ?? null; ?>" />
