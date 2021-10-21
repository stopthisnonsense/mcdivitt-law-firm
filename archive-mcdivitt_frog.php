<?php
get_header();
?>
<div class="grid-container">
	<div class="section-header">
		  <h2><?php
					the_archive_title();
				?></h2>
		  <div class="separator"><i class="anchor"></i></div>
		</div>
		<div id="primary" class="content-area content-area--mcdivitt-frog">
			<main id="main" class="site-main" role="main">
    		<div class="page-sidebar">
    			<?php get_sidebar(); ?>
    		</div>
			<?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->
</div>

<?php get_footer(); ?>