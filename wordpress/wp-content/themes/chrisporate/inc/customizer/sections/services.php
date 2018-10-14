<?php
/**
 * Services Section options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add Service section
$wp_customize->add_section( 'chrisporate_service_section', array(
	'title'             => esc_html__( 'Service Section','chrisporate' ),
	'description'       => sprintf( '<b> %s </b>', esc_html__( 'Note: To change icon for this section please go to the page/post you selected and update the icon meta value.', 'chrisporate' ) ),
	'panel'             => 'chrisporate_front_page_panel',
) );

// Service content enable control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[service_section_enable]', array(
	'default'			=> 	$options['service_section_enable'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[service_section_enable]', array(
	'label'             => esc_html__( 'Service Section Enable', 'chrisporate' ),
	'section'           => 'chrisporate_service_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Service title setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[service_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['service_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'chrisporate_theme_options[service_title]', array(
	'label'           	=> esc_html__( 'Title', 'chrisporate' ),
	'section'        	=> 'chrisporate_service_section',
	'active_callback' 	=> 'chrisporate_is_service_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'chrisporate_theme_options[service_title]', array(
		'selector'            => '#services .container .services-content-title .entry-header h2.entry-title',
		'settings'            => 'chrisporate_theme_options[service_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'chrisporate_service_title_partial',
    ) );
}

for ( $i = 1; $i <= 3; $i++ ) {
	// Show page drop-down setting and control
	$wp_customize->add_setting( 'chrisporate_theme_options[service_content_page_' . $i . ']', array(
		'sanitize_callback' => 'chrisporate_sanitize_page'
	) );

	$wp_customize->add_control( 'chrisporate_theme_options[service_content_page_' . $i . ']', array(
		'label'           	=> sprintf( esc_html__( 'Select Page %d', 'chrisporate' ), $i ),
		'section'        	=> 'chrisporate_service_section',
		'active_callback' 	=> 'chrisporate_is_service_section_enable',
		'type'				=> 'dropdown-pages'
	) );
}
