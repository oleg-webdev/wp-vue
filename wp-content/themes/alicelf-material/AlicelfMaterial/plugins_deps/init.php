<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.2
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/TGM_Plugin_Activation.php';

add_action( 'tgmpa_register', 'alicelf_theme_register_dependences' );

function alicelf_theme_register_dependences()
{

	$plugins_uri = get_template_directory_uri() . '/AlicelfMaterial/plugins_deps/plugins/';
	$plugins     = array(
		// ACF PRo
		array(
			'name'               => 'Advanced Custom Fields PRO',
			'slug'               => 'advanced-custom-fields-pro',
			'source'             => $plugins_uri . 'advanced-custom-fields-pro.zip',
			'required'           => false,
			'version'            => '5.3.10',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
		),
		array(
			'name'               => 'Custom Captcha',
			'slug'               => 'custom_captcha',
			'source'             => 'https://github.com/Nayami/theme_plugins/raw/master/custom_captcha.zip',
			'required'           => false,
			'version'            => '0.1',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => 'https://github.com/Nayami/theme_plugins/tree/master/custom_captcha',
		),

		array(
			'name'         => 'Generate Meta',
			'slug'         => 'generate-meta',
			'source'       => 'https://github.com/Nayami/theme_plugins/raw/master/generate-meta.zip',
			'required'     => false,
			'external_url' => 'https://github.com/Nayami/theme_plugins/tree/master/generate-meta',
		),
		array(
			'name'         => 'Generate Custom Posts',
			'slug'         => 'generate-custom-posts',
			'source'       => 'https://github.com/Nayami/theme_plugins/raw/master/generate-custom-posts.zip',
			'required'     => false,
			'external_url' => 'https://github.com/Nayami/theme_plugins/tree/master/generate-custom-posts',
		),
		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'     => 'WP-PageNavi',
			'slug'     => 'wp-pagenavi',
			'required' => false,
		),
		array(
			'name'     => 'Instagram Feed',
			'slug'     => 'instagram-feed',
			'required' => false,
		),
		array(
			'name'     => 'WP REST API 2.0+ (WP API)',
			'slug'     => 'rest-api',
			'required' => true,
		),

	);


	$config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'theme-requirements-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
			'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
			'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
			// %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
			// %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
			// %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
			// %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
			// %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
			// %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
			'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

}
