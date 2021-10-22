<?php
/**
 * McDivitt Law Firm functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package McDivitt_Law_Firm
 */

//require_once('inc/broken-link-fixer.php');
require_once('inc/page-tagging.php');
require_once('inc/shortcodes.php');
require_once('inc/form-handler.php');
require_once('inc/wc-form.php');

require_once('inc/wc-protected.php');

if ( ! function_exists( 'mcdivitt_law_firm_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mcdivitt_law_firm_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on McDivitt Law Firm, use a find and replace
	 * to change 'mcdivitt-law-firm' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mcdivitt-law-firm', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Header: Main Navigation', 'mcdivitt-law-firm' ),
		'practice-areas' => esc_html__( 'Footer: Areas of Practice', 'mcdivitt-law-firm' ),
		'sitemap' => esc_html__( 'Footer: Sitemap', 'mcdivitt-law-firm' ),
		'quick-links' => esc_html__( 'Footer: Quick Links', 'mcdivitt-law-firm' ),
		'auto-accidents' => esc_html__( 'Sidebar: Auto Accident Resource Center', 'mcdivitt-law-firm' ),
		'workers-comp' => esc_html__( 'Sidebar: Workers&#39; Comp Resource Center', 'mcdivitt-law-firm' ),
    'motorcycle-accidents' => esc_html__( 'Sidebar: Motorcycle Accidents Resource Center', 'mcdivitt-law-firm' ),
    'truck-accidents' => esc_html__( 'Sidebar: Truck Accidents Resource Center', 'mcdivitt-law-firm' ),
    'wrongful-death' => esc_html__( 'Sidebar: Wrongful Death Resource Center', 'mcdivitt-law-firm' ),
    'mmad' => esc_html__( 'Sidebar: MMAD Video PSA', 'mcdivitt-law-firm' ),
    'metal-hip' => esc_html__( 'Sidebar: Metal Hip Replacement Resource Center', 'mcdivitt-law-firm' ),
    'gm-recall' => esc_html__( 'Sidebar: GM Vehicle Recall Resource Center', 'mcdivitt-law-firm' ),
    'transvaginal-mesh' => esc_html__( 'Sidebar: Transvaginal Mesh Resource Center', 'mcdivitt-law-firm' ),
    'zofran' => esc_html__( 'Sidebar: Zofran® Resource Center', 'mcdivitt-law-firm' ),
    'espanol' => esc_html__( 'Sidebar: Español Resource Center', 'mcdivitt-law-firm' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mcdivitt_law_firm_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'mcdivitt_law_firm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mcdivitt_law_firm_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mcdivitt_law_firm_content_width', 640 );
}
add_action( 'after_setup_theme', 'mcdivitt_law_firm_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mcdivitt_law_firm_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mcdivitt-law-firm' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mcdivitt-law-firm' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mcdivitt_law_firm_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mcdivitt_law_firm_scripts() {
	//wp_enqueue_style( 'mcdivitt-law-firm-style', get_stylesheet_uri(), array(), null );
	wp_enqueue_style( 'mcdivitt-law-firm-style', get_template_directory_uri() . '/library/css/style.min.css', array(), null );

	wp_enqueue_script( 'mcdivitt-law-firm-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20191584', true );

	wp_enqueue_script( 'mcdivitt-law-firm-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20191584', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mcdivitt_law_firm_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
/**
 * Declare the stylesheet to be used with the Wordpress Post/Page Editor.
 */
add_editor_style('style.css');

// Enable shortcodes in custom HTML widgets
add_filter('widget_custom_html_content','do_shortcode');

/* Allow shortcodes in widget areas */
add_filter('widget_text', 'do_shortcode');

/*
 * Set Text as Default Page/Post Editor on Load
 */
add_filter( 'wp_default_editor', create_function('', 'return "html";') );

// Truncate Yoast SEO breadcrumb title
add_filter('wp_seo_get_bc_title', function($link_text, $id) {
  if ( strlen( $link_text ) <= ($limit = 35) ) return $link_text;
  return substr( $link_text, 0, $limit ).'&hellip;';
}, 10, 2);

/**
 *	Add Body Class for Streaming pages
 *
 */
function mcdivitt_add_body_class_for_streaming( $classes ) {
	global $post;

	if( in_array($post->ID, [14079, 14081]) )
		$classes[] = 'home';

	return $classes;
}

add_filter( 'body_class', 'mcdivitt_add_body_class_for_streaming' );

/**
 * Disable Yoast SEO
 * Schema Markup
 *
 */
function disable_yoast_seo_schema_output( $data ) {

	//if the organization tag, omit
	if( strtolower($data['@type']) == 'organization' )
		return [];

	return $data;
}

add_filter( 'wpseo_json_ld_output', 'disable_yoast_seo_schema_output' );

/**
 *  exclude certain pages from search
 *
 */
function mcdivitt_exclude_certain_pages_from_search( $query ) {

	if( ! is_search() )
		return $query;

	$ids = [
		14079,
		14081,
		15255,
		15270,
		15273,
		15238,
		15212,
		13830
	];

	//exlcude certain pages
	$query->set( 'post__not_in', $ids );

	return $query;
}

add_filter( 'pre_get_posts', 'mcdivitt_exclude_certain_pages_from_search' );

/**
 *	__debug
 *
 *	Debug helper
 */
function __debug( $data, $die = true ) {

	echo '<pre>';
		print_r( $data );
	echo '</pre>';

	//
	if( $die ) exit;
}

/**
 * Remove Social Warfare shortcode
 * Remove PostRatings shortcode
 *
 */
function mcd_remove_social_warfare( $atts, $content = "" ) {
	//give nothing
	return "";
}

/*add_shortcode( 'ratings', 'mcd_remove_social_warfare' );*/
add_shortcode( 'social_warfare', 'mcd_remove_social_warfare' );

/*add_filter( 'wpcf7_form_elements', 'mycustom_wpcf7_form_elements' );

function mycustom_wpcf7_form_elements( $form ) {
  $form = do_shortcode( $form );
  return $form;
}
function shortcode_pageURL () {
	return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
add_shortcode('page_url_sc', 'shortcode_pageURL');*/


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


function ywpt_shortcodes() {
	add_shortcode('callout_box', 'callout_box_shortcode');
	add_shortcode('testimonial', 'testimonial_shortcode');
	add_shortcode( 'frog_excerpt', 'frog_excerpt_shortcode' );
}

add_action( 'init', 'ywpt_shortcodes' );
