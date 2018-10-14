<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 * @return array An array of default values
 */

function chrisporate_get_default_theme_options() {
	$chrisporate_default_options = array(
		
		// Color Options
		'header_txt_logo_extra'			=> 'show-all',
		'colorscheme'					=> 'xmas',
		'snow_fall'						=> true,

		// layout 
		'site_layout'         			=> 'wide',
		'sidebar_position'         		=> 'right-sidebar',

		// excerpt options
		'long_excerpt_length'           => 25,
		'read_more_text'		        => esc_html__( 'Read More', 'chrisporate' ),
		
		// breadcrumb options
		'breadcrumb_enable'         	=> true,
		'breadcrumb_separator'         	=> '/',

		// pagination options
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',

		// footer options
		'footer_image_enable'			=> true,
		'footer_social_enable'			=> false,
		'footer_image'					=> get_template_directory_uri() . '/assets/uploads/footer-logo.png',
		'copyright_text'           		=> sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s.', '1: Year, 2: Site Title with home URL', 'chrisporate' ), '[the-year]', '[site-link]' ),
		'scroll_top_visible'        	=> true,

		// reset options
		'reset_options'      			=> false,
		
		// homepage options
		'enable_frontpage_content' 		=> false,

		// blog/archive options
		'your_latest_posts_title' 		=> esc_html__( 'Blogs', 'chrisporate' ),
		'show_date' 					=> true,
		'show_category' 				=> true,
		'show_author'					=> true,
		'show_readmore'					=> true,
		'no_featured_image'				=> false,

		// single post theme options
		'single_post_show_date' 		=> true,
		'single_post_show_author'		=> true,
		'single_post_show_category'		=> true,
		'single_post_show_tags'			=> true,
		'single_post_show_comment'		=> true,
		'single_post_show_pagination'	=> true,

		/* Front Page */

		// Banner
		'banner_section_title'			=> esc_html__( 'Simple Yet Beautiful', 'chrisporate' ),
		'banner_section_sub_title'		=> esc_html__( 'Interfaces', 'chrisporate' ),

		// About
		'about_section_enable'			=> false,
		'about_skills_enable'			=> false,
		'about_graph'					=> '[TP_PIEBUILDER_HORIZONTAL_BAR title="" values="90, 85, 95" labels="Design, Development, Production" colors="#000, #000, #000"]',

		// Services
		'service_section_enable'		=> false,
		'service_title'					=> esc_html__( 'Our Services', 'chrisporate' ),

		// Portfolio
		'portfolio_section_enable'		=> false,
		'portfolio_title'				=> esc_html__( 'Portfolio', 'chrisporate' ),

		// Author
		'author_section_enable'			=> false,

		// Latest Blog
		'latest_blog_section_enable'	=> false,
		'latest_blog_title'				=> esc_html__( 'Latest Blog', 'chrisporate' ),
		'latest_blog_content_type'		=> 'all',

		// Testimonial
		'testimonial_section_enable'	=> false,
		'testimonial_background_image'	=> get_template_directory_uri() . '/assets/uploads/testimonial.jpg',
		'testimonial_section_title'		=> esc_html__( 'What People Say?', 'chrisporate' ),

		// Contact
		'contact_section_enable'		=> false,
		'contact_address'				=> esc_html__( 'Jawalakhel, Lalitpur', 'chrisporate' ),
		'contact_phone'					=> esc_html__( '+00 0 0000000', 'chrisporate' ),
		'contact_email'					=> esc_html__( 'abc@email.com', 'chrisporate' ),
		'contact_title'					=> esc_html__( 'Find Us', 'chrisporate' ),

	);

	$output = apply_filters( 'chrisporate_default_theme_options', $chrisporate_default_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}