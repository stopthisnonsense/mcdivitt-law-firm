<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main fffff" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );
				get_template_part( 'template-parts/wc', 'protected' );

				//get_template_part( 'template-parts/practice', 'areas' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();