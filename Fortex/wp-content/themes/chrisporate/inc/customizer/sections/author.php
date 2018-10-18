<?php
/**
 * Author Section options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add Author section
$wp_customize->add_section( 'chrisporate_author_section', array(
	'title'             => esc_html__( 'Author Section','chrisporate' ),
	'description'       => esc_html__( 'Author Section options.', 'chrisporate' ),
	'panel'             => 'chrisporate_front_page_panel',
) );

// Author content enable control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[author_section_enable]', array(
	'default'			=> 	$options['author_section_enable'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[author_section_enable]', array(
	'label'             => esc_html__( 'Author Section Enable', 'chrisporate' ),
	'section'           => 'chrisporate_author_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );


// Show page drop-down setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[author_content_page]', array(
	'sanitize_callback' => 'chrisporate_sanitize_page'
) );

$wp_customize->add_control( 'chrisporate_theme_options[author_content_page]', array(
	'label'           	=> esc_html__( 'Select Page', 'chrisporate' ),
	'section'        	=> 'chrisporate_author_section',
	'active_callback' 	=> 'chrisporate_is_author_section_enable',
	'type'				=> 'dropdown-pages'
) );