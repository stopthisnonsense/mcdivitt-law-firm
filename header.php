<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package McDivitt_Law_Firm
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="format-detection" content="telephone=no">

<?php
/*
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
*/
?>


<script>document.getElementsByTagName('html')[0].className += ' wf-loading'</script>
<link rel="icon" href="/wp-content/themes/mcdivitt-law-firm/favicon.png">
<!--[if IE]><link rel="shortcut icon" href="/wp-content/themes/mcdivitt-law-firm/favicon.ico"><![endif]-->

<meta name="msvalidate.01" content="F92F94C6FE859ECC44AE8C28576F190F" />
<meta name="sitelock-site-verification" content="5315" />

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "McDivitt Law",
  "url": "https://mcdivittlaw.com",
  "sameAs": [
    "https://www.facebook.com/McDivittLaw/",
    "https://www.instagram.com/mcdivitt_law_firm/",
    "https://www.linkedin.com/company/mcdivittlawfirm/",
    "https://twitter.com/McDivittLaw/"
  ]
}
</script>


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
  
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mcdivitt-law-firm' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="secondary-header">
			<div class="px-5">
				<span class="site-focus">Colorado Personal Injury & Workers' Compensation Lawyers</span>
				<?php //<a class="alert" href="/practice-areas/el-paso-county-water-contamination"><strong>ALERT</strong>: Water Contamination</a> ?>
				<!-- <a class="alert" href="/practice-areas/defective-products/3m-military-earplugs">&nbsp;</a>-->
				<a class="spanish" style="color:#FF0000; !important;" href="/blog/category/covid-19">&nbsp;&nbsp;&nbsp;COVID-19 Resources</a>
				<a class="spanish" href="/es/quienes-somos">Se Habla Español</a>
				<a href="https://mcdivittportal.force.com/s/?language=en_US" class='float-right client-login'><i class="fas fa-lock"></i> CLIENT LOGIN</a>
			</div><!-- .grid-container -->
		</div><!-- .secondary-header -->
		
		<?php if(is_front_page() || is_page([14079, 14081])) { ?>
			
			<div class="primary-header">
				<a class="mobile-alert" href="/practice-areas/defective-products/3m-military-earplugs"><strong>&nbsp;</strong></a>
				<div class="">
					<div class="cols cols3 px-5">
						<!-- .col 1 -->
						<div class="col">
							<div class="logo-link">
								<a href="<?php echo esc_url( home_url( '' ) ); ?>" rel="home" title="McDivitt Law Firm"><span class="logo"><?php bloginfo( 'name' ); ?></span></a>
							</div>
						</div>
						
						<div class="col position-relative">							
							<!-- <div class="header-search float-right"><?php //echo do_shortcode( '[ubermenu-search]' ); ?></div> -->
							<div class="header-search float-right">
								<i class="fas fa-search" title="Search"></i>
								<form class="d-none" role="search" method="get"> 
									<input type="text" placeholder="Search..." value="" name="s"/> 
									<button class="d-none" type="submit"><i class="fas fa-search" title="Search"></i></button>
								</form>
							</div>
							<div class="free-consultation">
								<p class="cta">Call now for a <strong><span>FREE</span> Consultation</strong></p>
								<a class="number" href="tel:7194713700" rel="nofollow">719-471-3700</a>
								<p class="availability">Available 24/7, Same day return calls</p>
							</div>							
						</div><!-- .col 3 -->
						
					</div><!-- .cols3 -->
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					</nav><!-- #site-navigation -->
					
					<!-- <h2 style="font-size: 46px;">Legal Advice You Can Count On</h2>
					<h3>We’re here to help! <span>Request a <strong><em>FREE</em> case evaluation</strong> today</span></h3>-->
                   
					<?php if(is_front_page()) { ?>
						
						<!-- <div class="side-buttons live-chat"><a href="#">LIVE CHAT</a></div>
						<div class="side-buttons free-consult"><a href="#">GET A FREE CONSULTATION</a></div> -->
						<!--<div class="contact-form">
						<h2>request a free case evaluation today</h2>
							<?php echo do_shortcode( '[hsform id="c05bd996-2dad-4114-9213-a940137b4020"]' ); ?>
						

						<p>WHEN YOU COMPLETE THIS FORM A MEMBER OF OUR LEGAL TEAM WILL CONTACT YOU TO LEARN MORE ABOUT YOUR CIRCUMSTANCES AND SEE HOW WE MAY BE ABLE TO ASSIST YOU.</p>

						<p><img src="/wp-content/themes/mcdivitt-law-firm/images/mcribbit.png" /></p>

						</div>
						<div class="rating-section">
							<div class="rating">
								<h2>5.0</h2>
								<div><img src="/wp-content/uploads/star-rating.png"/></div>
								<div><a href="#">GOOGLE RATING</a></div>
							</div>
							<div class="amount">
								<div class="doller">$</div>
								<div class="field"><input type="text"/></div>
							</div>
							<div class="text">
								<h3>McDIVITT MAKES A DIFFERENCE</h3>
								<h5>OUR COMMUNITY OUTREACH PROGRAMS</h4>
								<h4>FOCUSING ON SAFETY & EDUCATION</h5>
							</div>
						</div>					
						<div class="gray-section">
							<div>Lorem ipsum dolor sit amet, consectetur adipiscing</div>
							<div class="middle">Lorem ipsum dolor sit</div>
							<div>Lorem ipsum dolor sit amet , consectetur adipiscin</div>
                            <div><a href="/about">History of Our Firm</a></div>
						</div> -->
					<?php } ?>
					<?php /*
					<!--[if lte IE 8]>
					<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
					<![endif]-->
					<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
					<script>
					  hbspt.forms.create({ 
					    css: '',
					    portalId: '1790085',
					    formId: 'c05bd996-2dad-4114-9213-a940137b4020'
					  });
					</script>
					*/ ?>

					<!-- <?php echo do_shortcode( '[hsform id="c05bd996-2dad-4114-9213-a940137b4020"]' ); ?> -->

					<!-- <p class="form-byline">When you complete this form a member of our legal team will contact you <span>to learn more about your circumstances and see how we may be able to assist you.</span></p> -->
				</div><!-- .grid-container -->

			</div><!-- .primary-header -->

			<?php //floating frog ?>
			<!--<a href="/mcdivitt-frog" id="floating-frog">
				<div class="mcdfrog"></div>
				<div class="fbutton">What's with the Frog?</div>
			</a> -->

		<!-- Header Code for the Home Page -->

		<?php } else { ?>
			<div class="primary-header">
				<div >
					<div class="cols cols3 px-5">
						<div class="col">
							<div class="logo-link">
								<a href="<?php echo esc_url( home_url( '' ) ); ?>" rel="home" title="McDivitt Law Firm"><span class="logo"><?php bloginfo( 'name' ); ?></span></a>
							</div>
						</div><!-- .col 2 -->
						
						<div class="col position-relative">		
							<!-- <div class="header-search float-right"><?php //echo do_shortcode( '[ubermenu-search]' ); ?></div> -->
							<div class="header-search float-right">
								<i class="fas fa-search" title="Search"></i>
								<form class="d-none" role="search" method="get" action="/"> 
									<input type="text" placeholder="Search..." value="" name="s"/> 
									<button class="d-none" type="submit"><i class="fas fa-search" title="Search"></i></button>
								</form>
							</div>
							<div class="free-consultation">
								<p class="cta">Call now for a <strong><span>FREE</span> Consultation</strong></p>
								<a class="number" href="tel:7194713700" rel="nofollow">719-471-3700</a>
								<p class="availability">Available 24/7, Same day return calls</p>
							</div>
						</div><!-- .col 3 -->
					</div><!-- .cols3 -->
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					</nav><!-- #site-navigation -->
				</div><!-- .grid-container -->
			</div><!-- .primary-header -->

		<!-- Header Code for all other Pages -->

		<?php } ?>
	</header><!-- .site-header -->

	<div id="content" class="site-content">
