<?php /* Template Name: Landing Page */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="format-detection" content="telephone=no">

<script>document.getElementsByTagName('html')[0].className += ' wf-loading'</script>


<link rel="icon" href="/wp-content/themes/mcdivitt-law-firm/favicon.png">
<link rel="apple-touch-icon" href="/wp-content/themes/mcdivitt-law-firm/images/apple-icon-touch.png">
<!--[if IE]><link rel="shortcut icon" href="/wp-content/themes/mcdivitt-law-firm/favicon.ico"><![endif]-->
<meta name="msapplication-TileColor" content="#f01d4f">
<meta name="msapplication-TileImage" content="/wp-content/themes/mcdivitt-law-firm/images/win8-tile-icon.png">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
	<div id="page">

		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

			<?php
				//check for bg image
				$bg_image = get_field('landing_bg_image');
				$styles = ($bg_image) ? 'background-image: url("' . $bg_image . '")' : '';
			?>
		
			<?php //top section ?>
			<div class="top-section" style="<?php echo $styles; ?>">
				<div class="inner">

					<div class="header">
						<a href="<?php echo home_url(); ?>" class="logo">
							<img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="McDivitt Law Firm">
						</a>
						<div class="right-side">
							<span class="talk"><i class="fa fa-phone"></i>Talk to Us Now</span>
							<span class="tel">877-846-4878</span>
						</div>
					</div>

					<?php
						//check for second bg image
						$bg_image = get_field('landing_floating_image');
						$styles = ($bg_image) ? 'background-image: url("' . $bg_image . '")' : '';
					?>

					<div class="intro" style="<?php echo $styles; ?>">

						<div class="wysiwyg">
							<?php the_field('first_wysiwyg'); ?>
						</div>

						<div class="form-wrap">
							<?php the_field('landing_form'); ?>
							<em class="disclaimer"><?php the_field('landing_form_disclaimer'); ?></em>
						</div>

					</div>

				</div>
			</div>

			<?php //content section ?>
			<div class="content-section">
				<div class="inner">

					<div class="wysiwyg content-first">
						<?php the_field('post_header_wysiwyg'); ?>
					</div>

					<?php //services + testimonial ?>
					<?php if( have_rows('services_list') ) : ?>
						<div class="grid-container services-wrap">

							<div class="col services-list">
								<h4 class="heading"><?php the_field('services_heading'); ?></h4>
								<ul>
									<?php while( have_rows('services_list') ) : the_row(); ?>
										<li><?php the_sub_field('services_service'); ?></li>
									<?php endwhile; ?>
								</ul>
							</div>

							<?php if( get_field('testimonial_content') ) : ?>
								<div class="col testimonial">

									<div class="quote">
										<?php the_field('testimonial_content'); ?>
									</div>
									<div class="quote-author">
										<?php the_field('testimonial_author'); ?>
									</div>

									<span class="fa fa-quote-left"></span>
									<span class="fa fa-quote-right"></span>
								</div>
							<?php endif; ?>

						</div>
					<?php endif; ?>

					<?php //stats section ?>
					<?php if( have_rows('stats') ) : ?>
						<div class="stats">
							<?php while( have_rows('stats') ) : the_row(); ?>
								<div class="stat">
									<div class="data"><?php the_sub_field('stat_data'); ?></div>
									<?php the_sub_field('stat_description'); ?>
								</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>

					<?php //three columns ?>
					<?php if( get_field('tc_column_1_text') ) : ?>
						<div class="grid-container cols cols3 trip-cols">

							<div class="col">
								<h4 class="heading"><?php the_field('tc_column_1_header'); ?></h4>
								<p><?php the_field('tc_column_1_text'); ?></p>
							</div>

							<div class="col">
								<h4 class="heading"><?php the_field('tc_column_2_header'); ?></h4>
								<p><?php the_field('tc_column_2_text'); ?></p>
							</div>

							<div class="col">
								<h4 class="heading"><?php the_field('tc_column_3_header'); ?></h4>
								<p><?php the_field('tc_column_3_text'); ?></p>
							</div>

						</div>
					<?php endif; ?>

					<?php //video + wysiwyg ?>
					<div class="wysiwyg content-second">
						<?php the_field('final_wysiwyg'); ?>
					</div>

					<?php //btm links + logos ?>
					<?php if( have_rows('trusted_by_images') ) : ?>
						<div class="trusted-by">
							<h3 class="heading"><?php the_field('trusted_by_heading'); ?></h3>

							<?php while( have_rows('trusted_by_images') ) : the_row(); ?>

								<span class="logo">

									<?php if( get_field('trusted_by_url') ) : ?>
										<a href="#">
									<?php endif; ?>

										<?php $image = get_sub_field('trusted_by_image'); ?>
										<img src="<?php echo @$image['url'] ?>" alt="<?php echo @$image['alt'] ?>">

									<?php if( get_field('trusted_by_url') ) : ?>
										</a>
									<?php endif; ?>

								</span>
								
							<?php endwhile; ?>

						</div>
					<?php endif; ?>

				</div>
			</div>

		<?php endwhile; endif; ?>

	<?php //footer will close #page ?>
	<?php get_footer(); ?>

</body>
</html>