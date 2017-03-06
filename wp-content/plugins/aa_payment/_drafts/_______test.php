<?php
// add_action( 'AM_afterbody_start', 'aa_func_20165922015939' );
function aa_func_20165922015939()
{
	if(isset($_GET['tst_20170606010658'])) {
		$paypal_credentials = paypal_pro_credentials();
		echo "<pre>";
		print_r($paypal_credentials);
		echo "</pre>";
		$request_params     = [
			'METHOD'         => 'DoDirectPayment',
			'USER'           => $paypal_credentials[ 'api_username' ],
			'PWD'            => $paypal_credentials[ 'api_password' ],
			'SIGNATURE'      => $paypal_credentials[ 'api_signature' ],
			'VERSION'        => $paypal_credentials[ 'api_version' ],
			'PAYMENTACTION'  => 'Sale',
			'IPADDRESS'      => $_SERVER[ 'REMOTE_ADDR' ],
			'CREDITCARDTYPE' => 'VISA', // MasterCard, Visa
			'ACCT'           => '4032035787268127', // vuetest@vue.test sonicred
			'EXPDATE'        => '042022',
			'CVV2'           => '456',
			'FIRSTNAME'      => 'Vue',
			'LASTNAME'       => 'Test',
			'STREET'         => '707 W. Bay Drive',
			'CITY'           => 'Largo',
			'STATE'          => 'FL',
			'COUNTRYCODE'    => 'US',
			'ZIP'            => '33770',
			'AMT'            => '50.00',
			'CURRENCYCODE'   => 'USD',
			'DESC'           => 'Testing Payments Pro'
		];

		$curl = curl_init($paypal_credentials['api_endpoint']);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($request_params));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);

		$result = curl_exec($curl);
		curl_close($curl);

		echo "<pre>";
		print_r($result);
		echo "</pre>";
	}
}


if ( ! function_exists( 'curl_to_paypal' ) ) {
	function curl_to_paypal( $request_string, $ajax = false )
	{
		$credentials = paypal_pro_credentials();
		if ( ! $credentials ) {
			return false;
		}
		// Send NVP string to PayPal and store response
		$curl = curl_init( $credentials[ 'api_endpoint' ] );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $request_string );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $curl, CURLOPT_TIMEOUT, 30 );

		$result = curl_exec( $curl );
		curl_close( $curl );

		parse_str( $result, $output );

		if ( $ajax ) {
			echo json_encode( $output );
			die;
		}

		return $output;
	}
}