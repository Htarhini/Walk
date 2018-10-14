<?php
/**
 * Chrisporate Customizer.
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

//load upgrade-to-pro section
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function chrisporate_customize_register( $wp_customize ) {
	$options = chrisporate_get_theme_options();

	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callback.php';

	// Load partial callback functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	// Load validation callback functions.
	require get_template_directory() . '/inc/customizer/validation.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	// Site identity extra options.
	$wp_customize->add_setting( 'chrisporate_theme_options[header_txt_logo_extra]', array(
		'default'           => $options['header_txt_logo_extra'],
		'sanitize_callback' => 'chrisporate_sanitize_select',
		'transport'			=> 'refresh'
	) );

	$wp_customize->add_control( 'chrisporate_theme_options[header_txt_logo_extra]', array(
		'priority'			=> 50,
		'type'				=> 'radio',
		'label'             => esc_html__( 'Site Identity Extra Options', 'chrisporate' ),
		'section'           => 'title_tagline',
		'choices'				=> array( 
			'hide-all'     => esc_html__( 'Hide All', 'chrisporate' ),
			'show-all'     => esc_html__( 'Show All', 'chrisporate' ),
			'title-only'   => esc_html__( 'Title Only', 'chrisporate' ),
			'tagline-only' => esc_html__( 'Tagline Only', 'chrisporate' ),
			'logo-title'   => esc_html__( 'Logo + Title', 'chrisporate' ),
			'logo-tagline' => esc_html__( 'Logo + Tagline', 'chrisporate' ),
			)
	) );

	/**
	 * Custom colors.
	 */
	$wp_customize->add_setting( 'chrisporate_theme_options[colorscheme]', array(
		'default'           => $options['colorscheme'],
		'sanitize_callback' => 'chrisporate_sanitize_select',
	) );

	$wp_customize->add_control( 'chrisporate_theme_options[colorscheme]', array(
		'type'    	=> 'radio',
		'label'    	=> esc_html__( 'Color Scheme', 'chrisporate' ),
		'choices'  	=> array(
			'xmas'   	=> esc_html__( 'X-mas', 'chrisporate' ),
			'default'  	=> esc_html__( 'Corporate', 'chrisporate' ),
		),
		'section'  => 'colors',
	) );

	// Add panel for common theme options
	$wp_customize->add_panel( 'chrisporate_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','chrisporate' ),
	    'description'=> esc_html__( 'Chrisporate Theme Options.', 'chrisporate' ),
	    'priority'   => 150,
	) );

	// load snow
	require get_template_directory() . '/inc/customizer/theme-options/snow.php';

	// load layout
	require get_template_directory() . '/inc/customizer/theme-options/layout.php';

	// load static homepage option
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	// load archive option
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// load archive option
	require get_template_directory() . '/inc/customizer/theme-options/archive.php';
	
	// load single post option
	require get_template_directory() . '/inc/customizer/theme-options/single-posts.php';

	// load pagination option
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// load footer option
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// load reset option
	require get_template_directory() . '/inc/customizer/theme-options/reset.php';

	// Add panel for front page theme options.
	$wp_customize->add_panel( 'chrisporate_front_page_panel' , array(
	    'title'      => esc_html__( 'Home Page','chrisporate' ),
	    'description'=> esc_html__( 'Home Page Theme Options.', 'chrisporate' ),
	    'priority'   => 140,
	) );

	// load banner option
	require get_template_directory() . '/inc/customizer/sections/banner.php';

	// load about option
	require get_template_directory() . '/inc/customizer/sections/about.php';

	// load services option
	require get_template_directory() . '/inc/customizer/sections/services.php';

	// load portfolio option
	require get_template_directory() . '/inc/customizer/sections/portfolio.php';

	// load author option
	require get_template_directory() . '/inc/customizer/sections/author.php';

	// load latest blog option
	require get_template_directory() . '/inc/customizer/sections/latest-blog.php';

	// load testimonial option
	require get_template_directory() . '/inc/customizer/sections/testimonial.php';

	// load contact option
	require get_template_directory() . '/inc/customizer/sections/contact.php';

}
add_action( 'customize_register', 'chrisporate_customize_register' );

/*
 * Load customizer sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function chrisporate_customize_preview_js() {
	wp_enqueue_script( 'chrisporate-customizer-preview', get_template_directory_uri() . '/assets/js/customizer' . chrisporate_min() . '.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'chrisporate_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function chrisporate_customize_control_js() {

	wp_enqueue_style( 'chrisporate-customize-controls-css', get_template_directory_uri() . '/assets/css/customize-controls' . chrisporate_min() . '.css' );

	wp_enqueue_script( 'chrisporate-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls' . chrisporate_min() . '.js', array( 'jquery', 'customize-controls', 'iris', 'underscore', 'wp-util' ), '', true );
	$chrisporate_reset_data = array(
		'reset_message' => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'chrisporate' )
	);
	// Send list of color variables as object to custom customizer js
	wp_localize_script( 'chrisporate-customize-controls', 'chrisporate_reset_data', $chrisporate_reset_data );

}
add_action( 'customize_controls_enqueue_scripts', 'chrisporate_customize_control_js' );

if ( !function_exists( 'chrisporate_reset_options' ) ) :
	/**
	 * Reset all options
	 *
	 * @since Chrisporate 1.0.0
	 *
	 * @param bool $checked Whether the reset is checked.
	 * @return bool Whether the reset is checked.
	 */
	function chrisporate_reset_options() {
		$options = chrisporate_get_theme_options();
		if ( true === $options['reset_options'] ) {
			// Reset custom theme options.
			set_theme_mod( 'chrisporate_theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_video' );
			remove_theme_mod( 'external_header_video' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
			remove_theme_mod( 'header_textcolor' );
	    }
	  	else {
		    return false;
	  	}
	}
endif;
add_action( 'customize_save_after', 'chrisporate_reset_options' );
