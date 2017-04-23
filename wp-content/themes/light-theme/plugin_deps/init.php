<?php
require_once get_template_directory() . '/plugin_deps/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'light_theme_register_required_plugins' );
function light_theme_register_required_plugins()
{
	$plugins_uri = get_template_directory_uri() . '/plugin_deps/plugins/';
	$plugins     = [
		[
			'name'               => 'Advanced Custom Fields PRO',
			'slug'               => 'advanced-custom-fields-pro',
			'source'             => $plugins_uri . 'advanced-custom-fields-pro.zip',
			'required'           => false,
			'version'            => '5.3.10',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
		],

		[
			'name'               => 'All-in-One WP Migration',
			'slug'               => 'all-in-one-wp-migration',
			'source'             => $plugins_uri . 'all-in-one-wp-migration.zip',
			'required'           => false,
			'version'            => '6.40',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
		],

//		[
//			'name'     => 'WP REST API 2.0+ (WP API)',
//			'slug'     => 'rest-api',
//			'required' => true,
//		],

	];

	$config = [
		'id'           => 'light-theme',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'strings'      => [
			'nag_type' => 'updated'
		]
	];

	tgmpa( $plugins, $config );
}