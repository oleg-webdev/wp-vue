<?php
use AlicelfMaterial\Helpers\AmDb;

add_action( 'admin_head', 'aa_set_favicon' );
add_action( 'wp_head', 'aa_set_favicon' );
function aa_set_favicon()
{
	global $_am;
	$output = null;
	if ( ! empty( $_am[ 'opt-favicon' ][ 'url' ] ) )
		$output = "<link rel='icon' type='image/png' href='{$_am['opt-favicon']['url']}'>";
	else
		$output = "<link rel='icon' type='image/png' href='" . get_template_directory_uri() . "/img/site-favicon.png'>";

	echo $output;
}

/**
 * ==================== Deploy additional tables ======================
 */
add_action( 'after_switch_theme', 'aa_func_20161027071039' );
function aa_func_20161027071039()
{
	// text, varchar, int
	$fields = [
		[ 'hash', 'varchar' ],
		[ 'email', 'varchar' ],
		[ 'action', 'varchar' ], // reset or activation
		[ 'time', 'datetime' ]
	];
	AmDb::createTable( 'user_reset_passwords', $fields, true );
}

/**
 * ==================== WP Check Authentification ======================
 * 17.11.2016
 */
add_action( 'admin_init', 'aa_func_20165217065225' );
function aa_func_20165217065225()
{
	global $_am;
	if ( $_am[ 'disable-regular-wplogin' ] === 'yes' ) {
		remove_action( 'admin_enqueue_scripts', 'wp_auth_check_load' );
	}
}

/**
 * ==================== Supports ======================
 * 26.11.2016
 */
add_theme_support( 'post-thumbnails' );
add_filter( 'widget_text', 'do_shortcode' );

/**
 * ==================== WOOcommerce ======================
 */
add_theme_support( 'woocommerce' );
//add_theme_support( 'wc-product-gallery-zoom' );
//add_theme_support( 'wc-product-gallery-lightbox' );
//add_theme_support( 'wc-product-gallery-slider' );
//add_filter( 'woocommerce_ajax_variation_threshold', 'aa_func_20173416083401', 10, 2 );
//function aa_func_20173416083401( $qty, $product )
//{
//	return 60;
//}

//add_filter( 'automatic_updater_disabled', '__return_true' );

if ( ! current_user_can( 'manage_options' ) ) {
	show_admin_bar( false );
}

add_filter( 'wp_revisions_to_keep', 'custom_revisions_number', 10, 2 );
function custom_revisions_number( $num, $post )
{
	$num = 3;

	return $num;
}

/**
 * Restict duplicate images with different sizes
 *
 * @param $sizes
 */
add_filter( 'intermediate_image_sizes_advanced', 'aa_func_20162612122629', 10, 1 );
function aa_func_20162612122629( $sizes )
{
	//	unset( $sizes[ 'thumbnail' ] );
	unset( $sizes[ 'medium' ] );
	unset( $sizes[ 'large' ] );

	return $sizes;
}

/**
 * ==================== Change Title Defaults ======================
 * 19.08.2016
 */
add_filter( 'wp_title', 'aa_func_20164019094058', 10, 1 );
function aa_func_20164019094058( $title )
{
	if ( is_home() || is_front_page() ) {
		$title = get_bloginfo( 'name' ) . " | " . get_bloginfo( 'description', 'display' );
	} else if ( is_404() ) {
		$title = get_bloginfo( 'name' ) . ' | .404!';
	} else if ( is_search() ) {
		$title = get_bloginfo( 'name' ) . " | Search " . get_search_query();
	} else {
		$title = get_the_title() . " | " . get_bloginfo( 'name' );
	}

	return $title;
}

add_action( 'admin_print_footer_scripts', 'aa_func_20164419044418' );
function aa_func_20164419044418()
{
	if ( wp_script_is( 'quicktags' ) ) {
		?>
		<script type="text/javascript">
			QTags.addButton('ghostly_wrap', 'Wrap', '<div class="am-wrap">', '</div>', 'p', 'Wrap', 140);
		</script>
		<?php
	}
}

/**
 * ==================== Custom style ======================
 * 19.09.2016
 */
add_action( 'wp_head', 'aa_func_20163901013945', 30 );
function aa_func_20163901013945()
{
	global $_am;
	if ( ! empty( $_am[ 'opt-snippet-css' ] ) )
		echo "<style>{$_am['opt-snippet-css']}</style>";

	/**
	 * ==================== Page Custom Style ======================
	 * 16.10.2016
	 */
	$post_id = get_the_ID();
	if ( get_post_type( $post_id ) === 'page' ) {
		$pagestyle = get_post_meta( $post_id, 'page_custom_style', true );
		if ( ! empty( $pagestyle ) ) {
			echo "<style>";
			echo $pagestyle;
			echo "</style>";
		}
	}
}

/**
 * ==================== Page Custom Script ======================
 * 16.10.2016
 */
add_action( 'wp_footer', 'aa_func_20164416084407', 99 );
function aa_func_20164416084407()
{
	$post_id = get_the_ID();
	if ( get_post_type( $post_id ) === 'page' ) {
		$pagestyle = get_post_meta( $post_id, 'page_custom_script', true );
		if ( ! empty( $pagestyle ) ) {
			echo "<script>";
			echo $pagestyle;
			echo "</script>";
		}
	}
}

/**
 * ==================== JS after body tag ======================
 * 01.06.2016
 */
add_action( 'AM_afterbody_start', 'aa_func_20165314065329', 10 );
function aa_func_20165314065329()
{
	global $_am;
	if ( ! empty( $_am[ 'opt-snippet-js' ] ) )
		echo "<script>{$_am['opt-snippet-js']}</script>";
}

add_action( 'admin_init', 'aa_func_20164902064936' );
function aa_func_20164902064936()
{
	add_meta_box(
		'am_network_endpoints',
		"Network Endpoints",
		'func_20160802070842',
		'nav-menus',
		'side',
		'low'
	);
}

if ( ! function_exists( 'func_20160802070842' ) ) {
	function func_20160802070842()
	{
		$box_id       = "networks-endpoints-id";
		$net_endpoint = get_am_network_endpoint() . "#";
		?>
		<div id="<?php echo $box_id ?>" class="posttypediv">
			<div id="tabs-panel-wishlist-login" class="tabs-panel tabs-panel-active">
				<ul id="wishlist-login-checklist" class="categorychecklist form-no-clear">
					<li>
						<label class="menu-item-title">
							<input type="checkbox" name="menu-item[-1][menu-item-object-id]" value="-1">
							Network
						</label>
						<input type="hidden" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" name="menu-item[-1][menu-item-object]" value="network_link">
						<input type="hidden" name="menu-item[-1][menu-item-title]" value="Network">
						<input type="hidden" name="menu-item[-1][menu-item-url]" value="<?php echo $net_endpoint ?>">
						<input type="hidden" name="menu-item[-1][menu-item-classes]" value="network-classes">
					</li>
				</ul>
			</div>
			<div class="button-controls">
				<span class="list-controls">
					<a href="<?php echo get_site_url() ?>/wp-admin/nav-menus.php?page-tab=all&amp;selectall=1#<?php echo $box_id ?>" class="select-all">Select All</a>
				</span>
				<span class="add-to-menu">
					<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-<?php echo $box_id ?>"><span class="spinner"></span>
				</span>
			</div>
		</div>
		<?php
	}
}

/**
 * ==================== Page Options ======================
 * 12.11.2016
 */
add_action( 'aa_page_loop_start', 'aa_func_20163812013800', 10 );
function aa_func_20163812013800()
{
	// define( 'WPCF7_AUTOP', false ); add this to wp-config

	if ( get_field( 'remove_autoformat', get_the_ID() ) ) {
		remove_filter( 'the_content', 'wpautop' );
		remove_filter( 'the_excerpt', 'wpautop' );
	}
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
 * ==================== Featured Image for page ======================
 * 14.01.2017
 */
//add_action( 'aa_page_loop_start', 'aa_func_20174614064631', 10, 1 );
function aa_func_20174614064631( $id )
{
	$image    = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
	$_height  = $image[ 2 ];
	$subtitle = get_field( 'page_subtitle', $id );

	?>
	<div class="row regular-page-banner">
		<header class='image-overlap'>
			<?php if ( $image )
				echo "<img id='toppage-image' src='{$image[0]}'>"; ?>
			<div class="inner-elems">
				<div class="ghostly-wrap flex-container">
					<div class="flex-col-100 title-column">
						<?php echo $subtitle ?>
					</div>
				</div>
			</div>
		</header>
	</div>
	<?php
}

// ============= Show_bottom_arrow =============
if ( ! function_exists( 'show_bottom_arrow' ) ) {
	function show_bottom_arrow()
	{
		global $_am;

		return (bool) $_am[ 'show-up-button-link' ];
	}
}

add_action( 'AM_afterbody_start', 'aa_func_20173515073527' );
function aa_func_20173515073527()
{
	if ( show_bottom_arrow() ) {
		?>
		<span id="document-start-point" style="position: absolute; top: 0; left: 0;"></span>
		<?php
	}
}

add_action( 'before_AM_wrap_ends', 'aa_func_20170715050728' );
function aa_func_20170715050728()
{
	if ( show_bottom_arrow() ) {
		?>
		<a href="#document-start-point" id="trigger-top-button"
			 class="onscroll-appearing" data-smoth-trigger>
			<i class="material-icons">navigation</i>
		</a>
		<?php
	}
}