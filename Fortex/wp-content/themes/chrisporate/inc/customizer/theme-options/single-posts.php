<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'chrisporate_single_post_section', array(
	'title'             => esc_html__( 'Single Post','chrisporate' ),
	'description'       => esc_html__( 'Options to change the single posts globally.', 'chrisporate' ),
	'panel'             => 'chrisporate_theme_options_panel',
) );

// Single date meta setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[single_post_show_date]', array(
	'default'           => $options['single_post_show_date'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[single_post_show_date]', array(
	'label'             => esc_html__( 'Show Date', 'chrisporate' ),
	'section'           => 'chrisporate_single_post_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Single author meta setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[single_post_show_author]', array(
	'default'           => $options['single_post_show_author'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[single_post_show_author]', array(
	'label'             => esc_html__( 'Show Author', 'chrisporate' ),
	'section'           => 'chrisporate_single_post_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Single author category setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[single_post_show_category]', array(
	'default'           => $options['single_post_show_category'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[single_post_show_category]', array(
	'label'             => esc_html__( 'Show Category', 'chrisporate' ),
	'section'           => 'chrisporate_single_post_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Single tag category setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[single_post_show_tags]', array(
	'default'           => $options['single_post_show_tags'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[single_post_show_tags]', array(
	'label'             => esc_html__( 'Show Tags', 'chrisporate' ),
	'section'           => 'chrisporate_single_post_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Single comment setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[single_post_show_comment]', array(
	'default'           => $options['single_post_show_comment'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[single_post_show_comment]', array(
	'label'             => esc_html__( 'Show Comment Meta', 'chrisporate' ),
	'section'           => 'chrisporate_single_post_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Single pagination setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[single_post_show_pagination]', array(
	'default'           => $options['single_post_show_pagination'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[single_post_show_pagination]', array(
	'label'             => esc_html__( 'Show Pagination', 'chrisporate' ),
	'section'           => 'chrisporate_single_post_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );
