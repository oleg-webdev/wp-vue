<?php
/**
 * ==================== Frontend Scripts ======================
 * 22.09.2016
 */
add_action( 'wp_enqueue_scripts', 'aa_func_20163119123146' );
function aa_func_20163119123146()
{

	$template_path = get_stylesheet_directory_uri();
	$bowersrc      = $template_path . "/bower_components/";
	$node_modules  = $template_path . "/node_modules/";
	$production    = WP_DEBUG === false ? ".min" : null;

	// Styles
	wp_enqueue_style( 'vue-material-css', $template_path . "/vue-material/dist/vue-material.css" );
	wp_enqueue_style( 'animate-css', $bowersrc . "animate.css/animate.min.css" );
	wp_enqueue_style( 'google-material-icons', "https://fonts.googleapis.com/icon?family=Material+Icons" );
	wp_enqueue_style( 'google-material-style', $template_path . "/mdl/mdl.css" );
	wp_enqueue_style( 'bootstrap3-style', $bowersrc . "/bootstrap/dist/css/bootstrap.min.css" );
	wp_enqueue_style( 'template-base-styles', get_bloginfo( 'stylesheet_url' ) );

	// Theme jQuery 2.1
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', $template_path . '/script/prod/jQuery2.1.js', [], '2.1', true );
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'google-material-script', $template_path . "/mdl/material.min.js", [], false, true );
	wp_enqueue_script( 'vue-script', $bowersrc . "vue/dist/vue{$production}.js", [], false, true );

	if ( is_amuserpage() ) {
		wp_enqueue_style( 'cropperstyle', $bowersrc . "cropper/dist/cropper.min.css" );
		wp_enqueue_script( 'cropperscript', $bowersrc . "cropper/dist/cropper.min.js", [ 'jquery' ], false, true );
	}

	// Application JS
	wp_enqueue_script( 'AMscript', $template_path . "/script/prod/build{$production}.js", [
		'jquery',
		'vue-script'
	], false, true );

	/**
	 * ==================== Ajax Values ======================
	 * 09.12.2016
	 */
	global $_am;
	$values = [
		'auth_info' => [
			'network_purpose'       => $_am[ 'network-purpose' ],
			'registration_info'     => $_am[ 'network-registration' ],
			'registration_strategy' => $_am[ 'network-confirmation-flow' ]
		]
	];
	$data   = array(
		'baseurl'         => get_site_url(),
		'themeurl'        => get_template_directory_uri(),
		'themepath'       => get_template_directory(),
		'ajaxurl'         => admin_url( 'admin-ajax.php' ),
		'wpApiUrl'        => wpApiUrl(),
		'networkEndpoint' => get_am_network_endpoint(),
		'themeSettings'   => $values,
		'uploadDir'       => wp_upload_dir()[ 'basedir' ],
		'wooOptions'      => __woo_options(),
		'currentUser'     => am_user( get_current_user_id() )
	);
	wp_localize_script( 'AMscript', 'AMdefaults', $data );

}

/**
 * ==================== Admin Scripts ======================
 */
add_action( 'admin_enqueue_scripts', 'aa_func_20163220053219' );
function aa_func_20163220053219()
{
	$template_path = get_stylesheet_directory_uri();
	$cdnjs         = "https://cdnjs.cloudflare.com/ajax/libs/";
	// Font Awesome
	wp_enqueue_style( 'font-awesome', $cdnjs . 'font-awesome/4.6.3/css/font-awesome.min.css' );
	wp_enqueue_style( 'mdl-icons', "https://fonts.googleapis.com/icon?family=Material+Icons" );

	wp_enqueue_style( 'aa-backend-style', $template_path . "/style-parts/backend/init.css" );

	wp_enqueue_script( 'admin-jq-script', $template_path . "/style-parts/backend/script/admin-script.js", [ 'jquery' ], false, true );
}