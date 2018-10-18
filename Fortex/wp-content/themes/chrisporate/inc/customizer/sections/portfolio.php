<?php
/**
 * Portfolio Section options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add Portfolio section
$wp_customize->add_section( 'chrisporate_portfolio_section', array(
	'title'             => esc_html__( 'Portfolio Section','chrisporate' ),
	'description'       => esc_html__( 'Portfolio Section options.', 'chrisporate' ),
	'panel'             => 'chrisporate_front_page_panel',
) );

// Portfolio content enable control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[portfolio_section_enable]', array(
	'default'			=> 	$options['portfolio_section_enable'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[portfolio_section_enable]', array(
	'label'             => esc_html__( 'Portfolio Section Enable', 'chrisporate' ),
	'section'           => 'chrisporate_portfolio_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );


// Portfolio title setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[portfolio_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['portfolio_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'chrisporate_theme_options[portfolio_title]', array(
	'label'           	=> esc_html__( 'Title', 'chrisporate' ),
	'section'        	=> 'chrisporate_portfolio_section',
	'active_callback' 	=> 'chrisporate_is_portfolio_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'chrisporate_theme_options[portfolio_title]', array(
		'selector'            => '#portfolio .container .portfolio-content-title .entry-header h2.entry-title',
		'settings'            => 'chrisporate_theme_options[portfolio_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'chrisporate_portfolio_title_partial',
    ) );
}

for ( $i = 1; $i <= 4; $i++ ) {
	// Show page drop-down setting and control
	$wp_customize->add_setting( 'chrisporate_theme_options[portfolio_content_page_' . $i . ']', array(
		'sanitize_callback' => 'chrisporate_sanitize_page'
	) );

	$wp_customize->add_control( 'chrisporate_theme_options[portfolio_content_page_' . $i . ']', array(
		'label'           	=> sprintf( esc_html__( 'Select Page %d', 'chrisporate' ), $i ),
		'section'        	=> 'chrisporate_portfolio_section',
		'active_callback' 	=> 'chrisporate_is_portfolio_section_enable',
		'type'				=> 'dropdown-pages'
	) );
}
