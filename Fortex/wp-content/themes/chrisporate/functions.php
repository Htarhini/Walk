<?php
/**
 * Theme Palace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

if ( ! function_exists( 'chrisporate_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function chrisporate_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme Palace, use a find and replace
		 * to change 'chrisporate' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'chrisporate' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Load Footer Widget Support.
		require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/footer-widgets.php' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 550, 382, true );
		add_image_size( 'chrisporate-medium', 353, 469, true );

		// Set the default content width.
		$GLOBALS['content_width'] = 525;
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'chrisporate' ),
			'social' => esc_html__( 'Social', 'chrisporate' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'chrisporate_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		//  Add theme support for excerpt for pages
		add_post_type_support( 'page', 'excerpt' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'assets/css/editor-style' . chrisporate_min() . '.css', chrisporate_fonts_url() ) );
	}
endif;
add_action( 'after_setup_theme', 'chrisporate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function chrisporate_content_width() {

	$content_width = $GLOBALS['content_width'];


	$sidebar_position = chrisporate_layout();
	switch ( $sidebar_position ) {

	  case 'no-sidebar':
	    $content_width = 1170;
	    break;

	  case 'left-sidebar':
	  case 'right-sidebar':
	    $content_width = 819;
	    break;

	  default:
	    break;
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1170;
	}

	/**
	 * Filter Chrisporate content width of the theme.
	 *
	 * @since Chrisporate 1.0.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'chrisporate_content_width', $content_width );
}
add_action( 'template_redirect', 'chrisporate_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function chrisporate_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'chrisporate' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'chrisporate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Optional Sidebar', 'chrisporate' ),
		'id'            => 'optional-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'chrisporate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
}
add_action( 'widgets_init', 'chrisporate_widgets_init' );


if ( ! function_exists( 'chrisporate_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function chrisporate_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	// Header Fonts
	
	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'chrisporate' ) ) {
		$fonts[] = 'Open Sans:300,400,600,700';
	}

	/* translators: If there are characters in your language that are not supported by Rajdhani, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Rajdhani font: on or off', 'chrisporate' ) ) {
		$fonts[] = 'Rajdhani:300,400,500,600,700';
	}

	/* translators: If there are characters in your language that are not supported by Yesteryear, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Yesteryear font: on or off', 'chrisporate' ) ) {
		$fonts[] = 'Yesteryear';
	}

	/* translators: If there are characters in your language that are not supported by Dynalight, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Dynalight font: on or off', 'chrisporate' ) ) {
		$fonts[] = 'Dynalight';
	}

	// Body Fonts

	/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'chrisporate' ) ) {
		$fonts[] = 'Playfair Display:400,700';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @since Chrisporate 1.0.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function chrisporate_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'chrisporate-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'chrisporate_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function chrisporate_scripts() {
	$options = chrisporate_get_theme_options();
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'chrisporate-fonts', chrisporate_fonts_url(), array(), null );

	// slick
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick' . chrisporate_min() . '.css' );

	// slick theme
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme' . chrisporate_min() . '.css' );

	// font awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome' . chrisporate_min() . '.css' );

	if ( 'xmas' == $options['colorscheme'] && true === $options['snow_fall'] ) :
		// let it snow
		wp_enqueue_style( 'let-it-snow', get_template_directory_uri() . '/assets/css/letitsnow' . chrisporate_min() . '.css' );
	endif;

	wp_enqueue_style( 'chrisporate-style', get_stylesheet_uri() );

	// Load the colorscheme.
	$color_scheme = $options['colorscheme'];
	if ( ! in_array( $color_scheme, array( 'default', 'custom' ) ) ) {
		wp_enqueue_style( 'chrisporate-colors', get_template_directory_uri() . '/assets/css/' . esc_attr( $color_scheme ) . chrisporate_min() .'.css', array( 'chrisporate-style' ), '1.0' );
	}

	// Load the html5 shiv.
	wp_enqueue_script( 'chrisporate-html5', get_template_directory_uri() . '/assets/js/html5' . chrisporate_min() . '.js', array(), '3.7.3' );
	wp_script_add_data( 'chrisporate-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'chrisporate-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . chrisporate_min() . '.js', array(), '20160412', true );

	wp_enqueue_script( 'chrisporate-navigation', get_template_directory_uri() . '/assets/js/navigation' . chrisporate_min() . '.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// jquery slick
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick' . chrisporate_min() . '.js', array( 'jquery' ), '', true );

	if ( 'xmas' == $options['colorscheme'] && true === $options['snow_fall'] ) :
		// modernizr
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr' . chrisporate_min() . '.js', array( 'jquery' ), '', true );

		// let it snow
		wp_enqueue_script( 'let-it-snow-js', get_template_directory_uri() . '/assets/js/letitsnow' . chrisporate_min() . '.js', array( 'jquery' ), '', true );
	endif;
	
	// Custom jquery
	wp_enqueue_script( 'chrisporate-custom', get_template_directory_uri() . '/assets/js/custom' . chrisporate_min() . '.js', array( 'jquery', 'wp-custom-header' ), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'chrisporate_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';