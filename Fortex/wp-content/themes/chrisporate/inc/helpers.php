<?php
/**
 * Theme Palace custom helper funtions
 *
 * This is the template that includes all the other files for core featured of Photo Fusion Pro
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

if( ! function_exists( 'chrisporate_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since Chrisporate 1.0.0
	 */
  	function chrisporate_check_enable_status( $input, $content_enable ){
		$options = chrisporate_get_theme_options();

		// Content status.
		$content_status = $options[ $content_enable ];

		if ( ( ! is_home() && is_front_page() ) && $content_status ) {
			$input = true;
		}
		else {
			$input = false;
		}
		
		return $input;
  	}
endif;
add_filter( 'chrisporate_section_status', 'chrisporate_check_enable_status', 10, 2 );


if ( ! function_exists( 'chrisporate_is_sidebar_enable' ) ) :
	/**
	 * Check if sidebar is enabled in meta box first then in customizer
	 *
	 * @since Chrisporate 1.0.0
	 */
	function chrisporate_is_sidebar_enable() {
		$options               = chrisporate_get_theme_options();
		$sidebar_position      = $options['sidebar_position'];

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
			if ( ! empty( $post_id ) )
				$post_sidebar_position = get_post_meta( $post_id, 'chrisporate-sidebar-position', true );
			else
				$post_sidebar_position = '';
		} elseif ( is_archive() || is_search() ) {
			$post_sidebar_position = '';
		} else {
			$post_id = get_the_id();
			$post_sidebar_position = get_post_meta( $post_id, 'chrisporate-sidebar-position', true );
		}
		if ( ( in_array( $sidebar_position, array( 'no-sidebar', 'no-sidebar-content' ) ) && $post_sidebar_position == "" ) || in_array( $post_sidebar_position, array( 'no-sidebar', 'no-sidebar-content' ) ) ) {
			return false;
		} else {
			return true;
		}

	}
endif;

if ( ! function_exists( 'chrisporate_single_header_image' ) ) :
	/**
	 * Check the post/page header image option
	 *
	 */
	function chrisporate_single_header_image() {
		$header_image = get_post_meta( get_the_id(), 'chrisporate-header-image', true );
		$header_image = ! empty( $header_image ) ? $header_image : 'show-both';
		return $header_image;
	}

endif;


if ( ! function_exists( 'chrisporate_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function chrisporate_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = chrisporate_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;

add_filter( 'chrisporate_filter_frontpage_content_enable', 'chrisporate_is_frontpage_content_enable' );

add_action( 'chrisporate_action_pagination', 'chrisporate_pagination', 10 );
if ( ! function_exists( 'chrisporate_pagination' ) ) :

	/**
	 * pagination.
	 *
	 * @since Chrisporate 1.0.0
	 */
	function chrisporate_pagination() {
		$options = chrisporate_get_theme_options();
		if ( true == $options['pagination_enable'] ) {
			$pagination = $options['pagination_type'];
			if ( $pagination == 'default' ) :
				the_posts_navigation();
			elseif ( in_array( $pagination, array( 'infinite', 'numeric' ) ) ) :
				the_posts_pagination( array(
				    'mid_size' => 4,
				    'prev_text' => esc_html__( 'Previous', 'chrisporate' ),
				    'next_text' => esc_html__( 'Next', 'chrisporate' ),
				) );
			endif;
		}
	}

endif;


add_action( 'chrisporate_action_post_pagination', 'chrisporate_post_pagination', 10 );
if ( ! function_exists( 'chrisporate_post_pagination' ) ) :

	/**
	 * post pagination.
	 *
	 * @since Chrisporate 1.0.0
	 */
	function chrisporate_post_pagination() {
		$options = chrisporate_get_theme_options();
		if ( true === $options['single_post_show_pagination'] ) {
			the_post_navigation();
		} 
	}
endif;


if ( ! function_exists( 'chrisporate_excerpt_length' ) ) :
	/**
	 * long excerpt
	 * 
	 * @since Chrisporate 1.0.0
	 * @return long excerpt value
	 */
	function chrisporate_excerpt_length( $length ){
		if ( is_admin() ) {
			return $length;
		}

		$options = chrisporate_get_theme_options();
		$length = $options['long_excerpt_length'];
		return $length;
	}
endif;
add_filter( 'excerpt_length', 'chrisporate_excerpt_length', 999 );


if ( ! function_exists( 'chrisporate_excerpt_more' ) ) :
	// Read more
	function chrisporate_excerpt_more( $more ){
		if ( is_admin() ) {
			return $more;
		}

		return '&hellip;';
	}
endif;
add_filter( 'excerpt_more', 'chrisporate_excerpt_more' );


if ( ! function_exists( 'chrisporate_trim_content' ) ) :
	/**
	 * custom excerpt function
	 * 
	 * @since Chrisporate 1.0.0
	 * @return  no of words to display
	 */
	function chrisporate_trim_content( $length = 40, $post_obj = null ) {
		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );
		if ( $length < 1 ) {
			$length = 40;
		}

		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}

		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );

	   return apply_filters( 'chrisporate_trim_content', $trimmed_content );
	}
endif;


if ( ! function_exists( 'chrisporate_layout' ) ) :
	/**
	 * Check home page layout option
	 *
	 * @since Chrisporate 1.0.0
	 *
	 * @return string Chrisporate layout value
	 */
	function chrisporate_layout() {
		$options = chrisporate_get_theme_options();

		$sidebar_position = $options['sidebar_position'];
		$sidebar_position = apply_filters( 'chrisporate_sidebar_position', $sidebar_position );
		// Check if single and static blog page
		if ( is_singular() || is_home() ) {
			if ( is_home() ) {
				$post_sidebar_position = get_post_meta( get_option( 'page_for_posts' ), 'chrisporate-sidebar-position', true );
			} else {
				$post_sidebar_position = get_post_meta( get_the_ID(), 'chrisporate-sidebar-position', true );
			}
			if ( isset( $post_sidebar_position ) && ! empty( $post_sidebar_position ) ) {
				$sidebar_position = $post_sidebar_position;
			}
		}
		return $sidebar_position;
	}
endif;

/**
 * Fallback function call for menu
 * @param  Mixed $args Menu arguments
 * @return String $output Return or echo the add menu link.       
 */
function chrisporate_menu_fallback_cb( $args ){
    if ( ! current_user_can( 'edit_theme_options' ) ){
	    return;
   	}
    // see wp-includes/nav-menu-template.php for available arguments
    $link = $args['link_before']
        	. '<a href="' .esc_url( admin_url( 'nav-menus.php' ) ) . '">' . $args['before'] . esc_html__( 'Add a menu','chrisporate' ) . $args['after'] . '</a>'
        	. $args['link_after'];

   	if ( FALSE !== stripos( $args['items_wrap'], '<ul' ) || FALSE !== stripos( $args['items_wrap'], '<ol' )
	){
		$link = "<li>$link</li>";
	}
	$output = sprintf( $args['items_wrap'], $args['menu_id'], $args['menu_class'], $link );
	if ( ! empty ( $args['container'] ) ){
		$output = sprintf( '<%1$s class="%2$s" id="%3$s">%4$s</%1$s>', $args['container'], $args['container_class'], $args['container_id'], $output );
	}
	if ( $args['echo'] ){
		echo $output;
	}
	return $output;
}
