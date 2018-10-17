<?php
/**
 * neptune functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Neptune WP
 */

if ( ! function_exists( 'neptune_wp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function neptune_wp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on neptune, use a find and replace
		 * to change 'neptune-wp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'neptune-wp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_post_type_support( 'page', 'excerpt' );
		/*	
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size(	'neptune-large', 1000, 400, true );
		add_image_size( 'neptune-thumb', 600, 500, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Primary', 'neptune-wp' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'neptune_wp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'neptune_wp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function neptune_wp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'neptune_wp_content_width', 640 );
}
add_action( 'after_setup_theme', 'neptune_wp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function neptune_wp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'neptune-wp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'neptune-wp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'neptune-wp' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'neptune-wp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'neptune-wp' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'neptune-wp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'neptune-wp' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'neptune-wp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'neptune-wp' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'neptune-wp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'neptune_wp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function neptune_wp_scripts() {
	wp_enqueue_style( 'neptune-style', get_stylesheet_uri() );

	wp_enqueue_style( 'neptune-grid', get_template_directory_uri() . '/css/grid.css');

	add_editor_style('netputune-editor', get_template_directory_uri() . '/css/editor.css');

	wp_enqueue_script( 'neptune-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'neptune-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'neptune_wp_scripts' );

/**
 * Implement the Custom Menu Walker.
 */
require get_template_directory() . '/inc/menu-walker.php';

//require get_template_directory() . '/inc/neptune-hooks.php';

require get_template_directory() . '/inc/neptune-strings.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */

require_once( trailingslashit( get_template_directory() ) . '/inc/upsell/class-customize.php' );

require get_template_directory() . '/inc/customizer.php';

/**
 * TGM activation
 */
require get_template_directory() . '/inc/libraries/TGM/class-tgm-plugin-activation.php';

/**
 * TGM add plugins
 */
require get_template_directory() . '/inc/tgm-include-plugins.php';
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Metabox
 */
//require get_template_directory() . '/inc/metaboxes.php';
/**
 * logo
 */
function neptune_wp_logo() {
	do_action( 'neptune_wp_logo' );
}

/**
 * Main Menu
 */
function neptune_wp_main_menu() {
	do_action( 'neptune_wp_main_menu' );
}	

/**
 * Header Left
 */
function neptune_wp_header_left() {
	do_action( 'neptune_wp_header_left' );
}

/**
 * Neptune Comments
 */
function neptune_wp_comments_before() {
	do_action( 'neptune_wp_comments_before' );
}
function neptune_wp_comments_after() {
	do_action( 'neptune_wp_comments_after' );
}
/**
 * Custom CSS
 */
//require get_template_directory() . '/css/customcss.php';


if ( class_exists( 'Kirki' ) ) {

	Kirki::add_config( 'neptune', array(
        'option_name'   => 'theme_options', 
        'capability'    => 'edit_theme_options'
    ) );
}
