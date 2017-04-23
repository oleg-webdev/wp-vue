<?php
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( [
		'page_title' => 'Theme Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'icon_url'   => 'dashicons-screenoptions',
		'position'   => 61
	] );

	acf_add_options_sub_page( [
		'page_title'  => 'Theme Header Settings',
		'menu_title'  => 'Header',
		'parent_slug' => 'theme-general-settings',
	] );

	acf_add_options_sub_page( [
		'page_title'  => 'Theme Main Settings',
		'menu_title'  => 'Main',
		'parent_slug' => 'theme-general-settings',
	] );

	acf_add_options_sub_page( [
		'page_title'  => 'Theme Footer Settings',
		'menu_title'  => 'Footer',
		'parent_slug' => 'theme-general-settings',
	] );

}