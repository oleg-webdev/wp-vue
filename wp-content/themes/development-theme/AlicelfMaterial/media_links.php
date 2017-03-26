<?php
/**
 * ==================== Frontend Scripts ======================
 * 22.09.2016
 */
add_action( 'wp_enqueue_scripts', 'aa_func_20163119123146' );
function aa_func_20163119123146()
{

	$template_path = get_stylesheet_directory_uri();
	$bowersrc      = $template_path . '/bower_components/';
	$node_modules  = $template_path . '/node_modules/';
	$production    = WP_DEBUG === false ? '.min' : null;

	// Slick slider | bower install slick-carousel --save
	// wp_enqueue_style( 'slick-style', $bowersrc . 'slick-carousel/slick/slick.css' );
	// wp_enqueue_script( 'slick-script', $bowersrc . 'slick-carousel/slick/slick.min.js', [ 'jquery' ], false, true );

	// Font Awesome | bower install components-font-awesome --save
	// wp_enqueue_style( 'font-awesome-styles', $bowersrc . 'components-font-awesome/css/font-awesome.min.css' );

	// Lightbox | bower install lightbox2 --save
	// wp_enqueue_style( 'lightbox-css', $bowersrc . 'lightbox2/dist/css/lightbox.min.css' );
	// wp_enqueue_script( 'lightbox-js', $bowersrc . 'lightbox2/dist/js/lightbox.min.js', [ 'jquery' ], false, true );

	// Custom Scrollbar | bower install malihu-custom-scrollbar-plugin --save
	// wp_enqueue_style( 'scroll-style',
	//		$bowersrc . 'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css' );
	// wp_enqueue_script( 'scroll-script',
	//		$bowersrc . 'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js', ['jquery'], false, true );

	/**
	 * ==================== Scrollmagic ======================
	 * bower install scrollmagic --save
	 */
//	wp_enqueue_script( 'tween-max',
//		"//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js", ['jquery'], false, true );
//	wp_enqueue_script( 'scrollto-plugin',
//		"//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/plugins/ScrollToPlugin.min.js", ['jquery'], false, true );
//
//	if( $production ) {
//		wp_enqueue_script( 'scrollmagic-script',
//			$bowersrc . 'scrollmagic/scrollmagic/minified/Scrollmagic.min.js', ['jquery'], false, true );
//		wp_enqueue_script( 'scrollmagic-animations',
//			$bowersrc . 'scrollmagic/scrollmagic/minified/plugins/animation.gsap.min.js', ['jquery'], false, true );
//	} else {
//		wp_enqueue_script( 'scrollmagic-script',
//			$bowersrc . 'scrollmagic/scrollmagic/uncompressed/Scrollmagic.js', ['jquery'], false, true );
//		wp_enqueue_script( 'scrollmagic-animations',
//			$bowersrc . 'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap.js', ['jquery'], false, true );
//		wp_enqueue_script( 'scrollmagic-indicators',
//			$bowersrc . 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js',
//			['jquery'], false, true );
//	}

	// MDL
	wp_enqueue_style( 'google-material-icons', '//fonts.googleapis.com/icon?family=Material+Icons' );
	wp_enqueue_style( 'google-mdl-style', $template_path . '/mdl/mdl.css' );
	wp_enqueue_script( 'google-material-script', $template_path . '/mdl/material.min.js', [], false, true );

	// Styles
	wp_enqueue_style( 'animate-css', $bowersrc . 'animate.css/animate.min.css' );

//	wp_enqueue_style( 'bootstrap3-style', $bowersrc . 'bootstrap/dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'template-base-styles', get_bloginfo( 'stylesheet_url' ) );

	// Theme jQuery 3+
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', $bowersrc . 'jquery/dist/jquery.min.js', [], false, true );
	wp_enqueue_script( 'jquery' );

	// Vue-material
	wp_enqueue_style( 'vue-material-style', $template_path . '/vue-material/dist/vue-material.css' );
	// Vue lib
	wp_enqueue_script( 'vue-script', $bowersrc . "vue/dist/vue{$production}.js", [], false, true );

	if ( is_amuserpage() ) {
//		wp_enqueue_style( 'cropperstyle', $bowersrc . 'cropper/dist/cropper.min.css' );
//		wp_enqueue_script( 'cropperscript', $bowersrc . 'cropper/dist/cropper.min.js', [ 'jquery' ], false, true );
	}

	// Application JS
	wp_enqueue_script( 'AMscript', $template_path . "/script/prod/build{$production}.js", [
		'jquery',
//		'vue-script'
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

	$routerPrefix = '';
	//	$routerPrefix = 'projects/someproject/';
	$data = [
		'baseurl'         => get_site_url(),
		'themeurl'        => get_template_directory_uri(),
		'themepath'       => get_template_directory(),
		'ajaxurl'         => admin_url( 'admin-ajax.php' ),
		'wpApiUrl'        => wpApiUrl(),
		'networkEndpoint' => get_am_network_endpoint(),
		'themeSettings'   => $values,
		'uploadDir'       => wp_upload_dir()[ 'basedir' ],
		'wooOptions'      => __woo_options(),
		'currentUser'     => am_user( get_current_user_id() ),
		'routerPrefix'    => $routerPrefix,
		'networkSlug'     => am_profile_slug()
	];
	wp_localize_script( 'AMscript', 'AMdefaults', $data );

}

/**
 * ==================== Admin Scripts ======================
 */
add_action( 'admin_enqueue_scripts', 'aa_func_20163220053219' );
function aa_func_20163220053219()
{
	$template_path = get_stylesheet_directory_uri();
	$cdnjs         = "//cdnjs.cloudflare.com/ajax/libs/";
	// Font Awesome
	wp_enqueue_style( 'font-awesome', $cdnjs . 'font-awesome/4.6.3/css/font-awesome.min.css' );
	wp_enqueue_style( 'mdl-icons', "//fonts.googleapis.com/icon?family=Material+Icons" );

	wp_enqueue_style( 'aa-backend-style', $template_path . "/style-parts/backend/init.css" );

	wp_enqueue_script( 'admin-jq-script', $template_path . "/style-parts/backend/script/admin-script.js", [ 'jquery' ], false, true );
}