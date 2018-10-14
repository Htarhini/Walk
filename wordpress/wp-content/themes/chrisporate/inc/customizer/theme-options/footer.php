<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'chrisporate_section_footer',
	array(
		'title'      		=> esc_html__( 'Footer Options', 'chrisporate' ),
		'priority'   		=> 900,
		'panel'      		=> 'chrisporate_theme_options_panel',
	)
);

// Footer image visible
$wp_customize->add_setting( 'chrisporate_theme_options[footer_image_enable]',
	array(
		'default'       	=> $options['footer_image_enable'],
		'sanitize_callback' => 'chrisporate_sanitize_switch_control',
	)
);
$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[footer_image_enable]',
    array(
		'label'      		=> esc_html__( 'Display Footer Image', 'chrisporate' ),
		'section'    		=> 'chrisporate_section_footer',
		'on_off_label' 		=> chrisporate_switch_options(),
    )
) );

// Footer additional image setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[footer_image]', array(
	'default' 				=> $options['footer_image'],
	'sanitize_callback' 	=> 'chrisporate_sanitize_image',
) );

$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'chrisporate_theme_options[footer_image]',
		array(
		'label'       		=> esc_html__( 'Select Image', 'chrisporate' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'chrisporate' ), 50, 50 ),
		'section'     		=> 'chrisporate_section_footer',
		'active_callback'   => 'chrisporate_is_footer_image_enable',
) ) );

// footer social menu visible
$wp_customize->add_setting( 'chrisporate_theme_options[footer_social_enable]',
	array(
		'default'       	=> $options['footer_social_enable'],
		'sanitize_callback' => 'chrisporate_sanitize_switch_control',
	)
);
$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[footer_social_enable]',
    array(
		'label'      		=> esc_html__( 'Display Social Menu', 'chrisporate' ),
		'description'       => sprintf( '%1$s <a href="' . admin_url( '/customize.php?autofocus[panel]=nav_menus' ) . '"> %2$s </a> %3$s', esc_html__( 'Note: Create social menu to show social links.', 'chrisporate' ), esc_html__( 'Click Here', 'chrisporate' ), esc_html__( 'to create menu', 'chrisporate' ) ),
		'section'    		=> 'chrisporate_section_footer',
		'on_off_label' 		=> chrisporate_switch_options(),
    )
) );

// footer text
$wp_customize->add_setting( 'chrisporate_theme_options[copyright_text]',
	array(
		'default'       	=> $options['copyright_text'],
		'sanitize_callback'	=> 'chrisporate_santize_allow_tag',
	)
);
$wp_customize->add_control( 'chrisporate_theme_options[copyright_text]',
    array(
		'label'      		=> esc_html__( 'Copyright Text', 'chrisporate' ),
		'section'    		=> 'chrisporate_section_footer',
		'type'		 		=> 'textarea',
    )
);

// scroll top visible
$wp_customize->add_setting( 'chrisporate_theme_options[scroll_top_visible]',
	array(
		'default'       	=> $options['scroll_top_visible'],
		'sanitize_callback' => 'chrisporate_sanitize_switch_control',
	)
);
$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[scroll_top_visible]',
    array(
		'label'      		=> esc_html__( 'Display Scroll Top Button', 'chrisporate' ),
		'section'    		=> 'chrisporate_section_footer',
		'on_off_label' 		=> chrisporate_switch_options(),
    )
) );