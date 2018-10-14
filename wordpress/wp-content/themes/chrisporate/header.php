<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage Chrisporate
	 * @since Chrisporate 1.0.0
	 */

	/**
	 * chrisporate_doctype hook
	 *
	 * @hooked chrisporate_doctype -  10
	 *
	 */
	do_action( 'chrisporate_doctype' );

?>
<head>
<?php
	/**
	 * chrisporate_before_wp_head hook
	 *
	 * @hooked chrisporate_head -  10
	 *
	 */
	do_action( 'chrisporate_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>
<?php
	/**
	 * chrisporate_page_start_action hook
	 *
	 * @hooked chrisporate_page_start -  10
	 *
	 */
	do_action( 'chrisporate_page_start_action' ); 

	/**
	 * chrisporate_loader_action hook
	 *
	 * @hooked chrisporate_loader -  10
	 * @hooked chrisporate_add_breadcrumb -  20
	 *
	 */
	do_action( 'chrisporate_before_header' );

	/**
	 * chrisporate_header_action hook
	 *
	 * @hooked chrisporate_header_start -  10
	 * @hooked chrisporate_site_branding -  20
	 * @hooked chrisporate_site_navigation -  30
	 * @hooked chrisporate_header_end -  50
	 *
	 */
	do_action( 'chrisporate_header_action' );

	/**
	 * chrisporate_content_start_action hook
	 *
	 * @hooked chrisporate_content_start -  10
	 *
	 */
	do_action( 'chrisporate_content_start_action' );

	/**
	* chrisporate_primary_content hook
	*
	* @hooked chrisporate_add_about_section - 10
	* @hooked chrisporate_add_service_section - 20
	* @hooked chrisporate_add_portfolio_section - 30
	* @hooked chrisporate_add_author_section - 40
	* @hooked chrisporate_add_latest_blog_section - 50
	* @hooked chrisporate_add_testimonial_section - 60
	*
	*/
    if ( chrisporate_is_frontpage() ) {
    	$i = 1;
    	$sections = chrisporate_sortable_sections();
		foreach ( $sections as $section => $value ) {
			add_action( 'chrisporate_primary_content', 'chrisporate_add_'. $section .'_section', $i . 0 );
			$i++;
		}
		
		do_action( 'chrisporate_primary_content' );
	}