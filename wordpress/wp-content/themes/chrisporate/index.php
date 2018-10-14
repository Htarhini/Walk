<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

get_header(); 
?>
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
