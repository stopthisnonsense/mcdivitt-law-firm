<?php
get_header();
?>
<div class="grid-container">
	<div class="section-header">
		  <h1>The McDivitt Frog</h1>
		  <div class="separator"><i class="anchor"></i></div>
		</div>
		<div id="primary" class="content-area content-area--mcdivitt-frog">
			<main id="main" class="site-main" role="main">
				<p class="section-subtitle">The McDivitt Frog was introduced as a helpful way for people to remember the McDivitt name. There are a lot of law firms out there, and we want people to always think “McDivitt” if they are in need of exceptional legal representation.</p>
			<?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'mcdivitt-frog' );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; wp_reset_postdata(); ?>
			<div class="frog-item">
				<div class="frog-item__left">
				<?php if( has_post_thumbnail()) { ?>
				<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">
					<?php the_post_thumbnail('medium', ['class' => 'frog-item__image']); ?>
				</a><?php } ?>
				</div>
				<div class="frog-item__right">
					<h4 class="frog-item__title">Beyond the Frog
					</h4>
					<div class="frog-item__excerpt">
						<p>It’s not all frogs and games here at McDivitt, we take our clients’ accidents and injuries very seriously. McDivitt Law Firm is here to help you get properly compensated after an accident by standing up to insurance companies on your behalf.</p>
						<div class="blog">
							<div class="blog-entry">
								<div class="frog-item__button-container"><a class="frog-item__button" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Read More</a></div>
							</div>
						</div>
					</div>
				</div>

			</div>

			</main><!-- #main -->
		</div><!-- #primary -->
</div>

<?php get_footer(); ?>