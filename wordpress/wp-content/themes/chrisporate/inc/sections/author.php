<?php
/**
 * Author section
 *
 * This is the template for the content of author section
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */
if ( ! function_exists( 'chrisporate_add_author_section' ) ) :
    /**
    * Add author section
    *
    *@since Chrisporate 1.0.0
    */
    function chrisporate_add_author_section() {
    	$options = chrisporate_get_theme_options();
        // Check if author is enabled on frontpage
        $author_enable = apply_filters( 'chrisporate_section_status', true, 'author_section_enable' );

        if ( true !== $author_enable ) {
            return false;
        }
        // Get author section details
        $section_details = array();
        $section_details = apply_filters( 'chrisporate_filter_author_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render author section now.
        chrisporate_render_author_section( $section_details );
    }
endif;


if ( ! function_exists( 'chrisporate_get_author_section_details' ) ) :
    /**
    * author section details.
    *
    * @since Chrisporate 1.0.0
    * @param array $input author section details.
    */
    function chrisporate_get_author_section_details( $input ) {
        $options = chrisporate_get_theme_options();

        // Content type.
        $content = array();

        $page_id = ! empty( $options['author_content_page'] ) ? $options['author_content_page'] : '';
        
        $args = array(
            'post_type' => 'page',
            'page_id'   => $page_id,
            );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['image']       = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'large' ) : '';
                $page_post['title']       = get_the_title();
                $page_post['url']         = get_the_permalink();
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
// author section content details.
add_filter( 'chrisporate_filter_author_section_details', 'chrisporate_get_author_section_details' );


if ( ! function_exists( 'chrisporate_render_author_section' ) ) :
  /**
   * Start author section
   *
   * @return string author content
   * @since Chrisporate 1.0.0
   *
   */
   function chrisporate_render_author_section( $content_details = array() ) {
        $options = chrisporate_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="author" class="col-2 relative">
            <div class="container">
                <div class="author-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": false, "speed": 600, "dots": false, "arrows":true, "autoplay": true, "fade": true }'>
                    <?php foreach( $content_details as $content ) : ?>
                        <div class="slick-item <?php echo empty( $content['image'] ) ? 'no-featured-image' : ''; ?>">
                            <?php if ( ! empty( $content['image'] ) ) : ?>
                                <div class="hentry">
                                    <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');"></div>
                                </div><!-- .hentry -->
                            <?php endif; ?>

                            <div class="hentry">
                                <div class="author-slider-content">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><?php echo esc_html( $content['title'] ); ?></h2>
                                    </header><!-- .entry-header -->

                                    <?php if ( ! empty( $content['excerpt'] ) ) : ?>
                                        <div class="entry-content">
                                            <p><?php echo wp_kses_post( $content['excerpt'] ); ?></p>
                                        </div><!-- .entry-content -->
                                    <?php endif; ?>
                                </div><!-- .author-slider-content -->
                            </div><!-- .hentry -->
                        </div><!-- .slick-item -->
                    <?php endforeach; ?>
                </div><!-- .author-slider -->
            </div><!-- .container -->
        </div><!-- #author -->
    <?php 
    }
endif;