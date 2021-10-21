<?php
get_header();
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
<div class="grid-container">
  <div id="primary" class="content-area">
  	<main id="main" class="site-main" role="main">
  		<div class="page-sidebar">
  			<?php get_sidebar(); ?>
  		</div>
  		<?php
  		while ( have_posts() ) : the_post();

  			get_template_part( 'template-parts/content', get_post_format() );

  			// If comments are open or we have at least one comment, load up the comment template.
  			if ( comments_open() || get_comments_number() ) :
  				comments_template();
  			endif;

  		endwhile; // End of the loop.
  		?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>