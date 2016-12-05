<?php
add_action( 'plugins_loaded', 'aa_func_20165321065325' );
function aa_func_20165321065325()
{
	if ( function_exists( 'acf_add_options_page' ) ) {

		acf_add_options_sub_page( [
			'page_title'  => 'Paypal',
			'menu_title'  => 'Paypal',
			'menu_slug'   => 'paypal_settings',
			'parent_slug' => 'aa_payment',
			'capability'  => 'edit_posts',
			'position'    => '',
			'icon_url'    => ''
		] );

	}
}