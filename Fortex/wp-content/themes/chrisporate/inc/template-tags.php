<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

if ( ! function_exists( 'chrisporate_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function chrisporate_posted_on() {
		$options = chrisporate_get_theme_options();
		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			__( 'BY %s', 'chrisporate' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		if ( true === $options['show_category'] ) :
			$categories_list = get_the_category_list( esc_html__( ', ', 'chrisporate' ) );
			if ( $categories_list && chrisporate_categorized_blog() ) {
				echo '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
			}
		endif;

		// Finally, let's write all of this to the page.
		if ( true === $options['show_date'] ) :
			echo '<span class="posted-on">' . chrisporate_time_link() . '</span>';
		endif;

		if ( true === $options['show_author'] ) :
			echo '<span class="byline"> ' . $byline . '</span>';
		endif;

	}
endif;

if ( ! function_exists( 'chrisporate_single_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function chrisporate_single_posted_on() {
		$options = chrisporate_get_theme_options();

		if ( true === $options['single_post_show_author'] ) :
			// Get the author name; wrap it in a link.
			$byline = sprintf(
				/* translators: %s: post author */
				__( 'BY %s', 'chrisporate' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
			);
	
			// Finally, let's write all of this to the page.
			echo '<span class="byline"> ' . $byline . '</span>';
		endif;

		/* translators: used between list items, there is a space after the comma */
		if ( true === $options['single_post_show_category'] ) :
			$categories_list = get_the_category_list( esc_html__( ', ', 'chrisporate' ) );
			if ( $categories_list && chrisporate_categorized_blog() ) {
				echo '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
			}
		endif;

		if ( true === $options['single_post_show_date'] ) :
			echo '<span class="posted-on">' . chrisporate_time_link() . '</span>';
		endif;

		if ( true === $options['single_post_show_comment'] ) :
			if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-link">';
				/* translators: %s: post title */
				comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'chrisporate' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
				echo '</span>';
			}
		endif;
	}
endif;


if ( ! function_exists( 'chrisporate_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function chrisporate_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	$year = get_the_date( 'Y' );
	$month = get_the_date( 'm' );

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'chrisporate' ),
		'<a href="' . esc_url( get_month_link( $year, $month ) ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;

if ( ! function_exists( 'chrisporate_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function chrisporate_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() && is_single() ) {
			$options = chrisporate_get_theme_options();
			if ( true === $options['single_post_show_tags'] ) :
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html__( ' ', 'chrisporate' ) );
				if ( $tags_list ) {
					echo '<span class="tags-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
				}
			endif;
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'chrisporate' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function chrisporate_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'chrisporate_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'chrisporate_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so chrisporate_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so chrisporate_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in chrisporate_categorized_blog.
 */
function chrisporate_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'chrisporate_categories' );
}
add_action( 'edit_category', 'chrisporate_category_transient_flusher' );
add_action( 'save_post',     'chrisporate_category_transient_flusher' );
