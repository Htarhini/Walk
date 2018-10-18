<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses chrisporate_header_style()
 */
function chrisporate_custom_header_setup() {
	$options = chrisporate_get_theme_options();
	$banner = ( 'xmas' == $options['colorscheme'] ) ? 'banner-02' : 'banner-01';

	add_theme_support( 'custom-header', apply_filters( 'chrisporate_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/assets/uploads/' . $banner . '.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'video'              	 => true,
		'wp-head-callback'       => 'chrisporate_header_style',
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/uploads/' . $banner . '.jpg',
			'thumbnail_url' => '%s/assets/uploads/' . $banner . '.jpg',
			'description'   => esc_html__( 'Default Header Image', 'chrisporate' ),
		),
	) );
}
add_action( 'after_setup_theme', 'chrisporate_custom_header_setup' );

if ( ! function_exists( 'chrisporate_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see chrisporate_custom_header_setup().
	 */
	function chrisporate_header_style() {
		$options = chrisporate_get_theme_options();
		$header_text_color = get_header_textcolor();
		$css = '';

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
			// Has the text been hidden?
		if ( ! display_header_text() ) :
			$css .= ".site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}";
		// If the user has set a custom color for the text use that.
		else :
			$css .= ".site-title a,
			.site-description {
				color: #" . esc_attr( $header_text_color ) . "}";
		endif; 
		

		$css .= '.trail-items li:not(:last-child):after {
			    content: "' . $options['breadcrumb_separator'] . '";
			}';

		$pagination_type = isset( $options['pagination_type'] ) ? $options['pagination_type'] : 'default';
		if ( $pagination_type == 'infinite' ) {
			$css .= '
			.site-main nav.pagination.navigation {
				display:none;
			}';
		}

		wp_add_inline_style( 'chrisporate-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'chrisporate_header_style', 10 );