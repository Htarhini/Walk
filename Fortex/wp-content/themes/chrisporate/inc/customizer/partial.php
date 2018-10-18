<?php
/**
* Customizer Partial functions
*
* @package Theme Palace
* @subpackage Chrisporate
* @since Chrisporate 1.0.0
*/

if ( ! function_exists( 'chrisporate_banner_section_title_partial' ) ) :
    // banner title
    function chrisporate_banner_section_title_partial() {
        $options = chrisporate_get_theme_options();
        return esc_html( $options['banner_section_title'] );
    }
endif;

if ( ! function_exists( 'chrisporate_banner_section_sub_title_partial' ) ) :
    // banner sub title
    function chrisporate_banner_section_sub_title_partial() {
        $options = chrisporate_get_theme_options();
        return esc_html( $options['banner_section_sub_title'] );
    }
endif;

if ( ! function_exists( 'chrisporate_service_title_partial' ) ) :
    // service title
    function chrisporate_service_title_partial() {
        $options = chrisporate_get_theme_options();
        return esc_html( $options['service_title'] );
    }
endif;

if ( ! function_exists( 'chrisporate_portfolio_title_partial' ) ) :
    // portfolio title
    function chrisporate_portfolio_title_partial() {
        $options = chrisporate_get_theme_options();
        return esc_html( $options['portfolio_title'] );
    }
endif;

if ( ! function_exists( 'chrisporate_latest_blog_title_partial' ) ) :
    // latest_blog title
    function chrisporate_latest_blog_title_partial() {
        $options = chrisporate_get_theme_options();
        return esc_html( $options['latest_blog_title'] );
    }
endif;

if ( ! function_exists( 'chrisporate_contact_title_partial' ) ) :
    // contact title
    function chrisporate_contact_title_partial() {
        $options = chrisporate_get_theme_options();
        return esc_html( $options['contact_title'] );
    }
endif;

if ( ! function_exists( 'chrisporate_contact_address_partial' ) ) :
    // contact address
    function chrisporate_contact_address_partial() {
        $options = chrisporate_get_theme_options();
        return esc_html( $options['contact_address'] );
    }
endif;

