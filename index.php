<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package McDivitt_Law_Firm
 */

get_header(); ?>

<?php
	/**
	 * woocommerce_before_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action( 'woocommerce_before_main_content' );
?>

<nav class="breadcrumbs">
	<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<div class="grid-container">','</div>');} ?>
</nav>
	
<div class="grid-container">
	<div class="section-header">
		  <h2>Colorado Personal Injury Blog</h2>
		  <h3>The latest legal news, resources and updates <strong>for Greater Colorado</strong></h3>
		  <div class="separator"><i class="anchor"></i></div>
		</div>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
    		<div class="page-sidebar">
    			<?php get_sidebar(); ?>
    		</div>
			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>

				<?php
				endif;

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