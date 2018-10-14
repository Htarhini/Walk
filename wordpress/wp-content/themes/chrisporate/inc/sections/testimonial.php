<?php
/**
 * Testimonial section
 *
 * This is the template for the content of testimonial section
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */
if ( ! function_exists( 'chrisporate_add_testimonial_section' ) ) :
    /**
    * Add testimonial section
    *
    *@since Chrisporate 1.0.0
    */
    function chrisporate_add_testimonial_section() {
    	$options = chrisporate_get_theme_options();
        // Check if testimonial is enabled on frontpage
        $testimonial_enable = apply_filters( 'chrisporate_section_status', true, 'testimonial_section_enable' );

        if ( true !== $testimonial_enable ) {
            return false;
        }
        // Get testimonial section details
        $section_details = array();
        $section_details = apply_filters( 'chrisporate_filter_testimonial_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render testimonial section now.
        chrisporate_render_testimonial_section( $section_details );
    }
endif;


if ( ! function_exists( 'chrisporate_get_testimonial_section_details' ) ) :
    /**
    * testimonial section details.
    *
    * @since Chrisporate 1.0.0
    * @param array $input testimonial section details.
    */
    function chrisporate_get_testimonial_section_details( $input ) {
        $options = chrisporate_get_theme_options();

        $content = array();

        $page_ids = array();

        for ( $i = 1; $i <= 2; $i++ ) {
            if ( ! empty( $options['testimonial_content_page_' . $i] ) )
                $page_ids[] = $options['testimonial_content_page_' . $i];
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          =>  ( array ) $page_ids,
            'posts_per_page'    => 2,
            'orderby'           => 'post__in',
            );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']       = get_the_title();
                $page_post['excerpt']     = get_the_content();

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// testimonial section content details.
add_filter( 'chrisporate_filter_testimonial_section_details', 'chrisporate_get_testimonial_section_details' );


if ( ! function_exists( 'chrisporate_render_testimonial_section' ) ) :
  /**
   * Start testimonial section
   *
   * @return string testimonial content
   * @since Chrisporate 1.0.0
   *
   */
   function chrisporate_render_testimonial_section( $content_details = array() ) {
        $options = chrisporate_get_theme_options();
        $title  = ! empty( $options['testimonial_section_title'] ) ? $options['testimonial_section_title'] : '';
        $image  = ! empty( $options['testimonial_background_image'] ) ? $options['testimonial_background_image'] : get_template_directory_uri() . '/assets/uploads/testimonial.jpg';

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="testimonial" class="page-section relative no-padding-bottom" style="background-image: url('<?php echo esc_url( $image ); ?>');">
            <div class="overlay"></div>
            <div class="container">
                <div class="testimonial-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": false, "speed": 1000, "dots": true, "arrows":false, "autoplay": true, "fade": false }'>
                    <?php foreach ( $content_details as $content ) : ?>
                        <div class="testimonial-wrapper">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/uploads/testimonial.png" alt="<?php echo esc_attr( $content['title'] ); ?>">

                            <div class="testimonials-content">
                                <?php if ( ! empty( $title ) ) : ?>
                                    <h2><?php echo esc_html( $title ); ?></h2>
                                <?php endif; ?>
                                <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                <span class="clients-name">- <?php echo esc_html( $content['title'] ); ?></span>
                            </div><!-- .testimonials-content -->
                        </div><!-- .testimonial-wrapper -->
                    <?php endforeach; ?>
                </div><!-- .testimonial-slider -->
            </div><!-- .container -->
        </div><!-- #testimonial -->
    <?php 
    }
endif;