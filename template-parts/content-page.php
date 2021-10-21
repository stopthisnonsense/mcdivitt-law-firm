<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package McDivitt_Law_Firm
 */

?>

<nav class="breadcrumbs">
	<?php if (is_front_page()) {
		echo '';
	} else {
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div class="grid-container">','</div>');
		}
	} ?>
</nav>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
