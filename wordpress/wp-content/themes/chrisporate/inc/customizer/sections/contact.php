<?php
/**
 * Contact Section options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add Contact section
$wp_customize->add_section( 'chrisporate_contact_section', array(
	'title'             => esc_html__( 'Contact Section','chrisporate' ),
	'description'       => esc_html__( 'Contact Section options.', 'chrisporate' ),
	'panel'             => 'chrisporate_front_page_panel',
) );

// Contact content enable control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[contact_section_enable]', array(
	'default'			=> 	$options['contact_section_enable'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[contact_section_enable]', array(
	'label'             => esc_html__( 'Contact Section Enable', 'chrisporate' ),
	'section'           => 'chrisporate_contact_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Contact title setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[contact_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['contact_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'chrisporate_theme_options[contact_title]', array(
	'label'           	=> esc_html__( 'Title', 'chrisporate' ),
	'section'        	=> 'chrisporate_contact_section',
	'active_callback' 	=> 'chrisporate_is_contact_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'chrisporate_theme_options[contact_title]', array(
		'selector'            => '#contact-form .container .find-us-content-title .entry-header h2.entry-title',
		'settings'            => 'chrisporate_theme_options[contact_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'chrisporate_contact_title_partial',
    ) );
}

// Contact title setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[contact_address]', array(
	'default' 			=> $options['contact_address'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'chrisporate_theme_options[contact_address]', array(
	'label'           	=> esc_html__( 'Full Address', 'chrisporate' ),
	'section'        	=> 'chrisporate_contact_section',
	'active_callback' 	=> 'chrisporate_is_contact_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'chrisporate_theme_options[contact_address]', array(
		'selector'            => '#contact-form .container .entry-content .address-block .address span',
		'settings'            => 'chrisporate_theme_options[contact_address]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'chrisporate_contact_address_partial',
    ) );
}

// contact phone repeater control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[contact_phone]', array(
	'default' 			=> $options['contact_phone'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Chrisporate_Multi_Input_Custom_Control( $wp_customize, 'chrisporate_theme_options[contact_phone]', array(
	'label'             => esc_html__( 'Phone No', 'chrisporate' ),
	'button_text'       => esc_html__( 'Add Phone No.', 'chrisporate' ),
	'section'           => 'chrisporate_contact_section',
	'active_callback' 	=> 'chrisporate_is_contact_section_enable',
) ) );

// contact email repeater control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[contact_email]', array(
	'default' 			=> $options['contact_email'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Chrisporate_Multi_Input_Custom_Control( $wp_customize, 'chrisporate_theme_options[contact_email]', array(
	'label'             => esc_html__( 'Email Id', 'chrisporate' ),
	'button_text'       => esc_html__( 'Add Email Id', 'chrisporate' ),
	'section'           => 'chrisporate_contact_section',
	'active_callback' 	=> 'chrisporate_is_contact_section_enable',
) ) );


// Contact form setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[contact_form]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'chrisporate_theme_options[contact_form]', array(
	'label'           	=> esc_html__( 'Contact Form Shortcode', 'chrisporate' ),
	'description'       => sprintf( '%1$s <a href="' . esc_url( 'https://wordpress.org/plugins/contact-form-7/' ) .'" target="_blank"> %2$s </a> %3$s', esc_html__( 'Input shortcode from Contact Form 7 Plugin', 'chrisporate' ), esc_html__( 'Click Here', 'chrisporate' ), esc_html__( 'to download plugin.', 'chrisporate' ) ),
	'section'        	=> 'chrisporate_contact_section',
	'active_callback' 	=> 'chrisporate_is_contact_section_enable',
	'type'				=> 'text',
) );

