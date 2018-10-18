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

$options          	= chrisporate_get_theme_options();
$sidebar_position   = $options['sidebar_position'];
$img_size = in_array( $sidebar_position , array( 'no-sidebar', 'no-sidebar-content' ) ) ? 'post-thumbnail' : 'large';
$readmore = ! empty( $options['read_more_text'] ) ? $options['read_more_text'] : esc_html__( 'Read More', 'chrisporate' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-image">
	        <a href="<?php the_permalink(); ?>">
	        	<?php the_post_thumbnail( $img_size, array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	        </a>
	    </div><!--.featured-image-->
    <?php else : 
		if ( true === $options['no_featured_image'] ) : ?>
			<div class="featured-image">
	        	<a href="<?php the_permalink(); ?>">
					<img src="<?php echo get_template_directory_uri() ?>/assets/uploads/no-featured-image-550x382.jpg" alt="<?php the_title(); ?>">
				</a>
			</div><!--.featured-image-->
		<?php endif;
	endif; ?>

    <div class="entry-container">
    	<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php chrisporate_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<header class="entry-header">
			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			the_excerpt();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'chrisporate' ),
				'after'  => '</div>',
			) );

			if ( true === $options['show_readmore'] ) :
			?>
				<a href="<?php the_permalink(); ?>" class="btn btn-fill"><?php echo esc_html( $readmore ); ?></a>
			<?php endif; ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php chrisporate_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-container -->
</article><!-- #post-## -->
