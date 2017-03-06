<?php

/**
 * ==================== Basic PayPal Credentials ======================
 */
if ( ! function_exists( 'paypal_credentials' ) ) {
	function paypal_credentials()
	{
		if ( function_exists( 'get_field' ) ) {
			$_sandbox = get_field( 'paypalpro_sandbox', 'option' ) === 'true' ? true : false;

			return [
				'paypal_email'  => get_field( 'paypal_email', 'option' ),
				'client_id'     => get_field( 'client_id', 'option' ),
				'client_secret' => get_field( 'client_secret', 'option' ),
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
			$_sandbox      = get_field( 'paypalpro_sandbox', 'option' ) === 'true' ? true : false;

			$api_endpoint  = $_sandbox ?
				'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';

			$api_username  = $_sandbox ?
				get_field( 'api_username_sandbox', 'option' ) : get_field( 'api_username', 'option' );

			$api_password  = $_sandbox ?
				get_field( 'api_password_sandbox', 'option' ) : get_field( 'api_password', 'option' );

			$api_signature = $_sandbox ?
				get_field( 'api_signature_sandbox', 'option' ) : get_field( 'api_signature', 'option' );

			return [
				'sandbox'       => $_sandbox,
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