<?php

/**
 * ==================== Basic PayPal Credentials ======================
 * 22.08.2016
 */
if ( ! function_exists( 'paypal_credentials' ) ) {
	function paypal_credentials()
	{
		if ( function_exists( 'get_field' ) ) {
			$sandbox = get_field( 'sandbox', 'option' ) === 'true' ? true : false;

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
 * 22.08.2016
 */
if ( ! function_exists( 'paypal_pro_credentials' ) ) {
	function paypal_pro_credentials()
	{
		if ( function_exists( 'get_field' ) ) {
			$sandbox = get_field( 'sandbox', 'option' ) === 'true' ? true : false;

			return [
				'sandbox'       => $sandbox,
				'api_version'   => '85.0',
				'api_endpoint'  => $sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp',
				'api_username'  => $sandbox ? get_field( 'api_username_sandbox', 'option' ) : get_field( 'api_username', 'option' ),
				'api_password'  => $sandbox ? get_field( 'api_password_sandbox', 'option' ) : get_field( 'api_password', 'option' ),
				'api_signature' => $sandbox ? get_field( 'api_signature_sandbox', 'option' ) : get_field( 'api_signature', 'option' ),
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

/**
 * ==================== Prepare to CURL ======================
 * 22.08.2016
 */
if ( ! function_exists( 'pro_request_params' ) ) {
	function pro_request_params( $data, $ajax = false )
	{
		$credentials = paypal_pro_credentials();
		if ( ! $credentials ) {
			return false;
		}

		$r      = [
			'METHOD'         => 'DoDirectPayment',
			'USER'           => $credentials[ 'api_username' ],
			'PWD'            => $credentials[ 'api_password' ],
			'SIGNATURE'      => $credentials[ 'api_signature' ],
			'VERSION'        => $credentials[ 'api_version' ],
			'PAYMENTACTION'  => 'Sale',
			'IPADDRESS'      => $_SERVER[ 'REMOTE_ADDR' ],

			// Should be dynamic data
			'CREDITCARDTYPE' => $data[ 'card_type' ],     // Visa MasterCard Discover Amex JCB Maestro
			'ACCT'           => $data[ 'card_number' ],   // actual credit card number
			'EXPDATE'        => $data[ 'exp_date' ],      // 022013
			'CVV2'           => $data[ 'cvv2' ],          // 456
			'FIRSTNAME'      => $data[ 'first_name' ],    // Buyer Fname
			'LASTNAME'       => $data[ 'last_name' ],     // Buyer Lname
			'STREET'         => $data[ 'street' ],        // 707 W. Bay Drive
			'CITY'           => $data[ 'city' ],          // Largo
			'STATE'          => $data[ 'state_code' ],    // FL
			'COUNTRYCODE'    => $data[ 'coutry_code' ],   // US
			'ZIP'            => $data[ 'zip_code' ],      // 33770
			'AMT'            => $data[ 'total_amount' ],  // float 300.00
			'CURRENCYCODE'   => $data[ 'currency_code' ], // USD
			'DESC'           => $data[ 'description' ]    // Some descripiton
		];
		$result = "";
		foreach ( $r as $var => $val ) {
			$result .= '&' . $var . '=' . urlencode( $val );
		}

		return $result;
	}
}

/**
 * ==================== Make a Request to Paypal ======================
 * 22.08.2016
 */
if ( ! function_exists( 'curl_to_paypal' ) ) {
	function curl_to_paypal( $request_string, $ajax = false )
	{
		$credentials = paypal_pro_credentials();
		if ( ! $credentials ) {
			return false;
		}
		// Send NVP string to PayPal and store response
		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_VERBOSE, 1 );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $curl, CURLOPT_TIMEOUT, 30 );
		curl_setopt( $curl, CURLOPT_URL, $credentials[ 'api_endpoint' ] );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $request_string );

		$result = curl_exec( $curl );
		curl_close( $curl );

		parse_str( $result, $output );

		return $ajax ? json_encode( $output ) : $output;
	}
}