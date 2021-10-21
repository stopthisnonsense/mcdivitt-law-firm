<?php

ini_set("auto_detect_line_endings", true);

//
add_action( 'admin_init', '__fix_broken_links_in_content' );

//
function __fix_broken_links_in_content() {
	global $wpdb;

	//check for query var
	if( ! isset($_GET['fix-broken-links']) )
		return;

	//parse csv file
	$csv = array_map('str_getcsv', file(get_template_directory() . '/inc/mcdivitt-broken-links.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));

	$failures = 0;

	//iterate
	foreach( $csv as $set ) {

		$old = "https://mcdivittlaw.com" . $set[0] . "\"";
		$new = rtrim( "https://mcdivittlaw.com" . $set[1], '/' ) . "\"";

		//build query
		$query = "
			UPDATE $wpdb->posts
			SET `post_content` = replace(post_content, '$old', '$new')
		";

		//run query
		$result = $wpdb->query( $query );

		if( $result === false )
			$failures++;

	}

	die( "Failures: " . $failures );
}

function __debug( $data ) {
	echo '<pre>';
		print_r( $data );
	echo '</pre>';
	exit;
}