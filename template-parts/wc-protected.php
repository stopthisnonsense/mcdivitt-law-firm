<?php 

//ensure the password has been entered
if( post_password_required() )
	return;

//get wc articles
$wc_articles = get_field('wc_articles');

//if we have no articles...
if( empty($wc_articles) )
	return;

?>

<div class="grid-container">
	<div class="wc-articles-wrap">
		<div class="inner">

			<?php foreach( $wc_articles as $article ) : ?>
				<div class="wc-article">

					<div class="wc-article-title">
						<div class="wc-title-icon">
							<span class="wc-open-icon">+</span>
							<span class="wc-close-icon">-</span>
						</div>
						<h2><?php echo $article['wc_article_title']; ?></h2>
						<div class="wc-article-date"><?php echo $article['wc_article_date']; ?></div>
					</div>

					<div class="wc-article-content">
						<?php echo $article['wc_article_content']; ?>
					</div>

				</div>
			<?php endforeach; ?>

		</div>
	</div>
</div>

<script>
jQuery(document).ready(function($) {

	//track the open article
	var _opened = false;

	//
	$('.wc-article').each(function() {

		var ele = $(this);

		//
		ele.find('.wc-article-title').on('click', function(evt) {
			evt.preventDefault();

			//close others if opened
			if( _opened && _opened !== ele ) {
				_opened.removeClass('expanded');
				_opened = false;
			}

			//
			ele.toggleClass('expanded');

			//if opened, save
			if( ele.is('.expanded') ) {
				_opened = ele;
			}
		});

	});

});
</script>