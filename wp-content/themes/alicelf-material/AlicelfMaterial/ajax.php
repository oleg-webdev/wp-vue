<?php
// wp rest api v2
if ( ! function_exists( 'AMapiurl' ) ) {
	function AMapiurl()
	{
		return get_site_url() . '/wp-json/wp/v2/';
	}
}
add_filter( 'wp_mail_content_type', 'aa_func_20162528072509' );
function aa_func_20162528072509()
{
	return "text/html";
}

/**
 * ==================== SETTINGS ======================
 * 28.09.2016
 */
add_action( 'wp_ajax_nopriv_ajx20162128122131', 'ajx20162128122131' );
add_action( 'wp_ajax_ajx20162128122131', 'ajx20162128122131' );
function ajx20162128122131()
{
	global $_am;
	$values = [
		'auth_info' => [
			'network_purpose'       => $_am[ 'network-purpose' ],
			'registration_info'     => $_am[ 'network-registration' ],
			'registration_strategy' => $_am[ 'network-confirmation-flow' ]
		]
	];
	echo json_encode( $values );
	die;
}

/**
 * ==================== Get system notices ======================
 */
add_action( 'wp_ajax_nopriv_ajx20160830020813', 'ajx20160830020813' );
add_action( 'wp_ajax_ajx20160830020813', 'ajx20160830020813' );
function ajx20160830020813()
{
	$response = [ 'notices' => null ];
	if ( isset( $_SESSION[ 'am_alerts' ] ) ) {
		$response[ 'notices' ] = $_SESSION[ 'am_alerts' ];
	}
	echo json_encode( $response );
	die;
}

/**
 * ==================== Delete System Notification ======================
 * 30.09.2016
 */
add_action( 'wp_ajax_nopriv_ajx20162830022821', 'ajx20162830022821' );
add_action( 'wp_ajax_ajx20162830022821', 'ajx20162830022821' );
function ajx20162830022821()
{
	$response  = [ 'status' => null ];
	$notice_id = $_GET[ 'body_data' ];
	if ( isset( $_SESSION[ 'am_alerts' ][ $notice_id ] ) ) {
		unset( $_SESSION[ 'am_alerts' ][ $notice_id ] );
		$response[ 'status' ] = 'success';
	}
	$response[ 'data' ] = $notice_id;
	echo json_encode( $response );
	die;
}



/**
 * Convert tables to utf8 encoding
 */
add_action( 'wp_ajax_aa_func_20150827030852', 'aa_func_20150827030852' );
function aa_func_20150827030852()
{
	if ( isset( $_POST[ 'do_the_conversion' ] ) ) {
		global $wpdb;
		$set_encoding = $_POST[ 'set_encoding' ];
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
		die;
	}
}