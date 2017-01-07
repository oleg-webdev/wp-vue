<?php
/**
 * ==================== Login ======================
 * 07.01.2017
 */
add_action('wp_ajax_nopriv_ajx20174507084516', 'ajx20174507084516');
add_action('wp_ajax_ajx20174507084516', 'ajx20174507084516');
function ajx20174507084516()
{
	$response = [
		'data'   => $_POST,
		'status' => 'fail',
	];
	$user = get_user_by( 'email', $response['data']['login'] );
	if(!$user) {
		$response['status'] = 'Such user is not exists';
		echo json_encode( $response );
		die;
	}

	if(wp_check_password( $response['data']['pass'], $user->user_pass, $user->ID )) {
		$response['status'] = 'success';
		wp_set_auth_cookie($user->ID);
		$response['user'] = am_user($user->ID);
	} else {
		$response['status'] = 'Password not matches';
	}


	echo json_encode( $response );
	die;
}