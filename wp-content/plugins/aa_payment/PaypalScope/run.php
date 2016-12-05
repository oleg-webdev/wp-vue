<?php
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

/**
 * ==================== Initialization ======================
 * 21.07.2016
 */
add_action( 'wp_loaded', 'aa_func_20160920090937', 1 );
function aa_func_20160920090937()
{
	global $aa_paypal, $paypal_credentials;
	$paypal_credentials = paypal_credentials();

	if ( $paypal_credentials ) {
		$aa_paypal = new ApiContext(
			new OAuthTokenCredential(
				$paypal_credentials[ 'client_id' ],
				$paypal_credentials[ 'client_secret' ]
			)
		);
	} else {
		$aa_paypal = false;
	}
}

/**
 * ==================== Checkout Action ======================
 * 20.07.2016
 */
add_action( 'wp_loaded', 'aa_func_20164820054804', 2 );
function aa_func_20164820054804()
{
	global $aa_paypal;
	if ( $aa_paypal ) {
		if ( isset( $_POST[ 'paypal_checkout_20164820054847' ] ) ) {
			$data    = $_POST;
			$product = $data[ 'donation-name' ];
			$price   = (float) $data[ 'donation-price' ];

			$payer = new Payer();
			$payer->setPaymentMethod( 'paypal' );

			$item = new Item();
			$item->setName( $product )
			     ->setCurrency( 'USD' )
			     ->setQuantity( 1 )
			     ->setPrice( $price );

			$itemlist = new ItemList();
			$itemlist->setItems( [ $item ] );

			$details = new Details();
			$details->setSubtotal( $price );

			$amount = new Amount();
			$amount->setCurrency( 'USD' )
			       ->setTotal( $price )
			       ->setDetails( $details );

			$transaction = new Transaction();
			$transaction->setAmount( $amount )
			            ->setItemList( $itemlist )
			            ->setDescription( $product )
			            ->setInvoiceNumber( uniqid() );

			$redirectUrls = new RedirectUrls();
			$redirectUrls->setReturnUrl( get_site_url() . "/?aapayment_redirect&status=success" )
			             ->setCancelUrl( get_site_url() . "/?aapayment_redirect&status=cancel" );

			$payment = new Payment();
			$payment->setIntent( 'sale' )
			        ->setPayer( $payer )
			        ->setRedirectUrls( $redirectUrls )
			        ->setTransactions( [ $transaction ] );

			try {
				$payment->create( $aa_paypal );
			} catch ( Exception $e ) {
				die( $e );
			}
			$approvalUrl = $payment->getApprovalLink();
			wp_redirect( $approvalUrl );
			die;
		}
	}
}