<?php
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

/**
 * ==================== Change Title Defaults ======================
 * 19.08.2016
 */
add_filter( 'wp_title', 'aa_func_20164019094058', 10, 1 );
function aa_func_20164019094058( $title )
{
	if ( is_home() || is_front_page() ) {
		$title = get_bloginfo( 'name' ) . " | " . get_bloginfo( 'description', 'display' );
	} else if ( is_404() ) {
		$title = get_bloginfo( 'name' ) . ' | .404!';
	} else if ( is_search() ) {
		$title = get_bloginfo( 'name' ) . " | Search " . get_search_query();
	} else {
		$title = get_the_title() . " | " . get_bloginfo( 'name' );
	}

	return $title;
}

//add_action( 'admin_head', 'aa_set_favicon' );
//add_action( 'wp_head', 'aa_set_favicon' );
function aa_set_favicon()
{
	$url = get_template_directory_uri().'/img/app-favicon.png';
	$output = "<link rel='icon' type='image/png' href='{$url}'>";
	echo $output;
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

add_filter( 'app_page_classes', 'aa_func_20174023044051', 10, 1 );
function aa_func_20174023044051( $template )
{
	$page_template = str_replace( [ ".php", "_" ], "", $template );
	$result_tpl    = empty( $page_template ) ? 'am-wrap' : $page_template;
	$result_tpl    .= "";

	return $result_tpl;
}

add_filter( 'app-wrapper-classes', 'aa_func_20174723044733', 10, 1 );
function aa_func_20174723044733( $wrap_class )
{
	$classes = [
		browser_info(), // google-chrome edge-iexplorer mozilla-firefox opera apple-safari
		// Ohter classes goes there
	];
	$wrap_class && array_push( $classes, $wrap_class );

	return implode( " ", $classes );
}