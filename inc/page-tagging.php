<?php

/**
 *	Tag Pages
 *	This file adds the ability to tag pages
 *	via a custom taxonomy. This helps organize
 *	large groups of pages.
 *
 */

add_action( 'init', 'Magneti_Page_Tagging::register_tax' );

add_action('restrict_manage_posts', 'Magneti_Page_Tagging::tsm_filter_post_type_by_taxonomy');
add_filter('parse_query', 'Magneti_Page_Tagging::tsm_convert_id_to_term_in_query');


//
class Magneti_Page_Tagging {

	/**
	 *	register_tax
	 *
	 *	Register custom taxonomy needed
	 *
	 */
	public static function register_tax() {

		// Register Custom Taxonomy

		$labels = array(
			'name'                       => _x( 'Page Tags', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Page Tag', 'Taxonomy Singular Name', 'text_domain' )
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => false,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
		);

		register_taxonomy( 'page_tag', array( 'page' ), $args );
	}

	/**
	 * Display a custom taxonomy dropdown in admin
	 * @author Mike Hemberger
	 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
	 */
	function tsm_filter_post_type_by_taxonomy() {
		global $typenow;

		$post_type = 'page'; // change to your post type
		$taxonomy  = 'page_tag'; // change to your taxonomy

		if($typenow == $post_type) {
			$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => __("Show All {$info_taxonomy->label}"),
				'taxonomy'        => $taxonomy,
				'name'            => $taxonomy,
				'orderby'         => 'name',
				'selected'        => $selected,
				'show_count'      => true,
				'hide_empty'      => true,
			));
		};
	}

	/**
	 * Filter posts by taxonomy in admin
	 * @author  Mike Hemberger
	 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
	 */
	function tsm_convert_id_to_term_in_query($query) {
		global $pagenow;

		if( ! is_admin() )
			return $query;

		$post_type = 'page'; // change to your post type
		$taxonomy  = 'page_tag'; // change to your taxonomy
		$q_vars    = &$query->query_vars;
		if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}

}