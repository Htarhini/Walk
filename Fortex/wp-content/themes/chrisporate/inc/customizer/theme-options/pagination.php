<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add pagination section
$wp_customize->add_section( 'chrisporate_pagination', array(
	'title'               => esc_html__('Pagination','chrisporate'),
	'description'         => esc_html__( 'Pagination section options.', 'chrisporate' ),
	'panel'               => 'chrisporate_theme_options_panel', 
) );

// Pagination enable setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[pagination_enable]', array(
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
	'default'             => $options['pagination_enable'],
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'chrisporate' ),
	'section'             => 'chrisporate_pagination',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Pagination setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'chrisporate_sanitize_select',
	'default'             => $options['pagination_type'],
) );

$wp_customize->add_control( 'chrisporate_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'chrisporate' ),
	'section'             => 'chrisporate_pagination',
	'type'                => 'select',
	'choices'			  => chrisporate_pagination_options(),
	'active_callback'	  => 'chrisporate_is_pagination_enable',
) );
