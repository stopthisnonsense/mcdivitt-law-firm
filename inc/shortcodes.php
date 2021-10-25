<?php

/**
 *	Box CTA
 *	Shortcode injects the box-cta style
 *	which essentially supports a single line of text
 *	and a button.
 *
 */
function do_boxcta_shortcode( $atts, $content = false ) {

	//if not content was supplied, we can't use this shortcode
	if( empty($content) )
		return '<!-- No content supplied. Cannot use boxcta shortcode -->';

	$atts = shortcode_atts(array(
		'button' => 'Go',
		'url' => ''
	), $atts);

	//validate url
	if( ! filter_var( $atts['url'], FILTER_VALIDATE_URL ) )
		return '<!-- Invalid url supplied. Cannot use boxcta shortcode -->';

	//build output
	$output = '<div class="box-cta">';
		$output .= $content . ' <a href="' . $atts['url'] . '" class="button-red">' . $atts['button'] . '</a>';
	$output .= '</div>';

	//done
	return $output;
}

add_shortcode( 'boxcta', 'do_boxcta_shortcode' );

/**
 *	Practice Areas
 *
 *	Lists Practice Areas out with icons. Data managed
 *	via ACF on Practice Areas page.
 */
function mcd_practice_areas_shortcode( $atts, $content = false, $tag ) {

	//if no practice area data, do nothing
	if( ! have_rows('practice_areas') )
		return;

	$output = '<div class="grid-container">';
		$output .= '<div class="practice-areas-list">';
			while( have_rows('practice_areas') ) : the_row();
				$img = get_sub_field('pa_icon');

				$output .= '<div class="practice-area">';
					$output .= '<div class="img">';
						$output .= '<img src="' . @$img['url'] . '" alt="' . @$img['alt'] . '">';
					$output .= '</div>';
					$output .= '<div class="title">';
						$output .= get_sub_field('pa_title');
					$output .= '</div>';
					$output .= '<a class="learn-more" href="' . get_sub_field('pa_url') . '">Learn More</a>';
				$output .= '</div>';

			endwhile;
		$output .= '</div>';
	$output .= '</div>';

	return $output;
}

add_shortcode( 'practice-areas', 'mcd_practice_areas_shortcode' );

/**
 *	Defective Drugs
 *
 *	Prints the defective drugs out
 */
function mcd_defective_drugs_shortcode( $atts, $content = false, $tag ) {

	$atts = shortcode_atts([
		'title1' => 'Defective Drugs &amp; Devices',
		'title2' => 'McDivitt has previously assisted clients with these cases but are no longer taking new cases.'
	], $atts);

	//get child pages of the defective drug page
	$drugs = get_posts([
		'post_parent' => 12027,
		'post_type' => 'page',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'post__not_in' => [ 13254, 12038, 12126, 12160, 12266 ],
		'orderby' => 'title',
		'order' => 'ASC'
	]);

	$drugs2 = get_posts([
		'post_parent' => 12027,
		'post_type' => 'page',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'post__not_in' => [ 13254 ],
		'post__in' => [ 12038, 12126, 12160, 12266 ],
		'orderby' => 'title',
		'order' => 'ASC'
	]);

	if( empty($drugs) )
		return;

	if( empty($drugs2) )
		return;

	//split into two even columns
	$cols = array_chunk($drugs, ceil(count($drugs)/2));
	$cols2 = array_chunk($drugs2, ceil(count($drugs2)/2));

	$output = '<div class="defective-drugs-list">';
		$output .= '<h3>' . $atts['title1'] . '</h3>';
		$output .= '<div class="list-wrap">';
			foreach( $cols as $drugs ) :
				$output .= '<ul class="list">';
					foreach( $drugs as $drug ) :
						$output .= '<li>';
							$output .= '<a href="' . get_permalink($drug->ID) . '">' . apply_filters('the_title', $drug->post_title) . '</a>';
						$output .= '</li>';
					endforeach;
				$output .= '</ul>';
			endforeach;
		$output .= '</div>';
		$output .= '<h3 style="font-size:22px; max-width:720px; margin:60px auto 30px auto;">' . $atts['title2'] . '</h3>';
		$output .= '<div class="list-wrap">';
			foreach( $cols2 as $drugs2 ) :
				$output .= '<ul class="list">';
					foreach( $drugs2 as $drug ) :
						$output .= '<li>';
							$output .= '<a href="' . get_permalink($drug->ID) . '">' . apply_filters('the_title', $drug->post_title) . '</a>';
						$output .= '</li>';
					endforeach;
				$output .= '</ul>';
			endforeach;
		$output .= '</div>';
	$output .= '</div>';

	return $output;
}

add_shortcode( 'defective-drugs', 'mcd_defective_drugs_shortcode' );

/**
 *  [bluehr]
 *  Blue horizontal rule
 *
 */
function mcdivitt_blue_hr_shortcode( $atts, $content = "" ) {

	return '<hr class="hr-blue" />';

}

add_shortcode( 'bluehr', 'mcdivitt_blue_hr_shortcode' );

/**
 * [testimonial]
 *
 */
function mcdivitt_testimonial_shortcode( $atts, $content = false ) {

	if( ! $content || empty($content) )
		return "";

	$output = '<div class="new-testimonial">';
		$output .= '<div class="quote">';
			$output.= $content;
		$output .= '</div>';
		$output .= '<div class="quote-author">';
			$output .= '<div class="quote-icon quote-icon-left"></div><div class="quote-icon quote-icon-right"></div>';
		$output .= '</div>';
		$output .= '<span class="fa fa-quote-left"></span>';
		$output .= '<span class="fa fa-quote-right"></span>';
	$output .= '</div>';

	return $output;
}

add_shortcode( 'testimonial', 'mcdivitt_testimonial_shortcode' );

/**
 *  [blue-button]
 *  Blue button
 *
 */
function mcdivitt_blue_button_shortcode( $atts, $content = "Button" ) {

	//
	$content = trim( str_replace(['<p>', '</p>'], "", $content) );

	//
	$atts = shortcode_atts([
		'url' => '#',
		'target' => ''
	], $atts);

	//force content
	if( ! $content || $content == '' )
		$content = 'Button';

	//return
	return '<a href="' . $atts['url'] . '" class="btnblue" target="' . $atts['target'] . '">' . $content . '</a>';
}

add_shortcode( 'blue-button', 'mcdivitt_blue_button_shortcode' );
//add_shortcode( 'blue_button', 'mcdivitt_blue_button_shortcode' );

/**
 * careers
 * Output custom content to the careers page
 *
 */
function mcdivitt_shortcode_careers( $atts, $content = "" ) {

	$output = '</div>';	//close the inner div

	ob_start();
		get_template_part('template-parts/careers');
	$output .= ob_get_contents();
	ob_end_clean();

	$output .= '<div class="inner wysiwyg cf">';	//reopen inner div

	return $output;

}

add_shortcode('careers', 'mcdivitt_shortcode_careers');


function print_menu_shortcode($atts, $content = null) {
	extract(shortcode_atts(array( 'name' => null, 'class' => null ), $atts));
	return wp_nav_menu( array( 'menu' => $name, 'menu_class' => $class, 'echo' => false ) );
	}

	add_shortcode('menu', 'print_menu_shortcode');


function callout_box_shortcode( $atts = [], $content = null, $tag = '' ) {
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );

	$callout_box = '<div class="callout-box">';

	if ( !is_null( $content ) ) {
		$callout_box .= apply_filters( 'the_content', $content, 99 );
		// $callout_box .= do_shortcode( $content );
	}

	$callout_box .= '</div>';

	return $callout_box;
}

function testimonial_shortcode( $atts = [], $content = null, $tag = '' ) {
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );

	$testimonial = '<div class="new-testimonial">';

	if( !is_null( $content ) ) {
		$testimonial .= '<div class="quote">';
		$testimonial .= apply_filters( 'the_content', $content, 99 );
		// $testimonial .= do_shortcode( $content );
		$testimonial .= '</div>';
	}

	$testimonial_atts = shortcode_atts( array( 'author' => '' ), $atts, $tag );

	if( $testimonial_atts['author'] !== '' ) {
		$testimonial .= '<div class="quote-author">';
		$testimonial .= esc_html__( $testimonial_atts['author'], 'testimonial' );
		$testimonial .= '</div>';
	}

	$testimonial .= '</div>';

	return $testimonial;


}

function frog_excerpt_shortcode( $atts = [], $content = null, $tag = '' ) {
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );

	$frog_box = '<div class="frog-excerpt">';

	if ( !is_null( $content ) ) {
		$frog_box .= apply_filters( 'the_content', $content, 99 );
		// $frog_box .= do_shortcode( $content );
	}

	$frog_box .= '</div>';

	return $frog_box;
}

add_shortcode('callout_box', 'callout_box_shortcode');
	add_shortcode('testimonial', 'testimonial_shortcode');
	add_shortcode( 'frog_excerpt', 'frog_excerpt_shortcode' );
