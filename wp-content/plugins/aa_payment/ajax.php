<?php
/**
 * Delete notice for current user
 */
add_action( 'wp_ajax_nopriv_ajx20164726124703', 'ajx20164726124703' );
add_action( 'wp_ajax_ajx20164726124703', 'ajx20164726124703' );
function ajx20164726124703()
{
	if ( isset( $_POST[ 'aa_notice_descriptor' ] ) ) {
		$notice_option = get_option( $_POST[ 'aa_notice_descriptor' ] );
		$user          = $_POST[ 'aa_data_user' ];
		$notice_arr    = $notice_option[ $_POST[ 'aa_data_notice' ] ];

		$userisnotyet_excluded = array_search( $user, $notice_arr[ 'excluded_users' ] );

		// If user not found in array of excluded users
		if ( $userisnotyet_excluded === false ) {
			$notice_arr[ 'excluded_users' ][]            = $user;
			$notice_option[ $_POST[ 'aa_data_notice' ] ] = $notice_arr;
			update_option( $_POST[ 'aa_notice_descriptor' ], $notice_option );
		}
	}
	die;
}