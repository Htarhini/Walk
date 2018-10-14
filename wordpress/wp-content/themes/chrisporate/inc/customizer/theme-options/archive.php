<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'chrisporate_archive_section', array(
	'title'             => esc_html__( 'Blog/Archive','chrisporate' ),
	'description'       => esc_html__( 'Archive section options.', 'chrisporate' ),
	'panel'             => 'chrisporate_theme_options_panel',
) );

// Your latest posts title setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[your_latest_posts_title]', array(
	'default'           => $options['your_latest_posts_title'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'chrisporate_theme_options[your_latest_posts_title]', array(
	'label'             => esc_html__( 'Your Latest Posts Title', 'chrisporate' ),
	'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'chrisporate' ),
	'section'           => 'chrisporate_archive_section',
	'type'				=> 'text',
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[show_date]', array(
	'default'           => $options['show_date'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[show_date]', array(
	'label'             => esc_html__( 'Show Date', 'chrisporate' ),
	'section'           => 'chrisporate_archive_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[show_category]', array(
	'default'           => $options['show_category'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[show_category]', array(
	'label'             => esc_html__( 'Show Category', 'chrisporate' ),
	'section'           => 'chrisporate_archive_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[show_author]', array(
	'default'           => $options['show_author'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[show_author]', array(
	'label'             => esc_html__( 'Show Author', 'chrisporate' ),
	'section'           => 'chrisporate_archive_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Archive tag category setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[show_readmore]', array(
	'default'           => $options['show_readmore'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[show_readmore]', array(
	'label'             => esc_html__( 'Show Read More Button', 'chrisporate' ),
	'section'           => 'chrisporate_archive_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Archive no featured image setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[no_featured_image]', array(
	'default'           => $options['no_featured_image'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[no_featured_image]', array(
	'label'             => esc_html__( 'Show Placeholder Image', 'chrisporate' ),
	'description'       => esc_html__( 'Show placeholder image if the post does not have featured image.', 'chrisporate' ),
	'section'           => 'chrisporate_archive_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );