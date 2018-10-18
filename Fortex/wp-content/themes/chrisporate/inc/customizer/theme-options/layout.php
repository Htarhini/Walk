<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'chrisporate_layout', array(
	'title'               => esc_html__('Layout','chrisporate'),
	'description'         => esc_html__( 'Layout options.', 'chrisporate' ),
	'panel'               => 'chrisporate_theme_options_panel',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[site_layout]', array(
	'sanitize_callback'   => 'chrisporate_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control(  new Chrisporate_Custom_Radio_Image_Control ( $wp_customize, 'chrisporate_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'chrisporate' ),
	'section'             => 'chrisporate_layout',
	'choices'			  => chrisporate_site_layout(),
) ) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'chrisporate_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control(  new Chrisporate_Custom_Radio_Image_Control ( $wp_customize, 'chrisporate_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Global Sidebar Position', 'chrisporate' ),
	'section'             => 'chrisporate_layout',
	'choices'			  => chrisporate_sidebar_position(),
) ) );
