<?php

// ============= Preformatted =============
if ( ! function_exists( 'remove_br_from_shortcodes' ) ) {
	function remove_br_from_shortcodes( $atts = [], $content = null )
	{
		ob_start();
//		$shortcode_data = shortcode_atts( [
//			'params' => $atts[ 'params' ]
//		], $atts );
		echo str_replace(['<br>', '<br/>', '<br />', '<p>', '</p>'], '', do_shortcode($content));
		return ob_get_clean();
	}
}

// ============= Aa_img =============
if ( ! function_exists( 'aa_img' ) ) {
	function aa_img( $args )
	{
		ob_start();
		$sha = shortcode_atts( [
			'id'    => $args[ 'id' ],
			'class' => ! empty( $args[ 'class' ] ) ? $args[ 'class' ] : "img-responsive",
		], $args );
		echo "<img src='" . wp_get_attachment_url( $sha[ 'id' ] ) . "' class='{$sha['class']}'>";

		return ob_get_clean();
	}
}

add_action('wp_loaded', 'aa_func_20165319045319');
function aa_func_20165319045319()
{
	add_shortcode('aa_img', 'aa_img');
	add_shortcode('remove_br_from_shortcodes', 'remove_br_from_shortcodes');
}

