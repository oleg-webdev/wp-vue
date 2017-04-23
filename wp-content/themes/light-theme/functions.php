<?php
require "plugin_deps/init.php";
require "includes/opitons.php";
require "menu/AMenu.php";
require "includes/media_links.php";

/**
 * ==================== Convert tables to utf8_unicode_ci ======================
 */
//add_action('admin_notices', 'aa_func_20172223122244');
function aa_func_20172223122244()
{
	global $wpdb;
	$set_encoding = "utf8_unicode_ci";
	$tables       = $wpdb->get_results( "SHOW TABLES" );
	$method       = "Tables_in_" . $wpdb->dbname;
	$messages     = "<div class='updated notice notice-success'><br>";
	foreach ( $tables as $table ) {
		$wpdb->query( "ALTER TABLE {$table->$method} DEFAULT CHARACTER SET utf8 COLLATE {$set_encoding};" );
		$wpdb->query( "ALTER TABLE {$table->$method} CONVERT TO CHARACTER SET utf8 COLLATE {$set_encoding};" );
		$messages .= "Table " . $table->$method . " has been converted to {$set_encoding}<br>";
	}
	$messages .= "<hr>Conversion complete. <br><br></div>";
	echo $messages;
}

add_filter( 'comment_form_fields', 'aa_func_20165127075134', 10, 1 );
function aa_func_20165127075134( $fields )
{
	$comment_field = $fields[ 'comment' ];
	unset( $fields[ 'comment' ] );
	$fields[ 'comment' ] = $comment_field;

	return $fields;
}

add_filter( 'comment_form_default_fields', 'aa_func_20165727075708', 10, 1 );
function aa_func_20165727075708( $fields )
{
	$fields[ 'url' ] = null;

	return $fields;
}

remove_action( 'comment_form', 'wp_comment_form_unfiltered_html_nonce' );

/**
 * Get Navigation
 */
function paged_navigation()
{
	if ( function_exists( 'wp_pagenavi' ) ) {
		wp_pagenavi();
	} else {
		echo "<div class='nav-previous'>" . previous_post_link( '&laquo; %link' ) . "</div><div class='nav-next'>" . next_post_link( '%link &raquo;' ) . "</div>";
	}
}