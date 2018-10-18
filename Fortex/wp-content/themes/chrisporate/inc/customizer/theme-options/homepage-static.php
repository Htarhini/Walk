<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Chrisporate
* @since Chrisporate 1.0.0
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'chrisporate_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content'],
) );

$wp_customize->add_control( 'chrisporate_theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Content', 'chrisporate' ),
	'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'chrisporate' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
) );