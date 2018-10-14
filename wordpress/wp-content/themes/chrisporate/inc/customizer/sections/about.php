<?php
/**
 * About Section options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add About section
$wp_customize->add_section( 'chrisporate_about_section', array(
	'title'             => esc_html__( 'About Section','chrisporate' ),
	'description'       => esc_html__( 'About Section options.', 'chrisporate' ),
	'panel'             => 'chrisporate_front_page_panel',
) );

// About content enable control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[about_section_enable]', array(
	'default'			=> 	$options['about_section_enable'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[about_section_enable]', array(
	'label'             => esc_html__( 'About Section Enable', 'chrisporate' ),
	'section'           => 'chrisporate_about_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Show page drop-down setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[about_content_page]', array(
	'sanitize_callback' => 'chrisporate_sanitize_page'
) );

$wp_customize->add_control( 'chrisporate_theme_options[about_content_page]', array(
	'label'           	=> esc_html__( 'Select Page', 'chrisporate' ),
	'section'        	=> 'chrisporate_about_section',
	'active_callback' 	=> 'chrisporate_is_about_section_enable',
	'type'				=> 'dropdown-pages'
) );

// About content enable control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[about_skills_enable]', array(
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[about_skills_enable]', array(
	'label'             => esc_html__( 'Enable Skills', 'chrisporate' ),
	'description'       => sprintf( '%1$s <a href="' . esc_url( 'https://wordpress.org/plugins/tp-piebuilder/' ) . '" target="_blank"> %2$s </a> %3$s', esc_html__( 'Show your skills in horizontal line graph. Use shortcode from TP PieBuilder plugin. ', 'chrisporate' ), esc_html__( 'Click Here', 'chrisporate' ), esc_html__( 'to download.', 'chrisporate' ) ),
	'section'           => 'chrisporate_about_section',
	'on_off_label' 		=> chrisporate_switch_options(),
	'active_callback' 	=> 'chrisporate_is_about_section_enable',
) ) );

// About us title setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[about_graph]', array(
	'default' 			=> $options['about_graph'],
	'sanitize_callback' => 'sanitize_textarea_field',
) );

$wp_customize->add_control( 'chrisporate_theme_options[about_graph]', array(
	'label'           	=> esc_html__( 'Shortcode', 'chrisporate' ),
	'section'        	=> 'chrisporate_about_section',
	'active_callback' 	=> 'chrisporate_is_about_section_skills_enable',
	'type'				=> 'textarea',
) );