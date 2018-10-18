<?php
/**
 * Banner Section options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add Banner section
$wp_customize->add_section( 'chrisporate_banner_section', array(
	'title'             => esc_html__( 'Banner Section','chrisporate' ),
	'description'       => esc_html__( 'Note: Background Video/Image is updated from Header Media Panel.', 'chrisporate' ),
	'panel'             => 'chrisporate_front_page_panel',
) );

// title setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[banner_section_title]', array(
	'default' 			=> $options['banner_section_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'chrisporate_theme_options[banner_section_title]', array(
	'label'           	=> esc_html__( 'Title', 'chrisporate' ),
	'section'        	=> 'chrisporate_banner_section',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'chrisporate_theme_options[banner_section_title]', array(
		'selector'            => '#header-featured-image .video-content h1',
		'settings'            => 'chrisporate_theme_options[banner_section_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'chrisporate_banner_section_title_partial',
    ) );
}

// title setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[banner_section_sub_title]', array(
	'default' 			=> $options['banner_section_sub_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'chrisporate_theme_options[banner_section_sub_title]', array(
	'label'           	=> esc_html__( 'Sub Title', 'chrisporate' ),
	'section'        	=> 'chrisporate_banner_section',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'chrisporate_theme_options[banner_section_sub_title]', array(
		'selector'            => '#header-featured-image .video-content h2',
		'settings'            => 'chrisporate_theme_options[banner_section_sub_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'chrisporate_banner_section_sub_title_partial',
    ) );
}
