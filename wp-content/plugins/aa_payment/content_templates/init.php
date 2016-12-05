<?php
/**
 * ==================== Define custom template for products ======================
 * 24.07.2016
 */
add_filter('single_template', 'aa_func_20161524041530');
function aa_func_20161524041530($single_template)
{
	global $post;
	if ($post->post_type == 'product-items') {
		$single_template = dirname( __FILE__ ) . '/single-product-items.php';
	}
	return $single_template;
}