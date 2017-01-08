<?php
if ( ! function_exists( 'am_profile_slug' ) ) {
	function am_profile_slug()
	{
		global $_am;
		return $_am['users-page-slug'];
	}
}


add_action('wp_loaded', 'aa_func_20162801112818');
function aa_func_20162801112818()
{
	add_rewrite_endpoint( am_profile_slug(), EP_ALL | EP_PAGES );
}

add_action('template_redirect', 'aa_func_20162701112749');
function aa_func_20162701112749()
{
	global $wp_query;
	if ( ! isset( $wp_query->query_vars[am_profile_slug()] ) )
		return;

	include locate_template('AlicelfMaterial/user/views/profile.php');
	exit;
}
// Users .htaccess and permalinks END


if ( ! function_exists( 'am_user' ) ) {
	function am_user( $user_id )
	{
		$user = get_user_by( 'ID', $user_id );
		if ( ! $user )
			return false;

		return [
			'ID'              => $user->ID,
			'display_name'    => $user->data->display_name,
			'user_email'      => $user->data->user_email,
			'user_login'      => $user->data->user_login,
			'user_nicename'   => $user->data->user_nicename,
			'user_registered' => $user->data->user_registered,
			'user_url'        => $user->data->user_url,
			'roles'           => $user->roles,
			'slug'            => get_user_meta( $user->ID, 'am_slug', true ),
			'administrator'   => $user->allcaps[ 'administrator' ],
			'is_current_user' => get_current_user_id() === (int) $user_id ? true : false,

			'network_meta' => [
				'email_confirmed' => get_user_meta( $user->ID, 'am_email_confirmed', true ),
				'user_media'      => [
					'avatar_url' => apply_filters( 'am_user_avatar_url',
						get_avatar_url( $user->ID, [ 'size' => 170 ] ), $user->ID )
				]
			]
		];
	}
}

add_filter( 'am_user_avatar_url', 'aa_func_20165729035750', 10, 2 );
function aa_func_20165729035750( $avatar_url, $user_id )
{
	$meta_avatar_url = get_user_meta( $user_id, 'am_user_avatar_url', true );
	if ( ! empty( $meta_avatar_url ) ) {
		$avatar_url = $meta_avatar_url;
	}

	return $avatar_url;
}

if ( ! function_exists( 'send_me_confirmation_registration_link' ) ) {

	/**
	 * @param $email
	 * @param string $type = reset/confirm
	 *
	 * @return bool|null|string
	 */
	function send_me_confirmation_registration_link( $email, $type = 'reset' )
	{
		if ( ! $email )
			return false;
		$mail_type  = $type === 'reset' ? 'Reset Password' : 'Confirmation Link';
		$link       = get_am_network_endpoint() . "/screen/restorepass";
		$token      = sha1( uniqid() . $email );
		$email_link = $link . "?token=" . $token . "&email=" . $email;
		$mail_body  = "Your activation link: <br>";
		$mail_body .= "<a href='{$email_link}'>{$mail_type}</a>";
		$from              = get_option( 'admin_email' );
		$headers           = "From: {$from}\r\n";
		$send_mail_process = wp_mail( $email, $mail_type, $mail_body, $headers );
		if ( $send_mail_process )
			return $token;

		return null;
	}
}

/**
 * ==================== Disable admin area for non admins ======================
 * 03.10.2016
 */
add_action( 'wp_loaded', 'aa_func_20165803055837' );
function aa_func_20165803055837()
{
	global $_am;
	if ( $_am[ 'disable-regular-wplogin' ] === 'yes' ) {
		$is_ajax = defined( 'DOING_AJAX' ) && DOING_AJAX;
		$gl      = $GLOBALS[ 'pagenow' ];
		$list    = [
			'wp-login.php'
		];
		if ( ( is_admin() || in_array( $gl, $list ) ) && ! $is_ajax ) {
			if ( ! is_super_admin( get_current_user_id() ) ) {
				 wp_redirect( get_am_network_endpoint() );
				die;
			}
		}
	}
}