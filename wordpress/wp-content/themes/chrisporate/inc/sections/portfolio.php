<?php
/**
 * Portfolio section
 *
 * This is the template for the content of portfolio section
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */
if ( ! function_exists( 'chrisporate_add_portfolio_section' ) ) :
    /**
    * Add portfolio section
    *
    *@since Chrisporate 1.0.0
    */
    function chrisporate_add_portfolio_section() {
    	$options = chrisporate_get_theme_options();
        // Check if portfolio is enabled on frontpage
        $portfolio_enable = apply_filters( 'chrisporate_section_status', true, 'portfolio_section_enable' );

        if ( true !== $portfolio_enable ) {
            return false;
        }
        // Get portfolio section details
        $section_details = array();
        $section_details = apply_filters( 'chrisporate_filter_portfolio_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render portfolio section now.
        chrisporate_render_portfolio_section( $section_details );
    }
endif;


if ( ! function_exists( 'chrisporate_get_portfolio_section_details' ) ) :
    /**
    * portfolio section details.
    *
    * @since Chrisporate 1.0.0
    * @param array $input portfolio section details.
    */
    function chrisporate_get_portfolio_section_details( $input ) {
        $options = chrisporate_get_theme_options();

        $content = array();
        $page_ids = array();

        for ( $i = 1; $i <= 4; $i++ ) {
            if ( ! empty( $options['portfolio_content_page_' . $i] ) )
                $page_ids[] = $options['portfolio_content_page_' . $i];
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          => $page_ids,
            'posts_per_page'    => 4,
            'orderby'           => 'post__in',
            );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['image']       = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-550x382.jpg';
                $page_post['title']       = get_the_title();
                $page_post['url']         = get_the_permalink();
                $page_post['excerpt']     = chrisporate_trim_content( 15 );

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
// portfolio section content details.
add_filter( 'chrisporate_filter_portfolio_section_details', 'chrisporate_get_portfolio_section_details' );


if ( ! function_exists( 'chrisporate_render_portfolio_section' ) ) :
  /**
   * Start portfolio section
   *
   * @return string portfolio content
   * @since Chrisporate 1.0.0
   *
   */
   function chrisporate_render_portfolio_section( $content_details = array() ) {
        $options = chrisporate_get_theme_options();
        $title = ! empty( $options['portfolio_title'] ) ? $options['portfolio_title'] : '';

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="portfolio" class="page-section relative">
            <div class="container">
                <?php if ( ! empty( $title ) ) : ?>
                    <div class="portfolio-content-title clear">
                        <header class="entry-header section-title">
                            <h2 class="entry-title"><?php echo esc_html( $title ); ?></h2>
                        </header><!-- .entry-header -->
                    </div><!-- .portfolio-contennt -->
                <?php endif; ?>

                <div class="entry-content col-2">
                    <div class="row">
                        <div class="portfolio-item">
                            <?php foreach ( $content_details as $content ) : ?>
                                <div class="hentry">
                                    <?php if ( ! empty( $content['image'] ) ) : ?>
                                        <figure>
                                            <a href="<?php echo esc_url( $content['url'] ); ?>">
                                                <img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
                                            </a>
                                        </figure>
                                    <?php endif; ?>
                                    <div class="portfolio-title">
                                        <h4><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h4>
                                        <div class="entry-summary">
                                            <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                        </div>
                                    </div><!-- .portfolio-title -->
                                </div><!-- .hentry -->
                            <?php endforeach; ?>
                        </div><!-- portfolio-item -->
                    </div><!-- .row -->
                </div><!-- .entry-content / col-2 -->
            </div><!-- .container -->
        </div><!-- #portfolio -->
    <?php 
    }
endif;