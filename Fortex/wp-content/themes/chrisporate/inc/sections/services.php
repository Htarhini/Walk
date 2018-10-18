<?php
/**
 * Services section
 *
 * This is the template for the content of service section
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */
if ( ! function_exists( 'chrisporate_add_service_section' ) ) :
    /**
    * Add service section
    *
    *@since Chrisporate 1.0.0
    */
    function chrisporate_add_service_section() {
    	$options = chrisporate_get_theme_options();
        // Check if service is enabled on frontpage
        $service_enable = apply_filters( 'chrisporate_section_status', true, 'service_section_enable' );

        if ( true !== $service_enable ) {
            return false;
        }
        // Get service section details
        $section_details = array();
        $section_details = apply_filters( 'chrisporate_filter_service_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render service section now.
        chrisporate_render_service_section( $section_details );
    }
endif;


if ( ! function_exists( 'chrisporate_get_service_section_details' ) ) :
    /**
    * service section details.
    *
    * @since Chrisporate 1.0.0
    * @param array $input service section details.
    */
    function chrisporate_get_service_section_details( $input ) {
        $options = chrisporate_get_theme_options();

        // Content type.
        $content = array();
       
        $page_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['service_content_page_' . $i] ) )
                $page_ids[] = $options['service_content_page_' . $i];
        }

        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 3,
            'orderby'           => 'post__in',
            );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $icon_value = get_post_meta( get_the_id(), 'chrisporate-post-icon', true );
                $page_post['icon']        = ! empty( $icon_value ) ? $icon_value : 'fa-tint';
                $page_post['id']          = get_the_id();
                $page_post['title']       = get_the_title();
                $page_post['sub_title']   = has_excerpt() ? get_the_excerpt() : '';
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
// service section content details.
add_filter( 'chrisporate_filter_service_section_details', 'chrisporate_get_service_section_details' );


if ( ! function_exists( 'chrisporate_render_service_section' ) ) :
  /**
   * Start service section
   *
   * @return string service content
   * @since Chrisporate 1.0.0
   *
   */
   function chrisporate_render_service_section( $content_details = array() ) {
        $options = chrisporate_get_theme_options();
        $title = ! empty( $options['service_title'] ) ? $options['service_title'] : '';

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="services" class="page-section relative">
            <div class="container">
                <?php if ( ! empty( $title ) ) : ?>
                    <div class="services-content-title clear">
                        <header class="entry-header section-title">
                            <h2 class="entry-title"><?php echo esc_html( $title ); ?></h2>
                        </header><!-- .entry-header -->
                    </div><!-- .services-contennt -->
                <?php endif; ?>

                <div class="entry-content">
                    <div class="tabs-wrapper">
                        <ul class="nav-tabs">
                            <?php $i = 1;
                            foreach ( $content_details as $content ) : ?>
                                <li <?php echo ( $i == 1 ) ? 'class="active"' : ''; ?>>
                                    <a href="#<?php echo absint( $content['id'] ); ?>">
                                        <i class="fa <?php echo esc_attr( $content['icon'] ); ?>"></i>
                                        <h6><?php echo esc_html( $content['title'] ); ?></h6>
                                        <span><?php echo $i; ?></span>
                                    </a> 
                                </li>
                                <?php $i++; 
                            endforeach; ?>
                        </ul><!-- .nav-tabs -->

                        <div class="tabs-contents-wrapper">
                            <?php $i = 1; 
                            foreach( $content_details as $content ) : 
                                $class = ( $i == 1 ) ? 'active' : '';
                                $class .= ! empty( $content['sub_title'] ) ? ' col-2' : ' col-1';
                                ?>
                                <div id="<?php echo absint( $content['id'] ); ?>" class="tab-pane <?php echo esc_attr( $class ); ?>">
                                    <?php if ( ! empty( $content['sub_title'] ) ) : ?>
                                        <strong class="pull-left"><?php echo esc_html( $content['sub_title'] ); ?></strong>
                                    <?php endif; ?>

                                    <div class="entry-summary pull-right">
                                        <p><?php echo wp_kses_post( $content['excerpt'] ); ?></p>
                                    </div><!-- .entry-summary -->
                                </div><!-- .tab-pane -->
                                <?php $i++;
                            endforeach; ?>
                        </div><!-- .tabs-contents-wrapper -->
                    </div><!-- .tabs-wrapper -->
                </div><!-- .entry-content -->
            </div><!-- .container -->
        </div><!-- #services -->
    <?php 
    }
endif;