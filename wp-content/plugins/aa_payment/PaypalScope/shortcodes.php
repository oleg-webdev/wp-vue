<?php
if ( ! function_exists( 'aa_payflow_form' ) ) {
	add_shortcode('aa_payflow_form', 'aa_payflow_form');
	function aa_payflow_form( $atts )
	{
		ob_start();
		$data = shortcode_atts( [
			'type' => isset($atts[ 'type' ]) ? $atts[ 'type' ] : 'post',
		], $atts );


		return ob_get_clean();
	}
}