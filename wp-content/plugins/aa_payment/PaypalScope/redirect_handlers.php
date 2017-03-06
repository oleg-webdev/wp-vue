<?php
/**
 * ==================== Rendery System Messages ======================
 */
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

add_action( 'wp_footer', 'aa_func_20165020085037' );
function aa_func_20165020085037()
{
	if ( isset( $_SESSION[ 'aa_payment_system_messages' ] ) ) {
		$data = $_SESSION[ 'aa_payment_system_messages' ];
		echo "<div id='aa-payment-system-messages'>";
		foreach ( $data as $item ) {
			echo "<div class='system-message-item {$item['type']}'>";
			echo $item[ 'message' ];
			echo "</div>";
		}
		echo "</div>";
		unset( $_SESSION[ 'aa_payment_system_messages' ] );
	}

}

add_action( 'wp_loaded', 'aa_func_20164820084853', 3 );
function aa_func_20164820084853()
{
	global $aa_paypal;
	if ( isset( $_GET[ 'aapayment_redirect' ] ) ) {

		switch ( $_GET[ 'status' ] ) {
			/**
			 * ==================== Success Payment ======================
			 * 20.08.2016
			 */
			case 'success' :
				$paymentId = $_GET[ 'paymentId' ];
				$payerID   = $_GET[ 'PayerID' ];
				$payment   = Payment::get( $paymentId, $aa_paypal );

				$execute = new PaymentExecution();
				$execute->setPayerId( $payerID );

				try {
					$result = $payment->execute( $execute, $aa_paypal );
				} catch ( Exception $e ) {
					die( $e );
				}

				$_SESSION[ 'aa_payment_system_messages' ][] = [
					'type'    => 'success',
					'message' => 'Payment Successful'
				];
				break;

			/**
			 * ==================== Cancel Payment ======================
			 * 20.08.2016
			 */
			case 'cancel' :
				$_SESSION[ 'aa_payment_system_messages' ][] = [
					'type'    => 'cancel',
					'message' => 'Payment Canceled'
				];
				break;
		}

		wp_redirect( get_site_url() );
		die;
	}
}