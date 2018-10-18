<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */
?>
<div class="single-post-wrapper">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="container">
			<header class="entry-header">
				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php chrisporate_single_posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php endif;

				$header_image = chrisporate_single_header_image();
		    	if ( 'show-both' === $header_image && has_post_thumbnail() ) : ?>
					<div class="featured-image">
						<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
					</div>
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'chrisporate' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'chrisporate' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php chrisporate_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .container -->
	</article><!-- #post-## -->
</div><!-- .single-post-wrapper -->