<?php
/**
 * ==================== EMAIL CONFIRMATION REQUEST ======================
 */
add_action( 'wp_loaded', 'aa_func_20164930014910' );
function aa_func_20164930014910()
{
	if ( isset( $_GET[ 'am_confirm_email' ] ) ) {
		global $wpdb;
		$user = get_user_by( "ID", get_current_user_id() );
		if ( $user ) {
			$email = $user->data->user_email;
			$token = send_me_confirmation_registration_link( $email, 'confirm' );
			if ( $token ) {
				$table = $wpdb->prefix . "user_reset_passwords";
				$wpdb->insert( $table, [
					'hash'   => $token,
					'email'  => $email,
					'action' => 'confirm',
					'time'   => date( 'Y-m-d H:i:s' )
				], [ '%s', '%s', '%s', '%s' ] );

				$_SESSION[ 'am_alerts' ][ "check_email_confirmation_link" ] = [
					'type'    => "info",
					'message' => "Check your email"
				];
			}

			wp_redirect( get_am_network_endpoint() );
			die;
		}
	}
}