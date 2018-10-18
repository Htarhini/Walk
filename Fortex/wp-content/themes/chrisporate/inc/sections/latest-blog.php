<?php
/**
 * Latest Blog section
 *
 * This is the template for the content of latest blog section
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */
if ( ! function_exists( 'chrisporate_add_latest_blog_section' ) ) :
    /**
    * Add latest blog section
    *
    *@since Chrisporate 1.0.0
    */
    function chrisporate_add_latest_blog_section() {
    	$options = chrisporate_get_theme_options();
        // Check if latest-blog is enabled on frontpage
        $latest_blog_enable = apply_filters( 'chrisporate_section_status', true, 'latest_blog_section_enable' );

        if ( true !== $latest_blog_enable ) {
            return false;
        }
        // Get latest blog section details
        $section_details = array();
        $section_details = apply_filters( 'chrisporate_filter_latest_blog_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render latest blog section now.
        chrisporate_render_latest_blog_section( $section_details );
    }
endif;


if ( ! function_exists( 'chrisporate_get_latest_blog_section_details' ) ) :
    /**
    * latest blog section details.
    *
    * @since Chrisporate 1.0.0
    * @param array $input latest blog section details.
    */
    function chrisporate_get_latest_blog_section_details( $input ) {
        $options = chrisporate_get_theme_options();

        // Content type.
        $latest_blog_content_type   = $options['latest_blog_content_type'];
        $content = array();

        switch ( $latest_blog_content_type ) {
            case 'category':
                $cat_id = ! empty( $options['latest_blog_content_category'] ) ? $options['latest_blog_content_category'] : '';

                $args = array(
                    'post_type'         => 'post',
                    'cat'               => $cat_id,
                    'posts_per_page'    => 3,
                    );
            break;

            case 'all':
                $cat_ids = ! empty( $options['latest_blog_exclude_category'] ) ? $options['latest_blog_exclude_category'] : array();
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 3,
                    'category__not_in'  => ( array ) $cat_ids,
                    'ignore_sticky_posts'   => true,
                    );
            break;

            default:
            break;
        }

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['image']       = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-550x382.jpg';
                $page_post['id']          = get_the_id();
                $page_post['title']       = get_the_title();
                $page_post['url']         = get_the_permalink();
                $page_post['excerpt']     = chrisporate_trim_content( 20 );
                $page_post['author']      = get_the_author_posts_link();

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
// latest blog section content details.
add_filter( 'chrisporate_filter_latest_blog_section_details', 'chrisporate_get_latest_blog_section_details' );


if ( ! function_exists( 'chrisporate_render_latest_blog_section' ) ) :
  /**
   * Start latest blog section
   *
   * @return string latest-blog content
   * @since Chrisporate 1.0.0
   *
   */
   function chrisporate_render_latest_blog_section( $content_details = array() ) {
        $options = chrisporate_get_theme_options();
        $read_more = ! empty( $options['read_more_text'] ) ? $options['read_more_text'] : esc_html__( 'Read More', 'chrisporate' );
        $title = ! empty( $options['latest_blog_title'] ) ? $options['latest_blog_title'] : '';

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="latest-blog" class="page-section relative">
            <div class="container">
                <?php if ( ! empty( $title ) ) : ?>
                    <div class="latest-content-title clear">
                        <header class="entry-header section-title">
                            <h2 class="entry-title"><?php echo esc_html( $title ); ?></h2>
                        </header><!-- .entry-header -->
                    </div><!-- .latest-blog-contennt -->
                <?php endif; ?>

                <div class="blog-posts-wrapper col-3 clear">
                    <?php foreach ( $content_details as $content ) : ?>
                        <article class="hentry">
                            <?php if ( ! empty( $content['image'] ) ) : ?>
                                <div class="featured-image">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>"></a>
                                </div><!--.featured-image-->
                            <?php endif; ?>

                            <div class="entry-container">
                                <div class="entry-meta">
                                    <span class="cat-links">
                                        <?php the_category( ', ', '', $content['id'] ); ?>
                                    </span>
                                    <span class="byline"><?php esc_html_e( 'BY ', 'chrisporate' ) ?>
                                        <span class="author vcard">
                                            <?php echo wp_kses_post( $content['author'] ); ?>
                                        </span>
                                    </span>
                                </div><!-- .entry-meta -->
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                </header>
                               
                                <div class="entry-content">
                                    <p><?php echo esc_html( $content['excerpt'] ); ?></p>

                                    <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn btn-fill"><?php echo esc_html( $read_more ); ?></a>
                                </div><!--.blog-content-->
                            </div><!-- .entry-container -->
                        </article><!-- #post-1 -->
                    <?php endforeach; ?>
                </div><!-- .blog-wrapper -->
            </div><!-- .container -->
        </div><!-- #latest-blog -->
    <?php 
    }
endif;