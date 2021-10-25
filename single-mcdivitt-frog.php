<?php
get_header();

$frog_subtitle = get_field( 'frog_subtitle' );
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
  		<?php
  		while ( have_posts() ) : the_post(); ?>
		  <div class="mcribbit-intro">
		  	<h1><?php the_title(); ?></h1>
			  <?php if( $frog_subtitle ) { ?>
				<p><?= $frog_subtitle; ?></p>
			<?php
			  } ?>
			  <div class="frog"></div>
		  </div>

		  <?php

  			get_template_part( 'template-parts/content', get_post_format() );

  			// If comments are open or we have at least one comment, load up the comment template.
  			if ( comments_open() || get_comments_number() ) :
  				comments_template();
  			endif;

  		endwhile;
		  wp_reset_postdata(); // End of the loop.
  		?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>