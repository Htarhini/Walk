<?php
/**
 * The search form template
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'chrisporate' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'chrisporate' ) ?>" value="<?php echo get_search_query(); ?>" name="s">
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"></span><i class="fa fa-search"></i></button>
</form><!--.search-form-->
