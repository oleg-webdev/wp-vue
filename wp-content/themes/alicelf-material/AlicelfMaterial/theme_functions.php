<?php
use AlicelfMaterial\Helpers\Helper;

// ============= Dd =============
if ( ! function_exists( 'dd' ) ) {
	function dd( $data )
	{
		echo "<pre>";
		Helper::dumpAndDie( $data );
		echo "</pre>";
	}
}

// ============= Material_logo =============
if ( ! function_exists( 'material_logo' ) ) {
	function material_logo()
	{
		global $_am;
		$output = null;
		$title  = get_bloginfo( 'name' ) . " | " . get_bloginfo( 'description' );
		if ( ! empty( $_am[ 'opt-logo' ]['url'] ) ) {
			$output .= "<a class='am-logo' href='" . get_site_url() . "'>";
			$output .= "<img src='{$_am['opt-logo']['url']}' title='{$title}' alt='site-logo'>";
			$output .= "</a>";
		} else {
			$output .= "<a id='text-logo' href='".get_site_url()."'>";
			$output .= "<i class='alice-alicelf-material-logo'></i><span>".get_bloginfo( 'name' )."</span>";
			$output .= "</a>";
		}

		return $output;
	}
}

if ( ! function_exists( 'am_browser' ) ) {
	function am_browser()
	{
		return Helper::browser();
	}
}

if ( ! function_exists( 'am_body_classes' ) ) {
	function am_body_classes()
	{
		global $_am;
		$body_class = $_am[ 'sticky-header' ] ? 'am-sticky-header' : 'non-sticky-header';

		return apply_filters( 'AM_body_classes', $body_class );
	}
}

// ============= Is_amuserpage =============
if ( ! function_exists( 'is_amuserpage' ) ) {
	function is_amuserpage()
	{
		global $wp_query;
		foreach ( $wp_query->query_vars as $k => $v ) {
			if ( $k === am_profile_slug() ) {
				return true;
			}
		}

		return false;
	}
}
add_filter( 'AM_body_classes', 'aa_func_20161722091746', 10, 1 );
function aa_func_20161722091746( $body_classes )
{
	if ( is_amuserpage() ) {
		$body_classes .= " am-user-page";
	}

	$body_classes.=" ".am_browser();

	return $body_classes;
}

add_filter( 'wp_title', 'aa_func_20163122093122', 11, 1 );
function aa_func_20163122093122( $title )
{
	if ( is_amuserpage() ) {
		global $_am;
		$title = $title = $_am[ 'users-page-title' ] . " | " . get_bloginfo( 'name' );
	}

	return $title;
}


// ============= Get_am_network_endpoint =============
if ( ! function_exists( 'get_am_network_endpoint' ) ) {
	function get_am_network_endpoint()
	{
		return get_site_url().'/'.am_profile_slug();
	}
}