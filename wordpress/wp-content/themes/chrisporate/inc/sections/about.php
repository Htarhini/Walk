<?php
/**
 * About section
 *
 * This is the template for the content of about section
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */
if ( ! function_exists( 'chrisporate_add_about_section' ) ) :
    /**
    * Add about section
    *
    *@since Chrisporate 1.0.0
    */
    function chrisporate_add_about_section() {
    	$options = chrisporate_get_theme_options();
        // Check if about is enabled on frontpage
        $about_enable = apply_filters( 'chrisporate_section_status', true, 'about_section_enable' );

        if ( true !== $about_enable ) {
            return false;
        }
        // Get about section details
        $section_details = array();
        $section_details = apply_filters( 'chrisporate_filter_about_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render about section now.
        chrisporate_render_about_section( $section_details );
    }
endif;


if ( ! function_exists( 'chrisporate_get_about_section_details' ) ) :
    /**
    * about section details.
    *
    * @since Chrisporate 1.0.0
    * @param array $input about section details.
    */
    function chrisporate_get_about_section_details( $input ) {
        $options = chrisporate_get_theme_options();

        $page_id = ! empty( $options['about_content_page'] ) ? $options['about_content_page'] : '';
        $args = array(
            'post_type'         => 'page',
            'page_id'           => $page_id,
            'posts_per_page'    => 1,
            );                    
        $content = array();           
        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['excerpt']   = get_the_content();

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
// about section content details.
add_filter( 'chrisporate_filter_about_section_details', 'chrisporate_get_about_section_details' );


if ( ! function_exists( 'chrisporate_render_about_section' ) ) :
  /**
   * Start about section
   *
   * @return string about content
   * @since Chrisporate 1.0.0
   *
   */
   function chrisporate_render_about_section( $content_details = array() ) {
        $options = chrisporate_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } 

        $col = ( false === $options['about_skills_enable'] || empty( $options['about_graph'] ) ) ? 'col-1' : 'col-2';

        foreach ( $content_details as $content ) : ?>
        	<div id="about" class="page-section no-padding-bottom relative">
            <div class="container">
                <div class="about-content-title clear">
                    <?php if ( ! empty( $content['title'] ) ) : ?>
                        <header class="entry-header">
                            <h2 class="entry-title"><?php echo esc_html( $content['title'] ); ?></h2>
                        </header><!-- .entry-header -->
                    <?php endif; ?>
                </div><!-- .about-content -->

                <div class="entry-content <?php echo esc_attr( $col ); ?>">
                    <?php if ( class_exists( 'TP_PieBuilder' ) && true === $options['about_skills_enable'] && ! empty( $options['about_graph'] ) ) : ?>
                        <div class="hentry">
                            <div class="skills">
                                <?php echo do_shortcode( wp_kses_post( $options['about_graph'] ) ); ?>
                            </div><!-- .skills -->
                        </div><!-- .hentry -->
                    <?php endif; ?>

                    <div class="hentry">
                        <?php if ( ! empty( $content['excerpt'] ) ) : ?>
                            <div class="entry-summary">
                                <p><?php echo wp_kses_post( $content['excerpt'] ); ?></p>
                            </div><!-- .entry-summary -->
                        <?php endif; ?>
                    </div><!-- .hentry -->
                </div><!-- .entry-content -->
            </div><!-- .container -->
        </div><!-- #about -->
        <?php endforeach;
    }
endif;