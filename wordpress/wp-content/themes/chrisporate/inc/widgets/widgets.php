<?php
/**
 * Chrisporate widgets inclusion
 *
 * This is the template that includes all custom widgets of Chrisporate
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

/*
 * Add Latest Posts widget
 */
require get_template_directory() . '/inc/widgets/latest-posts-widget.php';

/**
 * Register widgets
 */
function chrisporate_register_widgets() {	
	register_widget( 'Chrisporate_Latest_Post' );
}
add_action( 'widgets_init', 'chrisporate_register_widgets' );