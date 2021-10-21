<?php
/**
 *	Water Cases Form Page
 *
 * 	A placeholder for the Water Cases referral 
 * 	campaign.
 */

?>
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

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/library/css/libs/pickadate/default.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/library/css/libs/pickadate/default.date.css">

<?php //attempt to hide chat ?>
<style type="text/css">
#apexchat_invitation_container_minimized_wrapper,
#apexchat_tab_bar_parent { display: none !important; }
#apexchat_invitation_container_wrapper { left: -100vw !important; opacity: 0 !important; visibility: hidden !important; display: none !important; }
</style>



<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>

	<div id="page">

			<?php //top section ?>
			<div class="top-section">
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

				</div>
			</div>

			<?php //content ?>
			<div class="content-section">
				<div class="inner">

					<?php if( ! isset($_GET[WC_FORM_REFERRAL_KEY]) ) : ?>
						<div id="wc-referral-form" class="txt-center">
							<h3>Please enter your referral number</h3>

							<form action="<?php echo get_permalink(WC_FORM_PAGE_ID); ?>" method="GET" id="wc-referral-number">
								<input type="text" name="<?php echo WC_FORM_REFERRAL_KEY; ?>" value="" style="width: 400px; max-width: 100%;"><br><br>
								<input type="submit" value="Continue">
							</form>
						</div>
					<?php endif; ?>

					<?php if( isset($_GET[WC_FORM_REFERRAL_KEY]) ) : ?>
						<div id="wc-form-wrap" class="">

							<?php
								//attempt to look up referral
								$case_number = filter_var( $_GET[WC_FORM_REFERRAL_KEY], FILTER_SANITIZE_STRING );

								$wc = new McD_WC_Form();
								$cases = $wc->lookup( $case_number );

							?>

							<form action="#" method="POST" id="wc-form">

								<div class="group">
									<h2>Please fill out the form below</h2>
									<p>McDivitt Law Firm is updating our files and want to make sure that we have all of your injuries. Can you please let us know if you have or had any of the following injuries and/or illness.  If you or your dependent’s name on this form is inaccurate please contact our office immediately to verify our information is correct.</p>
									<p>Thank you for your cooperation in this matter.</p>
								</div>

								<div class="group">
									Name:<br>
									<strong class="dname"><?php echo @$cases[0]['FNAME'] . ' ' . @$cases[0]['LNAME'] ?></strong>
								</div>

								<div class="group">
									<div class="q">Have you been diagnosed with any of the following? Select all that apply and include the date of diagnosis, even if you have previously disclosed the same diagnosis to us.</div>

									<div class="row row-header">
										<div class="item">&nbsp;</div>
										<label>No</label>
										<label>Yes</label>
										<div class="date-inp-header">Date of Diagnosis</div>
									</div>

									<div class="row">
										<div class="item">Kidney Cancer</div>
										<label><span class="txt">No</span> <input type="radio" name="kc[0]" value="no"></label>
										<label><span class="txt">Yes</span> <input type="radio" name="kc[0]" value="yes"></label>
										<input type="text" name="kc_date[0]" class="date-inp">
										<div class="msgs"></div>
									</div>

									<div class="row">
										<div class="item">Testicular Cancer</div>
										<label><span class="txt">No</span> <input type="radio" name="tc[0]" value="no"></label>
										<label><span class="txt">Yes</span> <input type="radio" name="tc[0]" value="yes"></label>
										<input type="text" name="tc_date[0]" class="date-inp">
										<div class="msgs"></div>
									</div>

									<div class="row">
										<div class="item">Ulcerative Colitis</div>
										<label><span class="txt">No</span> <input type="radio" name="uc[0]" value="no"></label>
										<label><span class="txt">Yes</span> <input type="radio" name="uc[0]" value="yes"></label>
										<input type="text" name="uc_date[0]" class="date-inp">
										<div class="msgs"></div>
									</div>

									<div class="row">
										<div class="item">Thyroid Disease</div>
										<label><span class="txt">No</span> <input type="radio" name="td[0]" value="no"></label>
										<label><span class="txt">Yes</span> <input type="radio" name="td[0]" value="yes"></label>
										<input type="text" name="td_date[0]" class="date-inp">
										<div class="msgs"></div>
									</div>

									<div class="row">
										<div class="item">Pregnancy Induced Hypertension (including Preeclampsia)</div>
										<label><span class="txt">No</span> <input type="radio" name="pg[0]" value="no"></label>
										<label><span class="txt">Yes</span> <input type="radio" name="pg[0]" value="yes"></label>
										<input type="text" name="pg_date[0]" class="date-inp">
										<div class="msgs"></div>
									</div>

									<div class="row">
										<div class="item">Hypercholesterolemia (High Cholesterol)</div>
										<label><span class="txt">No</span> <input type="radio" name="hc[0]" value="no"></label>
										<label><span class="txt">Yes</span> <input type="radio" name="hc[0]" value="yes"></label>
										<input type="text" name="hc_date[0]" class="date-inp">
										<div class="msgs"></div>
									</div>

								</div>

								<div class="group">
									<div class="q">Have you received any other diagnosis not listed above?</div>
									<textarea name="otherd[0]"></textarea>
								</div>

								<div class="group">
									<div class="q">Please provide the Physician information: name, address and phone number, for all injuries that you noted above.</div>
									<textarea name="dr[0]" rows="8"></textarea>
								</div>

								<?php //case number ?>
								<input type="hidden" name="rnumber[0]" value="<?php echo $cases[0]['CASENUM']; ?>">

								<?php if( count($cases) > 1 ) : ?>
									<?php foreach( $cases as $i => $case ) : ?>
										<?php if( $i < 1 ) continue; //skip the first ?>

										<div style="height: 50px;"></div>

										<div class="group">
											<div class="q">Please provide details for your dependent.</div>
											Name of Dependent:<br> <strong class="dname"><?php echo @$case['FNAME'] . ' ' . @$case['LNAME'] ?></strong>
										</div>

										<div class="group">
											<div class="q">Has your dependent been diagnosed with any of the following? Select all that apply and include the date of diagnosis, even if you have previously disclosed the same diagnosis to us.</div>

											<div class="row row-header">
												<div class="item">&nbsp;</div>
												<label>No</label>
												<label>Yes</label>
												<div class="date-inp-header">Date of Diagnosis</div>
											</div>

											<div class="row">
												<div class="item">Kidney Cancer</div>
												<label><span class="txt">No</span> <input type="radio" name="kc[<?php echo $i; ?>]" value="no"></label>
												<label><span class="txt">Yes</span> <input type="radio" name="kc[<?php echo $i; ?>]" value="yes"></label>
												<input type="text" name="kc_date[<?php echo $i; ?>]" class="date-inp">
												<div class="msgs"></div>
											</div>

											<div class="row">
												<div class="item">Testicular Cancer</div>
												<label><span class="txt">No</span> <input type="radio" name="tc[<?php echo $i; ?>]" value="no"></label>
												<label><span class="txt">Yes</span> <input type="radio" name="tc[<?php echo $i; ?>]" value="yes"></label>
												<input type="text" name="tc_date[<?php echo $i; ?>]" class="date-inp">
												<div class="msgs"></div>
											</div>

											<div class="row">
												<div class="item">Ulcerative Colitis</div>
												<label><span class="txt">No</span> <input type="radio" name="uc[<?php echo $i; ?>]" value="no"></label>
												<label><span class="txt">Yes</span> <input type="radio" name="uc[<?php echo $i; ?>]" value="yes"></label>
												<input type="text" name="uc_date[<?php echo $i; ?>]" class="date-inp">
												<div class="msgs"></div>
											</div>

											<div class="row">
												<div class="item">Thyroid Disease</div>
												<label><span class="txt">No</span> <input type="radio" name="td[<?php echo $i; ?>]" value="no"></label>
												<label><span class="txt">Yes</span> <input type="radio" name="td[<?php echo $i; ?>]" value="yes"></label>
												<input type="text" name="td_date[<?php echo $i; ?>]" class="date-inp">
												<div class="msgs"></div>
											</div>

											<div class="row">
												<div class="item">Pregnancy Induced Hypertension (including Preeclampsia)</div>
												<label><span class="txt">No</span> <input type="radio" name="pg[<?php echo $i; ?>]" value="no"></label>
												<label><span class="txt">Yes</span> <input type="radio" name="pg[<?php echo $i; ?>]" value="yes"></label>
												<input type="text" name="pg_date[<?php echo $i; ?>]" class="date-inp">
												<div class="msgs"></div>
											</div>

											<div class="row">
												<div class="item">Hypercholesterolemia (High Cholesterol)</div>
												<label><span class="txt">No</span> <input type="radio" name="hc[<?php echo $i; ?>]" value="no"></label>
												<label><span class="txt">Yes</span> <input type="radio" name="hc[<?php echo $i; ?>]" value="yes"></label>
												<input type="text" name="hc_date[<?php echo $i; ?>]" class="date-inp">
												<div class="msgs"></div>
											</div>

										</div>

										<div class="group">
											<div class="q">Has your dependent received any other diagnosis not listed above?</div>
											<textarea name="otherd[<?php echo $i; ?>]"></textarea>
										</div>

										<div class="group">
											<div class="q">Please provide the Physician information: name, address and phone number, for all injuries that you noted above.</div>
											<textarea name="dr[<?php echo $i; ?>]" rows="8"></textarea>
										</div>

										<?php //case number ?>
										<input type="hidden" name="rnumber[<?php echo $i; ?>]" value="<?php echo $case['CASENUM']; ?>">

									<?php endforeach; ?>
								<?php endif; ?>

								<div class="group">
									<div class="msgs" id="mmsg"></div>
									<input type="submit" value="Submit">
								</div>

								<input type="hidden" name="action" value="wcform">
							</form>

						</div>
					<?php endif; ?>

				</div>
			</div>

	<?php //footer will close #page ?>
	<?php get_footer(); ?>

	<script src="<?php bloginfo('template_directory'); ?>/library/js/libs/picker.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($) {

		$('.date-inp').pickadate({
			format: 'mmm d, yyyy',
			max: new Date(),
			selectMonths: true,
			selectYears: true
		});

		$('#wc-form').on('submit', function(evt) {
			evt.preventDefault();

			var form = $(this);

			//clear error messages
			form.find('.msgs').hide().html('');

			//validate radio buttons
			var err = false;

			form.find('.row').each(function() {

				var row = $(this),
					opts = row.find('input[type=radio]');

				if( opts.length < 1 )
					return true;

				//ensure one of the opts is selected
				if( opts.filter(':checked').length < 1 ) {
					row.find('.msgs').html('Please make a selection.').show();
					err = true;
				}

			});

			//if errors, do not submit
			if( err ) {
				$('#mmsg').html('Please correct errors before submitting.').show();
				return false;
			}

			$.ajax({
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				method: 'POST',
				data: form.serialize(),
				success: function( response ) {
					console.log( response );

					if( ! response.code || response.code != 200 || ! response.redirect ) {
						$('#mmsg').html('An unexpected error has occured. Please try again.').show();
					}

					//redirect
					window.location = response.redirect;
					return;

				}
			});

			return false;
		});

	});
	</script>

</body>
</html>