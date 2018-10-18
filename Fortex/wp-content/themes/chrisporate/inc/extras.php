<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function chrisporate_body_classes( $classes ) {
	$options = chrisporate_get_theme_options();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class for layout
	$classes[] = esc_attr( $options['site_layout'] );

	// Add a class for sidebar
	$sidebar_position = chrisporate_layout();
	$sidebar = is_singular() ? get_post_meta( get_the_id(), 'chrisporate-selected-sidebar', true ) : 'sidebar-1';
	if ( is_active_sidebar( $sidebar ) ) {
		$classes[] = esc_attr( $sidebar_position );
	} else {
		$classes[] = 'no-sidebar';
	}

	$colors = esc_attr( $options['colorscheme'] );
	$classes[] = 'colors-' . $colors;

	return $classes;
}
add_filter( 'body_class', 'chrisporate_body_classes' );
