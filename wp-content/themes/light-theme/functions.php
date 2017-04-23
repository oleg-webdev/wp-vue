<?php
require "menu/AMenu.php";
/**
 * ==================== Styles / Scripts ======================
 */
add_action('wp_enqueue_scripts', 'aa_func_20170617070618');
function aa_func_20170617070618()
{
	$template_path = get_stylesheet_directory_uri();
	$bowersrc      = $template_path . '/bower_components/';
	$production    = WP_DEBUG === false ? '.min' : null;

	// Slick slider | bower install slick-carousel --save
	// wp_enqueue_style( 'slick-style', $bowersrc . 'slick-carousel/slick/slick.css' );
	// wp_enqueue_script( 'slick-script', $bowersrc . 'slick-carousel/slick/slick.min.js', [ 'jquery' ], false, true );

	// Font Awesome | bower install components-font-awesome --save
	// wp_enqueue_style( 'font-awesome-styles', $bowersrc . 'components-font-awesome/css/font-awesome.min.css' );

	// bower install bootstrap#v4.0.0-alpha.6 --save
	 wp_enqueue_style( 'bootstrap-style', $bowersrc . 'bootstrap/dist/css/bootstrap.min.css' );

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
	 * bower install gsap --save
	 */
//	if( $production ) {
//		// TweenMax animation
//		wp_enqueue_script( 'tween-max',
//			$bowersrc."gsap/src/minified/TweenMax.min.js", ['jquery'], false, true );
//		// ScrollToPlugin
//		wp_enqueue_script( 'scrollto-plugin',
//			$bowersrc."gsap/src/minified/plugins/ScrollToPlugin.min.js",
//			['tween-max'], false, true );
//
//		wp_enqueue_script( 'scrollmagic-script',
//			$bowersrc . 'scrollmagic/scrollmagic/minified/ScrollMagic.min.js', ['jquery'], false, true );
//		wp_enqueue_script( 'scrollmagic-animations',
//			$bowersrc . 'scrollmagic/scrollmagic/minified/plugins/animation.gsap.min.js', ['jquery'], false, true );
//
//	} else {
//		// TweenMax animation
//		wp_enqueue_script( 'tween-max',
//			$bowersrc."gsap/src/uncompressed/TweenMax.js", ['jquery'], false, true );
//		// ScrollToPlugin
//		wp_enqueue_script( 'scrollto-plugin',
//			$bowersrc."gsap/src/uncompressed/plugins/ScrollToPlugin.js",
//			['tween-max'], false, true );
//
//		wp_enqueue_script( 'scrollmagic-script',
//			$bowersrc . 'scrollmagic/scrollmagic/uncompressed/ScrollMagic.js', ['jquery'], false, true );
//		wp_enqueue_script( 'scrollmagic-animations',
//			$bowersrc . 'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap.js', ['jquery'], false, true );
//		wp_enqueue_script( 'scrollmagic-indicators',
//			$bowersrc . 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js',
//			['jquery'], false, true );
//	}

	wp_enqueue_style( 'google-material-icons', '//fonts.googleapis.com/icon?family=Material+Icons' );
	wp_enqueue_style( 'animate-css', $bowersrc . 'animate.css/animate.min.css' );
	wp_enqueue_style( 'template-base-styles', get_bloginfo( 'stylesheet_url' ) );

	// Theme jQuery
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', $bowersrc . 'jquery/dist/jquery.min.js', [], false, true );
	wp_enqueue_script( 'jquery' );

	// Vue Dependency
	wp_enqueue_script( 'vue-script', $bowersrc . "vue/dist/vue{$production}.js", [], false, true );

	// Application JS
	wp_enqueue_script( 'AMscript', $template_path . "/script/prod/build{$production}.js", [
		'jquery',
		'vue-script'
	], false, true );
	$data = [
		'baseurl'         => get_site_url(),
		'themeurl'        => get_template_directory_uri(),
		'themepath'       => get_template_directory(),
		'ajaxurl'         => admin_url( 'admin-ajax.php' ),
		'uploadDir'       => wp_upload_dir()[ 'basedir' ],
		'currentUser'     => get_current_user_id(),
	];
	wp_localize_script( 'AMscript', 'AMdefaults', $data );

}


add_filter( 'comment_form_fields', 'aa_func_20165127075134', 10, 1 );
function aa_func_20165127075134( $fields )
{
	$comment_field = $fields[ 'comment' ];
	unset( $fields[ 'comment' ] );
	$fields[ 'comment' ] = $comment_field;

	return $fields;
}

add_filter( 'comment_form_default_fields', 'aa_func_20165727075708', 10, 1 );
function aa_func_20165727075708( $fields )
{
	$fields[ 'url' ] = null;

	return $fields;
}

remove_action( 'comment_form', 'wp_comment_form_unfiltered_html_nonce' );

/**
 * Get Navigation
 */
function paged_navigation()
{
	if ( function_exists( 'wp_pagenavi' ) ) {
		wp_pagenavi();
	} else {
		echo "<div class='nav-previous'>" . previous_post_link( '&laquo; %link' ) . "</div><div class='nav-next'>" . next_post_link( '%link &raquo;' ) . "</div>";
	}
}