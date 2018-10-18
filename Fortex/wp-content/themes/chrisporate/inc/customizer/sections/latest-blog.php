<?php
/**
 * Latest Blog Section options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

// Add Latest Blog section
$wp_customize->add_section( 'chrisporate_latest_blog_section', array(
	'title'             => esc_html__( 'Latest Blog Section','chrisporate' ),
	'description'       => esc_html__( 'Latest Blog Section options.', 'chrisporate' ),
	'panel'             => 'chrisporate_front_page_panel',
) );

// Latest Blog content enable control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[latest_blog_section_enable]', array(
	'default'			=> 	$options['latest_blog_section_enable'],
	'sanitize_callback' => 'chrisporate_sanitize_switch_control',
) );

$wp_customize->add_control( new Chrisporate_Switch_Control( $wp_customize, 'chrisporate_theme_options[latest_blog_section_enable]', array(
	'label'             => esc_html__( 'Latest Blog Section Enable', 'chrisporate' ),
	'section'           => 'chrisporate_latest_blog_section',
	'on_off_label' 		=> chrisporate_switch_options(),
) ) );

// Latest Blog title setting and control
$wp_customize->add_setting( 'chrisporate_theme_options[latest_blog_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> $options['latest_blog_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'chrisporate_theme_options[latest_blog_title]', array(
	'label'           	=> esc_html__( 'Title', 'chrisporate' ),
	'section'        	=> 'chrisporate_latest_blog_section',
	'active_callback' 	=> 'chrisporate_is_latest_blog_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'chrisporate_theme_options[latest_blog_title]', array(
		'selector'            => '#latest-blog .container .latest-content-title .entry-header h2.entry-title',
		'settings'            => 'chrisporate_theme_options[latest_blog_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'chrisporate_latest_blog_title_partial',
    ) );
}

// Latest Blog content type control and setting
$wp_customize->add_setting( 'chrisporate_theme_options[latest_blog_content_type]', array(
	'default'          	=> $options['latest_blog_content_type'],
	'sanitize_callback' => 'chrisporate_sanitize_select',
) );

$wp_customize->add_control( 'chrisporate_theme_options[latest_blog_content_type]', array(
	'label'             => esc_html__( 'Content Type', 'chrisporate' ),
	'section'           => 'chrisporate_latest_blog_section',
	'type'				=> 'select',
	'active_callback' 	=> 'chrisporate_is_latest_blog_section_enable',
	'choices'			=> array( 
		'all' 		=> esc_html__( 'All Posts', 'chrisporate' ),
		'category' 	=> esc_html__( 'Category', 'chrisporate' ),
	),
) );

// Add dropdown category setting and control.
$wp_customize->add_setting(  'chrisporate_theme_options[latest_blog_content_category]', array(
	'sanitize_callback' => 'chrisporate_sanitize_single_category',
) ) ;

$wp_customize->add_control( new Chrisporate_Dropdown_Taxonomies_Control( $wp_customize,'chrisporate_theme_options[latest_blog_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'chrisporate' ),
	'description'      	=> esc_html__( 'Note: Latest three posts will be shown from selected category', 'chrisporate' ),
	'section'           => 'chrisporate_latest_blog_section',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'chrisporate_is_latest_blog_section_content_category_enable'
) ) );

// Add dropdown category setting and control.
$wp_customize->add_setting(  'chrisporate_theme_options[latest_blog_exclude_category]', array(
	'sanitize_callback' => 'chrisporate_sanitize_category_list',
) ) ;

$wp_customize->add_control( new Chrisporate_Dropdown_Category_Control( $wp_customize,'chrisporate_theme_options[latest_blog_exclude_category]', array(
	'label'             => esc_html__( 'Exclude Categories', 'chrisporate' ),
	'description'      	=> esc_html__( 'Note: Press SHIFT key and select multiple categories. Posts from selected categories will be excluded.', 'chrisporate' ),
	'section'           => 'chrisporate_latest_blog_section',
	'type'              => 'dropdown-categories',
	'active_callback'	=> 'chrisporate_is_latest_blog_section_content_all_enable'
) ) );

