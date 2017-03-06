<?php
/*
Plugin Name: AA Payment
Plugin URI: http://www.upwork.com/fl/olegtsibulnik
Description: AA Payment plugin - Upload and Activate. PHP version 5.4+ required
Author: Alicelf WebArtisan
Version: 1.0.1
Author URI: http://www.upwork.com/fl/olegtsibulnik
*/
//session_start();
// Dependencies
require_once( 'AAPluginInitial.php' );
global $aa_payment;
$aa_payment = new AAPluginInitial( "AA Payment", null, null, null, 99 );


include_once( 'vendor/autoload.php' );

// Wrap to wp_loaded for get user and set him notice
add_action( 'plugins_loaded', 'aa_func_20150406060442', 1 );
function aa_func_20150406060442()
{
	global $aa_payment;
	// Notice content. Can has hrefs or other html
	$aa_payment->setPluginNotice( 'aa_payment_welcome', "Plugin {$aa_payment->_plugin_name} is enabled" );

	$aa_payment->setOption( 'paypal_credentials', [ ] );
}


// Define Pages
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

// Change Plugin title
add_filter( 'aa_payment_basetitle', 'aa_func_20150506060501', 10, 1 );
function aa_func_20150506060501( $title )
{
	$title .= " (payment gateway credentials)";

	return $title;
}

/**
 * Plugin page content
 */
add_action( 'aa_payment_content', 'aa_func_20150506060514' );
function aa_func_20150506060514()
{
	?>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A exercitationem ipsam laudantium omnis perferendis quae qui quod, rem vel. Ab dolorum obcaecati pariatur sapiente! Architecto expedita pariatur porro praesentium tempore!</p>
	<?php
}