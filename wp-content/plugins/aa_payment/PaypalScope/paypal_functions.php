<?php

/**
 * ==================== PayPal API Credentials ======================
 */
if ( ! function_exists( 'paypal_credentials' ) ) {
	function paypal_credentials()
	{
		if ( function_exists( 'get_field' ) ) {
			$sandbox = get_field( 'sandbox_mode', 'option' );

			$email = $sandbox ?
				get_field( 'sandbox_paypal_email', 'option' ) : get_field( 'paypal_email', 'option' );

			$client_id = $sandbox ?
				get_field( 'sandbox_client_id', 'option' ) : get_field( 'client_id', 'option' );

			$client_secret = $sandbox ?
				get_field( 'sandbox_client_secret', 'option' ) : get_field( 'client_secret', 'option' );

			return [
				'sandbox'       => $sandbox,
				'paypal_email'  => $email,
				'client_id'     => $client_id,
				'client_secret' => $client_secret
			];

		}

		return false;
	}
}

/**
 * ==================== Paypal Pro Credentials ======================
 */
if ( ! function_exists( 'paypal_pro_credentials' ) ) {
	function paypal_pro_credentials()
	{
		if ( function_exists( 'get_field' ) ) {
			$sandbox = get_field( 'paypalpro_sandbox', 'option' );

			$api_endpoint = $sandbox ?
				'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';

			$api_username = $sandbox ?
				get_field( 'api_username_sandbox', 'option' ) : get_field( 'api_username', 'option' );

			$api_password = $sandbox ?
				get_field( 'api_password_sandbox', 'option' ) : get_field( 'api_password', 'option' );

			$api_signature = $sandbox ?
				get_field( 'api_signature_sandbox', 'option' ) : get_field( 'api_signature', 'option' );

			return [
				'sandbox'       => $sandbox,
				'api_version'   => '85.0',
				'api_endpoint'  => $api_endpoint,
				'api_username'  => $api_username,
				'api_password'  => $api_password,
				'api_signature' => $api_signature,
			];
		}

		return false;
	}
}

/**
 * ==================== Payflow Credentials ======================
 * 06.03.2017
 */
if ( ! function_exists( 'paypal_payflow_credentials' ) ) {
	function paypal_payflow_credentials()
	{
		if ( function_exists( 'get_field' ) ) {
			$sandbox = get_field( 'payflow_sandbox', 'option' );

			$partner = $sandbox ?
				get_field( 'sandbox_payflow_partner', 'option' ) : get_field( 'payflow_partner', 'option' );

			$pwd = $sandbox ?
				get_field( 'sandbox_payflow_pwd', 'option' ) : get_field( 'payflow_pwd', 'option' );

			$vendor = $sandbox ?
				get_field( 'sanbox_payflow_vendor', 'option' ) : get_field( 'payflow_vendor', 'option' );

			$user = $sandbox ?
				get_field( 'sandbox_payflow_user', 'option' ) : get_field( 'payflow_user', 'option' );

			return [
				'partner' => $partner,
				'pwd'     => $pwd,
				'vendor'  => $vendor,
				'user'    => $user,
			];
		}

		return false;
	}
}

/**
 * ==================== Credit Card Detection ======================
 * 22.08.2016
 */
if ( ! function_exists( 'card_detector' ) ) {
	function card_detector( $card )
	{
		$patterns = [
			'Visa'             => '/^4[0-9]{12}(?:[0-9]{3})?$/',
			'MasterCard'       => '/^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$/',
			'American Express' => '/^3[47][0-9]{13}$/',
			'Diners Club'      => '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',
			'Discover'         => '/^6(?:011|5[0-9]{2})[0-9]{12}$/',
			'JCB'              => '/^(?:2131|1800|35\d{3})\d{11}$/',
			'Maestro'          => '/^(?:5[0678]\d\d|6304|6390|67\d\d)\d{8,15}$/',
			'Amex'             => '/^3[47]\d{13}$/',
		];
		foreach ( $patterns as $patkey => $patvalue ) {
			preg_match( $patvalue, $card, $matches );
			if ( ! empty( $matches ) ) {
				return $patkey;
				break;
			}
		}

		return false;
	}
}