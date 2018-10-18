<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

get_header(); ?>
<div class="single-blog-wrapper container template-part">
	<div class="page-section clear">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'single' );

					/**
					* Hook chrisporate_action_post_pagination
					*  
					* @hooked chrisporate_post_pagination 
					*/
					do_action( 'chrisporate_action_post_pagination' );
					
					/**
					* Hook chrisporate_author_profile_action
					*  
					* @hooked chrisporate_get_author_profile
					*/
					do_action( 'chrisporate_author_profile_action' );
					
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		if ( chrisporate_is_sidebar_enable() ) {
			get_sidebar();
		}
		?>
	</div><!-- .page-section/.clear -->
</div><!-- .template-part -->

<?php
get_footer();
