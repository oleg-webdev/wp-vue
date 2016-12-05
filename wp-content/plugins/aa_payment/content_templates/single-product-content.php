<?php
add_action( 'single_itemproduct_after', 'aa_func_20165524095534', 11 );
function aa_func_20165524095534()
{
	global $post;
	if ( function_exists( 'get_field' ) ) {
		$product_price = get_field( 'item_price' );
		$product_type  = get_field( 'product_type' );

		if ( $product_type !== 'simple' ) {
			$product_tpl_src = plugin_dir_path( __FILE__ ) . 'product_types/product-' . $product_type . '.php';
			file_exists( $product_tpl_src ) && include( $product_tpl_src );
		} else {
			/**
			 * ==================== Simple product ======================
			 * 24.07.2016
			 */

		}
	}

}