<?php
get_header();
	$bottom_frog_fields = get_field( 'bottom_frog_item', 15407 );
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
				?>
				<?php if( $bottom_frog_fields ) { ?>
				<div class="frog-item">
					<div class="frog-item__left">
					<a href="<?php echo get_post_type_archive_link( 'videos' ); ?>">
						<?php if( $bottom_frog_fields['image'] ) { ?>
							<?php echo wp_get_attachment_image( $bottom_frog_fields['image'],'medium', ['class' => 'frog-item__image']); ?>
						<?php } ?>

					</a>
					</div>
					<div class="frog-item__right">
						<?php if( $bottom_frog_fields['title'] ) { ?>
							<h4 class="frog-item__title"><?php echo $bottom_frog_fields['title']; ?></h4>
						<?php
						} ?>

						<div class="frog-item__excerpt">
							<?php if( $bottom_frog_fields['excerpt'] ) { ?>
								<?php echo $bottom_frog_fields['excerpt']; ?>
							<?php }
							?>
							<div class="blog">
								<div class="blog-entry">
									<div class="frog-item__button-container"><a class="frog-item__button" href="<?php echo get_post_type_archive_link( 'videos' ); ?>">Read More</a></div>
								</div>
							</div>
						</div>
					</div>

				</div>
			<?php
			} ?>

			<?php the_posts_pagination( array( 'midsize' => 2, 'prev_next'=> false, 'class' => 'pagination--frogs' ) ); ?>
			<?php

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; wp_reset_postdata(); ?>



			</main><!-- #main -->
		</div><!-- #primary -->
</div>

<?php get_footer(); ?>