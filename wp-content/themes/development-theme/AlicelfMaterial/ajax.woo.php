<?php
/**
 * ==================== Get Cart Items ======================
 * 12.11.2016
 */
add_action( 'wp_ajax_nopriv_ajx20161412071430', 'ajx20161412071430' );
add_action( 'wp_ajax_ajx20161412071430', 'ajx20161412071430' );
function ajx20161412071430()
{
	if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		echo null;
		die;
	}

	global $woocommerce;
	$items = $woocommerce->cart->get_cart();

	$data = [];
	foreach ( $items as $item => $values ) {
		$id          = $values[ 'product_id' ];
		$origin_post = $values[ 'data' ]->post;

		$data[] = [
			'ID'            => $values[ 'product_id' ],
			'images'        => $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'thumbnail', true ),
			'product'       => $origin_post,
			'permalink'     => get_permalink( $id ),
			'qty'           => $values[ 'quantity' ],
			'price'         => get_post_meta( $id, '_price', true ),
			'cart_item_key' => $item
		];
	}
	echo json_encode( $data );
	die;
}


add_action( 'wp_ajax_nopriv_ajx20163730073701', 'ajx20163730073701' );
add_action( 'wp_ajax_ajx20163730073701', 'ajx20163730073701' );
function ajx20163730073701()
{
	if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		echo null;
		die;
	}

	global $woocommerce;
	$response = [
		'status' => 'fail',
		'data'   => null
	];

	//	$cart = $woocommerce->cart->get_cart();
	$response[ 'data' ] = purify_postdata($_POST);
	$cart_item_key = $response['data']['cart_item_key'];

	if ( $cart_item_key ) {
		$woocommerce->cart->set_quantity( $cart_item_key, 0 );
		$response['status'] = 'success';
	}

	echo json_encode( $response );
	die;
}