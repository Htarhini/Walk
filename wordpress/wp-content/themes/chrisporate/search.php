<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

get_header(); ?>

<div class="container template-part">
    <div class="page-section clear">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>
					<div class="blog-posts-wrapper col-3 clear">
						<?php 	
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile; ?>
					</div><!-- .blog-post-wrapper -->
				<?php else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
				
				<?php
				/**
				* Hook - chrisporate_action_pagination.
				*
				* @hooked chrisporate_pagination 
				*/
				do_action( 'chrisporate_action_pagination' ); 

				/**
				* Hook - chrisporate_infinite_loader_spinner_action.
				*
				* @hooked chrisporate_infinite_loader_spinner 
				*/
				do_action( 'chrisporate_infinite_loader_spinner_action' );
				?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php if ( chrisporate_is_sidebar_enable() ) {
			get_sidebar();
		} ?>

	</div><!-- .page-section -->
</div><!-- .container -->

<?php
get_footer();
