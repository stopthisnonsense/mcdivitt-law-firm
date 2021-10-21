<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package McDivitt_Law_Firm
 */

?>

	</div><!-- #content -->
	<div class="prefooter-evaluation" style="display:none;">	
    <div class="section-header">
      <h2><span>Request a <strong>FREE</strong> Case Evaluation</span></h2>
    </div><!-- .section-header -->
		<div class="grid-container">
			
			<?php /*
			<!--[if lte IE 8]>
			<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
			<![endif]-->
			<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
			<script>
			  hbspt.forms.create({ 
			    css: '',
			    portalId: '1790085',
			    formId: 'd35a457b-129d-4378-abba-63d1b4000f88'
			  });
			</script>
			*/ ?>

			<?php //echo do_shortcode( '[gravityform id="2" title="false" description="true" ajax="true"]' ); ?>
			<?php echo do_shortcode( '[hsform id="d35a457b-129d-4378-abba-63d1b4000f88"]' ); ?>

		</div>
	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="grid-container change-width">
			<div class="cols cols4">
				<div class="col footer-left-menu">
					<h4><a href="/">HOME</a></h4><br>
					<h4><a href="/about">ABOUT US</a></h4><br>
					<h4><a href="/attorneys">ATTORNEYS</a></h4><br>
					<h4><a href="/blog">RESOURCES</a></h4><br>
					<h4><a href="/careers">CAREERS</a></h4><br>
					<!-- <?php wp_nav_menu( array( 'theme_location' => 'sitemap' ) ); ?> -->
				</div><!-- .col -->
				
				<div class="col">
					<h4>CASES WE HANDLE</h4>
					<?php wp_nav_menu( array( 'theme_location' => 'practice-areas' ) ); ?>
				</div><!-- .col -->
				
				<div class="col colspan2 edit-width">
					<h4>OUR LOCATIONS</h4>
					<div class="branch-location"><strong><a href="/locations/colorado-springs" title="Colorado Springs | McDivitt Law Firm">Colorado Springs</a></strong><br>19 E Cimarron St<br>Colorado Springs, CO 80903 <br><span>Phone</span>: <a href="tel:719-471-3700" rel="nofollow">719-471-3700</a></div>
					
					<div class="branch-location"><strong><a href="/locations/aurora" title="Aurora | McDivitt Law Firm">Aurora</a></strong><br>14261 E 4th Ave <br>Ste 300 <br>Aurora, CO 80011 <br><span>Phone</span>: <a href="tel:303-343-7910" rel="nofollow">303-343-7910</a></div>
					
					<div class="branch-location"><strong><a href="/locations/pueblo" title="Pueblo | McDivitt Law Firm">Pueblo</a></strong><br>409 N Grand Ave <br>Suite D <br>Pueblo, CO 81003 <br><span>Phone</span>: <a href="tel:719-542-3700" rel="nofollow">719-542-3700</a></div>
					<div class="branch-location"><strong><a href="/locations/denver" title="Denver | McDivitt Law Firm">Denver</a></strong><br>	1777 S Harrison St <br>Denver, CO 80210 <br><span>Phone</span>: <a href="tel:303-396-6474" rel="nofollow">303-396-6474</a></div>
					
				</div><!-- .col -->
			</div><!-- .cols4 -->
			<hr>
			<div class="cols cols3">
				<div class="col colspan2">
					<h1 class="logo-link">
						<a title="McDivitt Law Firm" rel="home" href="/">
							<span class="logo">McDivitt Law Firm</span>
						</a>
					</h1>
					<!-- <?php wp_nav_menu( array( 'theme_location' => 'quick-links' ) ); ?> -->
					<p class="copyright">Copyright &copy; <?php echo date('Y', time()); ?> McDivitt Law Firm Colorado. All Rights Reserved.	<br />
						New Server
					</p><br>
					<div class="footer-social-icons">
						<a href="https://www.facebook.com/McDivittLaw/" target="_blank"><i class="fa fa-facebook"></i> <span class="txt">Facebook</span></a>			
						<a href="https://twitter.com/McDivittLaw/" target="_blank"><i class="fa fa-twitter"></i> <span class="txt">Twitter</span></a>
						<a href="https://www.instagram.com/mcdivitt_law_firm/" target="_blank"><i class="fa fa-instagram"></i> <span class="txt">Instagram</span></a>
						<a href="https://www.youtube.com/user/McDivittLaw" target="_blank"><i class="fa fa-youtube"></i> <span class="txt">YouTube</span></a>
					</div>
				</div>
				<div class="col">
					<div class="free-consultation">
						<p class="cta">Call now for a <strong><span>FREE</span> Consultation</strong></p>
						<a class="number" href="tel:719-471-3700" rel="nofollow">719-471-3700</a>
						<p class="availability">Available 24/7, Same day return calls</p>
					</div>
				</div>
			</div>
		</div><!-- .grid-container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/nwmatcher/1.4.0/nwmatcher.min.js"></script>

<!--[if (gte IE 6)&(lte IE 8)]>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js" type="text/javascript"></script>
<![endif]-->

  <script>
     WebFontConfig = {
       google: {
           families: ['Montserrat:300,300i,400,400i,500,500i', 'Raleway:300,300i,400,400i,500,500i,600,600i,800,800i']
         }
     };

     (function(d) {
        var wf = d.createElement('script'), s = d.scripts[0];
        wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
        wf.async = true;
        s.parentNode.insertBefore(wf, s);
     })(document);
  </script>

<?php
/*
<!-- chat start-->
	<script>
 var APP_ID = "wicjsfso";
  window.intercomSettings = {
    app_id: APP_ID,
	custom_launcher_selector:'.chat-launcher a'
  };
</script>

<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/' + APP_ID;var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>

 <!-- chat end -->
*/
?>

  <script type="text/javascript">
	  jQuery(document).ready(function($) {
		  $('a[href*="mcdivittlaw.com/download-free-auto-accident-toolkit"]').remove();
		  
		  jQuery('.header-search i').click(function(){			  
			  if(jQuery('.header-search form input').val() == ""){				  
				  jQuery('.header-search form').removeClass("d-none");
				  jQuery('.header-search form input').val('');
			  } else{
				  jQuery('.header-search form button').trigger( "click" );
			  }
		  });
		  
			jQuery('.car-crash h2, .car-crash .img-section').click(function(){
				jQuery('.popup-div .popup-contents').html('<h4>'+ jQuery('.car-crash h2').html() +'</h4><p>'+ jQuery('.car-crash .para-line-3').html() +'</p>');
				showPopup();
			});
			jQuery('.medical-treatment h2, .medical-treatment .img-section').click(function(){
				jQuery('.popup-div .popup-contents').html('<h4>'+ jQuery('.medical-treatment h2').html() +'</h4><p>'+ jQuery('.medical-treatment .para-line-3').html() +'</p>');
				showPopup();
			});
			jQuery('.intake h2, .intake .img-section').click(function(){
				jQuery('.popup-div .popup-contents').html('<h4>'+ jQuery('.intake h2').html() +'</h4><p>'+ jQuery('.intake .para-line-3').html() +'</p>');
				showPopup();
			});
			jQuery('.sign-up h2, .sign-up .img-section').click(function(){
				jQuery('.popup-div .popup-contents').html('<h4>'+ jQuery('.sign-up h2').html() +'</h4><p>'+ jQuery('.sign-up .para-line-3').html() +'</p>');
				showPopup();
			});
			jQuery('.legal-team h2, .legal-team .img-section').click(function(){
				jQuery('.popup-div .popup-contents').html('<h4>'+ jQuery('.legal-team h2').html() +'</h4><p>'+ jQuery('.legal-team .para-line-3').html() +'</p>');
				showPopup();
			});
			jQuery('.release-treatment h2, .release-treatment .img-section').click(function(){
				jQuery('.popup-div .popup-contents').html('<h4>'+ jQuery('.release-treatment h2').html() +'</h4><p>'+ jQuery('.release-treatment .para-line-3').html() +'</p>');
				showPopup();
			});
			jQuery('.demand-package h2, .demand-package .img-section').click(function(){
				jQuery('.popup-div .popup-contents').html('<h4>'+ jQuery('.demand-package h2').html() +'</h4><p>'+ jQuery('.demand-package .para-line-3').html() +'</p>');
				showPopup();
			});
			jQuery('.settlement h2, .settlement .img-section').click(function(){
				jQuery('.popup-div .popup-contents').html('<h4>'+ jQuery('.settlement h2').html() +'</h4><p>'+ jQuery('.settlement .para-line-3').html() +'</p>');
				showPopup();
			});
			jQuery('.going-trial h2, .going-trial .img-section').click(function(){
				jQuery('.popup-div .popup-contents').html('<h4>'+ jQuery('.going-trial h2').html() +'</h4><p>'+ jQuery('.going-trial .para-line-3').html() +'</p>');
				showPopup();
			});
		  
		  jQuery('.popup-div').click(function(){
			  jQuery(this).hide();
		  });
	  });
	function showPopup(){
		jQuery('.popup-div').css('display', 'inline-flex');
	}
	jQuery(document).mouseup(function(e) 
	{
		var container = jQuery(".header-search");
		// if the target of the click isn't the container nor a descendant of the container
		if (!container.is(e.target) && container.has(e.target).length === 0) 
		{
			closeSearch();
		}
	});
	  function closeSearch(){
		  jQuery(".header-search form").addClass("d-none");
		  jQuery('.header-search form input').val('');
	  }
  </script>

</body>
</html>
