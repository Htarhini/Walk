<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

if ( ! function_exists( 'chrisporate_is_loader_enable' ) ) :
	/**
	 * Check if loader is enabled.
	 *
	 * @since Chrisporate 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function chrisporate_is_loader_enable( $control ) {
		return $control->manager->get_setting( 'chrisporate_theme_options[loader_enable]' )->value();
	}
endif;

if ( ! function_exists( 'chrisporate_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since Chrisporate 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function chrisporate_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'chrisporate_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'chrisporate_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Chrisporate 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function chrisporate_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'chrisporate_theme_options[pagination_enable]' )->value();
	}
endif;

/**
 * Check if side menu section is enabled.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_side_menu_enable( $control ) {
	return $control->manager->get_setting( 'chrisporate_theme_options[side_menu]' )->value();
}


/**
 * Front Page Active Callbacks
 */

/**
 * Check if about section is enabled.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_about_section_enable( $control ) {
	return $control->manager->get_setting( 'chrisporate_theme_options[about_section_enable]' )->value();
}

/**
 * Check if about section skills is enabled.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_about_section_skills_enable( $control ) {
	return chrisporate_is_about_section_enable( $control ) && $control->manager->get_setting( 'chrisporate_theme_options[about_skills_enable]' )->value();
}

/**
 * Check if service section is enabled.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_service_section_enable( $control ) {
	return $control->manager->get_setting( 'chrisporate_theme_options[service_section_enable]' )->value();
}

/**
 * Check if portfolio section is enabled.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_portfolio_section_enable( $control ) {
	return $control->manager->get_setting( 'chrisporate_theme_options[portfolio_section_enable]' )->value();
}

/**
 * Check if author section is enabled.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_author_section_enable( $control ) {
	return $control->manager->get_setting( 'chrisporate_theme_options[author_section_enable]' )->value();
}

/**
 * Check if latest blog section is enabled.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_latest_blog_section_enable( $control ) {
	return $control->manager->get_setting( 'chrisporate_theme_options[latest_blog_section_enable]' )->value();
}

/**
 * Check if latest blog section content type is category.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_latest_blog_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'chrisporate_theme_options[latest_blog_content_type]' )->value();
	return chrisporate_is_latest_blog_section_enable( $control ) && ( 'category' === $content_type );
}

/**
 * Check if latest blog section content type is all posts.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_latest_blog_section_content_all_enable( $control ) {
	$content_type = $control->manager->get_setting( 'chrisporate_theme_options[latest_blog_content_type]' )->value();
	return chrisporate_is_latest_blog_section_enable( $control ) && ( 'all' === $content_type );
}

/**
 * Check if testimonial section is enabled.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_testimonial_section_enable( $control ) {
	return $control->manager->get_setting( 'chrisporate_theme_options[testimonial_section_enable]' )->value();
}

/**
 * Check if contact section is enabled.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_contact_section_enable( $control ) {
	return $control->manager->get_setting( 'chrisporate_theme_options[contact_section_enable]' )->value();
}

/**
 * Check if footer image is enabled.
 *
 * @since Chrisporate 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function chrisporate_is_footer_image_enable( $control ) {
	return $control->manager->get_setting( 'chrisporate_theme_options[footer_image_enable]' )->value();
}
