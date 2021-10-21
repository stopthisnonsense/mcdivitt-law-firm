<?php //McRibbit Page ?>
<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="grid-container">
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="mcribbit-intro">
						<h1>What’s with the <br>McDivitt Law Firm Frog?</h1>
						<p>If you’ve seen an ad on TV for McDivitt Law Firm and wondered why a frog shows up at the end, then you’re at the right place.</p>
						<div class="frog"></div>				
					</div>

					<?php //content ?>
					<div class="basic-content">

						<p class="psection"><span class="lg-blue">In March, 2018</span>, McDivitt Law Firm unveiled a mascot to help Coloradoans remember who to call in a time of need. At the end of the McDivitt ads, a frog in a bow tie hops into the screen to say, “McDivitt” (instead of “ribbit”).</p>

						<div class="callout-box psection">
							The genesis for the McDivitt Law Firm Frog came from feedback from people searching for an attorney. In Colorado, the airwaves are flooded with ads from attorneys, and it can be hard to know who to call.
						</div>

						<div class="psection">
							<img src="https://mcdivittlaw.com/wp-content/uploads/mcdivitt-team.jpg" alt="McDivitt Team" class="alignright">
							<h2>Personalized, Friendly Legal Service</h2>
							<p>McDivitt Law Firm offers an extremely valuable service to people who have been injured in auto accidents, or on the job, through no fault of their own. McDivitt's PI attorneys take on insurance companies and fight to get their clients the medical treatment, benefits, and compensation they’re due after suffering injuries.</p>
							<p>The attorneys at McDivitt know that the service offered by its state-wide firm gives clients the kind of personalized attention that makes a difference during such a difficult time. The family-owned firm’s team of <a href="<?php echo home_url(); ?>/attorneys"><strong>more than 80 professionals</strong></a> provides this personal attention along with a deep wealth of knowledge, experience, and resources.</p>
							<p>While McDivitt aims to provide information to viewers who see the ads on TV, the firm also knows how difficult it can be to choose a lawyer, let alone know who to research in the first place. <strong>The name "McDivitt" is not a common one, so it can be tricky to say and hard to remember</strong>.</p>
						</div>

						<div class="new-testimonial psection">
							<div class="quote">
								"I like my name, but a lot of people have trouble remembering the name, and that concerns me. I want people to know and remember who we are.""
							</div>
							<div class="quote-author">
								Mike McDivitt, Attorney and CEO
							</div>

							<span class="fa fa-quote-left"></span>
							<span class="fa fa-quote-right"></span>
						</div>

						<div class="frog-excerpt psection">
							When someone mentioned that the name "McDivitt" sounds a lot like "ribbit", the firm decided to try something new to help people know who to look up when they have questions about their legal rights. That's where the frog came from! 
						</div>

						<div class="psection cf">
							<div class="video" style="float: right;">
								<?php /* <iframe src="https://player.vimeo.com/video/257801765" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> */ ?>
								<iframe width="560" height="315" src="https://www.youtube.com/embed/z66TGIPOozk?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
							<p><span class="lg-gray">"We think he's a cute frog, and even a little bit classy,"</span> said Karen McDivitt, President of the firm, who oversees the administrative side. "We wanted something that both caught the attention of the viewing public, and stood for who we are, which is an approachable, family firm."</p>
							<p>The legal complexities involved in an auto accident case can be daunting, and the team at McDivitt understands the pain and frustration that its clients go through on a daily basis as they try to pick up the pieces from injuries and losses.</p>
							<p>"We are a law firm with experience. That part is a given,” said David McDivitt, attorney and COO of McDivitt Law Firm. “But our core purpose is to help our clients rebuild their lives. That’s a successful day for us, when we help a family make it through feeling hopeless, to providing them with the money they need to pay their bills, get their medical treatment, and get back to living."</p>
							<p>McDivitt aims to have every resident in Colorado know the firm's name, and the services it provides. The law firm works on a contingency fee basis, so no money is owed until a settlement is reached on behalf of its clients.</p>
							<p>If you (or someone you know) have questions about your legal rights following an accident, please don’t hesitate to reach out to the team at McDivitt. Its specialists are available 24/7, and if you are unable to meet an attorney at one of the five McDivitt Law Firm locations, an intake specialist or attorney will go to you.</p>
							<p>As Mike McDivitt said, "We are a firm for the people of Colorado. It is our goal to make sure everyone knows they have the right to an attorney and they are not alone in the fight to get their lives back on track."</p>
							<div class="clear"></div>
						</div>

					</div>

				<?php endwhile; // End of the loop. ?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
