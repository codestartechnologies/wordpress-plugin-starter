<?php

get_header();

if ( wps_is_theme_active( 'Theme Name' ) ) {
    get_template_part( 'template-parts/content/page' );
} else {

?>

<br /><br />
<h2>
    <center> <?php esc_html_e( 'Install {Theme Name} to view this page', 'wps' ); ?> </center>
</h2>
<br /><br /><br />

<?php

}

get_footer();

?>