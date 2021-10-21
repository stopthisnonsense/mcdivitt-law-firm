<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package McDivitt_Law_Firm
 */

get_header(); ?>

<div class="grid-container">
	<div class="section-header">
      <h2>404: Page Not Found</h2>
		  <h3><?php esc_html_e( 'The page you were looking for could not be found.', 'mcdivitt-law-firm' ); ?></h3>
		</div>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
    		<div class="page-sidebar">
          <?php echo do_shortcode('[wpv-post-body view_template="sidebar-form"]'); ?>
    		</div>
			<section class="error-404 not-found">
				<div class="page-content">
          <p>Sorry, but <strong>the page you were searching for could not be found</strong>. If you continue to experience difficulty, please <a href="contact">contact us</a>.</p>
          <a href="/" class="learn-more">Go Home</a>
          <br>
          <hr style="margin:0 0 30px;">
          <h4>Popular Pages</h4>
          <ul>
            <li><a href="/about">About Us</a></li>
            <li><a href="/practice-areas/auto-accident">Auto Accidents</a></li>
            <li><a href="/attorneys">Attorneys</a></li>
            <li><a href="/blog">Blog</a></li>
            <li><a href="/practice-areas/defective-products">Defective Drugs & Devices</a></li>
            <li><a href="/practice-areas/motorcycle-accident">Motorcycle Accidents</a></li>
            <li><a href="/practice-areas/nursing-home-negligence">Nursing Home Negligence</a></li>
            <li><a href="/practice-areas/premises-liability">Premises Liability</a></li>
            <li><a href="/practice-areas/truck-accident">Truck Accidents</a></li>
            <li><a href="/practice-areas/wrongful-death">Wrongful Death</a></li>
          </ul>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
			</main><!-- #main -->
		</div><!-- #primary -->
</div>

<?php
get_footer();