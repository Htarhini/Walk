<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

/**
 * chrisporate_footer_content hook
 *
 * @hooked chrisporate_add_contact_section -  10
 *
 */
do_action( 'chrisporate_footer_content' );

/**
 * chrisporate_content_end_action hook
 *
 * @hooked chrisporate_content_end -  10
 *
 */
do_action( 'chrisporate_content_end_action' );

/**
 * chrisporate_footer hook
 *
 * @hooked chrisporate_footer_start -  10
 * @hooked Chrisporate_Footer_Widgets->add_footer_widgets -  20
 * @hooked chrisporate_social_menu -  30
 * @hooked chrisporate_footer_site_info -  40
 * @hooked chrisporate_footer_end -  100
 *
 */
do_action( 'chrisporate_footer' );

/**
 * chrisporate_page_end_action hook
 *
 * @hooked chrisporate_page_end -  10
 *
 */
do_action( 'chrisporate_page_end_action' ); 

?>

<?php wp_footer(); ?>

</body>
</html>
