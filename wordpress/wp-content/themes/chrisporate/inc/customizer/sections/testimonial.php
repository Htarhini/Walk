<?php
/**
 * Testimonial Section options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add Testimonial section
$wp_customize->add_section( 'chrisporate_testimonial_section', array(
	'title'             => esc_html__( 'Testimonial Section','chrisporate' ),
	'description'       => esc_html__( 'Testimonial Section options.', 'chrisporate' ),
	'panel'             => 'chrisporate_front_page_panel',
) );

// Testimonial content enable control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[testimonial_section_enable]', array(
	'default'			=> 	$options['testimonial_section_enable'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[testimonial_section_enable]', array(
	'label'             => esc_html__( 'Testimonial Section Enable', 'chrisporate' ),
	'section'           => 'chrisporate_testimonial_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// testimonial title setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[testimonial_section_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['testimonial_section_title'],
) );

$wp_customize->add_control( 'chrisporate_theme_options[testimonial_section_title]', array(
	'label'           	=> esc_html__( 'Section Title', 'chrisporate' ),
	'section'        	=> 'chrisporate_testimonial_section',
	'active_callback' 	=> 'chrisporate_is_testimonial_section_enable',
	'type'				=> 'text',
) );

// Testimonial additional image setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[testimonial_background_image]', array(
	'default' 			=> $options['testimonial_background_image'],
	'sanitize_callback' => 'chrisporate_sanitize_image',
) );

$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'chrisporate_theme_options[testimonial_background_image]',
		array(
		'label'       		=> esc_html__( 'Select background Image', 'chrisporate' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'chrisporate' ), 1920, 1000 ),
		'section'     		=> 'chrisporate_testimonial_section',
		'active_callback'	=> 'chrisporate_is_testimonial_section_enable',
) ) );


for ( $i = 1; $i <= 2; $i++ ) {
	// Show page drop-down setting and control
	$wp_customize->add_setting( 'chrisporate_theme_options[testimonial_content_page_' . $i . ']', array(
		'sanitize_callback' => 'chrisporate_sanitize_page'
	) );

	$wp_customize->add_control( 'chrisporate_theme_options[testimonial_content_page_' . $i . ']', array(
		'label'           	=> sprintf( esc_html__( 'Select Page %d', 'chrisporate' ), $i ),
		'section'        	=> 'chrisporate_testimonial_section',
		'active_callback' 	=> 'chrisporate_is_testimonial_section_enable',
		'type'				=> 'dropdown-pages'
	) );
}
