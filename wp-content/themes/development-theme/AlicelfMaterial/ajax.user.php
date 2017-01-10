<?php
/**
 * ==================== Login ======================
 * 07.01.2017
 */
add_action( 'wp_ajax_nopriv_ajx20174507084516', 'ajx20174507084516' );
add_action( 'wp_ajax_ajx20174507084516', 'ajx20174507084516' );
function ajx20174507084516()
{
	$response = [
		'data'   => $_POST,
		'status' => [
			'type' => 'fail'
		],
	];
	$user     = get_user_by( 'email', $response[ 'data' ][ 'login' ] );
	if ( ! $user ) {
		$response[ 'status' ] = [
			'type'    => 'fail',
			'field'   => 'login',
			'message' => 'Such user is not exists'
		];
		echo json_encode( $response );
		die;
	}

	if ( wp_check_password( $response[ 'data' ][ 'pass' ], $user->user_pass, $user->ID ) ) {
		$response[ 'status' ] = [
			'type'    => 'success',
			'message' => 'Success'
		];
		wp_set_auth_cookie( $user->ID );
		$response[ 'user' ] = am_user( $user->ID );
	} else {
		$response[ 'status' ] = [
			'type'    => 'fail',
			'field'   => 'pass',
			'message' => 'Password not matches'
		];
	}

	echo json_encode( $response );
	die;
}

/**
 * ==================== Registration ======================
 * 09.01.2017
 */
add_action( 'wp_ajax_nopriv_ajx20172609122644', 'ajx20172609122644' );
add_action( 'wp_ajax_ajx20172609122644', 'ajx20172609122644' );
function ajx20172609122644()
{
	global $_am;
	$registration_is_enabled = $_am[ 'network-registration' ] === 'yes';
	$email_confirmation_flow = $_am[ 'network-confirmation-flow' ];
	$response                = [
		'data'   => $_POST,
		'status' => 'fail'
	];

	if ( $registration_is_enabled ) {

		if ( $email_confirmation_flow === 'confirm_before' ) {

			// @TODO: send registration link
			// reset/confirm
			// send_me_confirmation_registration_link( $email, 'confirm' )

		} else {

			// @TODO: registration

			if ( $email_confirmation_flow === 'confirm_after' ) {

				// @TODO: send confirmation link
				// @TODO: create confirmation flash message

			}
		}

	}

	echo json_encode( $response );
	die;
}

/**
 * ==================== Reset Password ======================
 * 09.01.2017
 */
add_action( 'wp_ajax_nopriv_ajx20173909123946', 'ajx20173909123946' );
add_action( 'wp_ajax_ajx20173909123946', 'ajx20173909123946' );
function ajx20173909123946()
{
	global $wpdb;
	$pref     = $wpdb->prefix;
	$table    = $pref . "user_reset_passwords";
	$email    = $_POST[ 'email' ];
	$user     = get_user_by( 'email', $email );
	$response = [
		'data'   => $_POST,
		'status' => 'fail'
	];

	if ( $user ) {
		$token_info = send_me_confirmation_registration_link( $email, 'reset' );
		$wpdb->query( $wpdb->prepare( "DELETE FROM {$table} WHERE email = %s", $email ) );
		$wpdb->insert( $table, [
			'hash'   => $token_info[ 'token' ],
			'email'  => $email,
			'action' => 'reset',
			'time'   => current_time( 'mysql', 1 ),
		] );
		$response[ 'status' ] = 'success';
	} else {
		$response[ 'status' ] = 'notfound';
	}

	echo json_encode( $response );
	die;
}