<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

$options = chrisporate_get_theme_options();


if ( ! function_exists( 'chrisporate_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Chrisporate 1.0.0
	 */
	function chrisporate_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'chrisporate_doctype', 'chrisporate_doctype', 10 );


if ( ! function_exists( 'chrisporate_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'chrisporate_before_wp_head', 'chrisporate_head', 10 );

if ( ! function_exists( 'chrisporate_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'chrisporate' ); ?></a>

		<?php
	}
endif;

add_action( 'chrisporate_page_start_action', 'chrisporate_page_start', 10 );

if ( ! function_exists( 'chrisporate_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'chrisporate_page_end_action', 'chrisporate_page_end', 10 );

if ( ! function_exists( 'chrisporate_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_header_start() {
		$options = chrisporate_get_theme_options();
		$class_media = ( ! has_header_image() ) ? 'header-media-disable' :'';
		?>
		<header id="masthead" class="site-header classic-menu <?php echo esc_attr( $class_media ); ?>" role="banner">
		<?php
	}
endif;
add_action( 'chrisporate_header_action', 'chrisporate_header_start', 10 );

if ( ! function_exists( 'chrisporate_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_site_branding() {
		$options  = chrisporate_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];		
		?> 
		<div class="site-menu">
            <div class="container">
				<div class="site-branding pull-left">
					<div class="site-logo">
					<?php 
						if ( 'show-all' === $header_txt_logo_extra || 'logo-title' === $header_txt_logo_extra || 'logo-tagline' === $header_txt_logo_extra ) {
							the_custom_logo();
						} ?>
					</div><!-- .site-logo -->
					<div id="site-details">
						<?php
						if( 'show-all' === $header_txt_logo_extra  || 'title-only' === $header_txt_logo_extra || 'logo-title' === $header_txt_logo_extra ) { ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
						} 
						if ( 'show-all' === $header_txt_logo_extra  || 'tagline-only' === $header_txt_logo_extra || 'logo-tagline' === $header_txt_logo_extra ) {
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php
							endif; 
						}?>
					</div><!-- .site-details -->
				</div><!-- .site-branding -->
		<?php
	}
endif;
add_action( 'chrisporate_header_action', 'chrisporate_site_branding', 20 );

if ( ! function_exists( 'chrisporate_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_site_navigation() {
		
		?>
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span aria-hidden="true" class="icon"></span>				
				</button>
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 
						'fallback_cb'		=>'chrisporate_menu_fallback_cb', 
						'theme_location' 	=> 'primary', 
						'menu_id' 			=> 'primary-menu',
						'menu_class' 		=> 'menu nav-menu',
						'wrapper' 			=> false,
					) ); ?>
				</nav><!-- #site-navigation -->
		 	</div><!-- .container -->
        </div><!-- .site-menu -->
		<?php
	}
endif;
add_action( 'chrisporate_header_action', 'chrisporate_site_navigation', 30 );

if ( ! function_exists( 'chrisporate_header_banner' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_header_banner() {
		$options = chrisporate_get_theme_options();

		$vid_class = ( has_header_video() && chrisporate_is_frontpage() ) ? 'video-enabled' : '';
		?>
		<div id="header-featured-image" class="<?php echo esc_attr( $vid_class ); ?> relative">

            <div class="overlay"></div> 
            <?php 
            if ( is_singular() && ! is_front_page() && ! is_home() ) :
            	$header_image = get_post_meta( get_the_id(), 'chrisporate-header-image', true );
            	if ( 'featured-image' === $header_image ) :
            		if ( has_post_thumbnail() ) : ?>
            			<div id="wp-custom-header" class="wp-custom-header">
            				<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
            			</div>
            		<?php else :
            			the_custom_header_markup();
            		endif;
    			else :
    				the_custom_header_markup();
    			endif;
			else :
            	the_custom_header_markup();
        	endif; 


            if ( chrisporate_is_frontpage() ) : 
            	if ( ! empty( $options['banner_section_title'] ) || ! empty( $options['banner_section_sub_title'] ) ) : ?>
		            <div class="video-content">
		                <div class="video-title">
		                	<?php if ( ! empty( $options['banner_section_title'] ) ) : ?>
			                    <h1><?php echo esc_html( $options['banner_section_title'] ); ?></h1>
			                <?php endif;
			                if ( ! empty( $options['banner_section_sub_title'] ) ) : ?>
			                    <h2><?php echo esc_html( $options['banner_section_sub_title'] ); ?></h2>	
		                    <?php endif; ?>
		                </div><!-- .video-title -->
		            </div><!-- .video-content -->
		        <?php endif; ?>
		        <div class="move-down">
		            <a href="#content" class="scroll-link">
		            	<img src="<?php echo get_template_directory_uri(); ?>/assets/uploads/icon-01.png" alt="icon" class="icon-animation">
		            </a>
		        </div><!-- .move-down -->
	        <?php else : ?>
	        	<div class="container">
	                <div class="page-detail">
	                    <header class="page-header">
	                        <h1 class="page-title">
	                        	<?php if ( is_singular() ) {
									the_title();
								} elseif( is_404() ) {
									esc_html_e( '404', 'chrisporate' );
								} elseif( is_search() ){
									printf( esc_html__( 'Search Result for: %s', 'chrisporate' ), get_search_query() );
								} elseif ( is_archive() ) {
									if ( class_exists( 'WooCommerce' ) && is_shop() )
										woocommerce_page_title();
									else
										the_archive_title();
								} elseif ( is_home() ) {
									if ( is_home() && ! is_front_page() ) :
										echo ! empty( $options['your_latest_posts_title'] ) ? esc_html( $options['your_latest_posts_title'] ) : esc_html__( 'Blogs', 'chrisporate' );
									endif;
								} ?>
	                        </h1>
	                    </header><!-- .page-header -->
	                </div><!-- .page-detail -->
	            </div><!-- .container -->

			<?php endif; ?>

	    </div><!-- #video-wrapper -->
		<?php
	}
endif;

add_action( 'chrisporate_header_action', 'chrisporate_header_banner', 40 );


if ( ! function_exists( 'chrisporate_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'chrisporate_header_action', 'chrisporate_header_end', 50 );

if ( ! function_exists( 'chrisporate_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'chrisporate_content_start_action', 'chrisporate_content_start', 20 );

if ( ! function_exists( 'chrisporate_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_content_end() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'chrisporate_content_end_action', 'chrisporate_content_end', 10 );

if ( ! function_exists( 'chrisporate_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_footer_start() {
		?>
		<footer id="colophon" class="site-footer page-section" role="contentinfo">
		<?php
	}
endif;
add_action( 'chrisporate_footer', 'chrisporate_footer_start', 10 );

if ( ! function_exists( 'chrisporate_social_menu' ) ) :
	/**
	 * Start div id #loader
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_social_menu() { 
		$options = chrisporate_get_theme_options();
		?>
		<div class="container">
            <div class="footer-wrapper">
            	<?php if ( true == $options['footer_image_enable'] && ! empty( $options['footer_image'] ) ) : ?>
                	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $options['footer_image'] ); ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
            	<?php endif; 

				if ( true == $options['footer_social_enable'] &&  has_nav_menu( 'social' ) ) : 
						
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-icons',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
					) );
						
				endif; ?>
            </div><!-- .footer-wrapper -->
        </div><!-- .container -->
	<?php
	}
endif;
add_action( 'chrisporate_footer', 'chrisporate_social_menu', 30 );

if ( ! function_exists( 'chrisporate_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_footer_site_info() {
		$theme_data = wp_get_theme();
		$options = chrisporate_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );

		$copyright_text = $options['copyright_text']; 
		$powered_by_text = esc_html__( 'All Rights Reserved | ', 'chrisporate' ) . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'chrisporate' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>';
		?>
		<div class="site-info">
			 <div class="container">
				<p class="copy-right">
					<?php echo chrisporate_santize_allow_tag( $copyright_text ); ?>
				</p>
				<p>
					<?php echo chrisporate_santize_allow_tag( $powered_by_text );
					if ( function_exists( 'the_privacy_policy_link' ) ) {
						the_privacy_policy_link( '<span> | </span>' );
					} ?>
				</p>
			</div>
		</div><!-- .site-info -->
	<?php
	}
endif;
add_action( 'chrisporate_footer', 'chrisporate_footer_site_info', 40 );

if ( ! function_exists( 'chrisporate_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_footer_scroll_to_top() {
		$options  = chrisporate_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop">
		        <i class="fa fa-angle-up"></i>
		    </div><!-- .backtotop -->
		<?php endif;
	}
endif;
add_action( 'chrisporate_footer', 'chrisporate_footer_scroll_to_top', 40 );

if ( ! function_exists( 'chrisporate_footer_end' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_footer_end() {
		?>
		</footer>
		<?php
	}
endif;
add_action( 'chrisporate_footer', 'chrisporate_footer_end', 100 );

if ( ! function_exists( 'chrisporate_get_author_profile' ) ) :
	/**
	 * Function to get author profile
	 *
	 * @since Chrisporate 1.0.0
	 */           
	function chrisporate_get_author_profile(){
		$options = chrisporate_get_theme_options();
		if ( false === $options['single_post_show_author'] ) {
			return;
		} ?>

		<div id="about-author">
            <div class="container">
                <div class="entry-content">
                    <div class="author-image">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 115 );  ?>
                    </div><!-- .author-image -->

                    <div class="author-content">
                        <div class="author-name clear">
                            <h2><?php the_author_posts_link(); ?> </h2>
                            <span class="author"><?php echo esc_html_e( 'Author', 'chrisporate' ); ?></span>
                        </div><!--.author-name-->
                        <?php 
                    	$description = get_the_author_meta( 'description' );
                        if ( ! empty( $description ) ) : ?>
	                        <p><?php echo esc_html( strip_tags( $description ) ); ?></p>
	                    <?php endif; ?>
                    </div><!-- .author-content -->
                </div><!-- .entry-content -->
            </div><!-- .container -->
        </div>
	<?php
	}	
endif;
add_action( 'chrisporate_author_profile_action', 'chrisporate_get_author_profile' );

if ( ! function_exists( 'chrisporate_infinite_loader_spinner' ) ) :
	/**
	 *
	 * @since Chrisporate 1.0.0
	 *
	 */
	function chrisporate_infinite_loader_spinner() { 
		global $post;
		$options = chrisporate_get_theme_options();
		$icon = ! empty( $options['loader_icon'] ) ? $options['loader_icon'] : 'fa-circle-o-notch';
		if ( $options['pagination_type'] == 'infinite' ) :
			if ( count( $post ) > 0 ) {
				echo '<div class="blog-loader"><i class="fa ' . esc_attr( $icon ) . ' fa-spin"></i></div>';
			}
		endif;
	}
endif;
add_action( 'chrisporate_infinite_loader_spinner_action', 'chrisporate_infinite_loader_spinner', 10 );