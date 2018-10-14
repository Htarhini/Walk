<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */
function chrisporate_page_choices() {
    $pages = get_pages();
    $choices = array();
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

if ( ! function_exists( 'chrisporate_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function chrisporate_site_layout() {
        $chrisporate_site_layout = array(
            'wide'  => get_template_directory_uri() . '/assets/images/full.png',
            'boxed' => get_template_directory_uri() . '/assets/images/boxed.png',
        );

        $output = apply_filters( 'chrisporate_site_layout', $chrisporate_site_layout );
        return $output;
    }
endif;


if ( ! function_exists( 'chrisporate_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function chrisporate_sidebar_position() {
        $chrisporate_sidebar_position = array(
            'right-sidebar'         => get_template_directory_uri() . '/assets/images/right.png',
            'no-sidebar'            => get_template_directory_uri() . '/assets/images/full.png',
        );

        $output = apply_filters( 'chrisporate_sidebar_position', $chrisporate_sidebar_position );

        return $output;
    }
endif;

if ( ! function_exists( 'chrisporate_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function chrisporate_selected_sidebar() {
        $chrisporate_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'chrisporate' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar 1', 'chrisporate' ),
        );

        $output = apply_filters( 'chrisporate_selected_sidebar', $chrisporate_selected_sidebar );

        return $output;
    }
endif;

if ( ! function_exists( 'chrisporate_header_image' ) ) :
    /**
     * Header image options
     * @return array header images
     */
    function chrisporate_header_image() {
        $chrisporate_header_image = array(
            'show-both'         => esc_html__( 'Show Both', 'chrisporate' ),
            'header-image'      => esc_html__( 'Customizer Header Image', 'chrisporate' ),
            'featured-image'    => esc_html__( 'Featured Image', 'chrisporate' ),
        );

        $output = apply_filters( 'chrisporate_header_image', $chrisporate_header_image );

        return $output;
    }
endif;


if ( ! function_exists( 'chrisporate_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function chrisporate_pagination_options() {
        $chrisporate_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'chrisporate' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'chrisporate' ),
        );

        $output = apply_filters( 'chrisporate_pagination_options', $chrisporate_pagination_options );

        return $output;
    }
endif;


if ( ! function_exists( 'chrisporate_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function chrisporate_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'chrisporate' ),
            'off'       => esc_html__( 'Disable', 'chrisporate' )
        );
        return apply_filters( 'chrisporate_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'chrisporate_sortable_sections' ) ) :
    /**
     * List of sections Control options
     * @return array List of Sections control options.
     */
    function chrisporate_sortable_sections() {
        $sections = array(
            'about'         => esc_html__( 'About', 'chrisporate' ),
            'service'       => esc_html__( 'Services', 'chrisporate' ),
            'portfolio'     => esc_html__( 'Portfolio', 'chrisporate' ),
            'author'        => esc_html__( 'Author', 'chrisporate' ),
            'latest_blog'   => esc_html__( 'Latest Blog', 'chrisporate' ),
            'testimonial'   => esc_html__( 'Testimonial', 'chrisporate' ),
        );
        return apply_filters( 'chrisporate_sortable_sections', $sections );
    }
endif;