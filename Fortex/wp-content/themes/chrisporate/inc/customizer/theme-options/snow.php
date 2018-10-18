<?php
/**
 * Snow Fall options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'chrisporate_snow', array(
	'title'               => esc_html__('Snow Fall','chrisporate'),
	'description'         => esc_html__( 'Snow Fall options.', 'chrisporate' ),
	'panel'               => 'chrisporate_theme_options_panel',
) );

// Snow fall effect setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[snow_fall]', array(
	'default'           => $options['snow_fall'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[snow_fall]', array(
	'label'             => esc_html__( 'Enable Snow Fall', 'chrisporate' ),
	'description'       => esc_html__( 'Note: Snow fall will only work on Xmas color theme.', 'chrisporate' ),
	'section'           => 'chrisporate_snow',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );