<?php
/**
 * ==================== Defaults ======================
 * 26.08.2016
 * npm run tsc
 * npm run tsc:w
 */
add_action( 'wp_head', 'aa_func_20163526113508', 10 );
function aa_func_20163526113508()
{
	$site_url = get_site_url();
	global $_am;
	$values = [
		'auth_info' => [
			'network_purpose'       => $_am[ 'network-purpose' ],
			'registration_info'     => $_am[ 'network-registration' ],
			'registration_strategy' => $_am[ 'network-confirmation-flow' ]
		]
	];
	?>
	<script>
		var AMdefaults = {
			baseurl        : "<?php echo $site_url ?>",
			themeurl       : "<?php echo get_template_directory_uri() ?>",
			themepath      : "<?php echo get_template_directory() ?>",
			ajaxurl        : "<?php echo admin_url( 'admin-ajax.php' ) ?>",
			networkEndpoint: "<?php echo get_am_network_endpoint() ?>",
			themeSettings  : <?php echo json_encode( $values ) ?>,
			uploadDir      : <?php echo json_encode( wp_upload_dir()[ 'basedir' ] )?> +"/",
			wooOptions     : <?php echo json_encode( __woo_options() ) ?>,
		},
		currentUser = <?php echo json_encode(am_user(get_current_user_id())) ?>;
	</script>
	<?php
}

add_action('AM_afterbody_start', 'aa_func_20165123065104', 20);
function aa_func_20165123065104()
{
	if(is_super_admin(get_current_user_id())) {
		?>
		<i title="Show Admin Bar" id="am-show-adminbar" class="material-icons">settings</i>
		<?php
	}
}

add_action( 'admin_head', 'aa_func_20163316093324' );
function aa_func_20163316093324()
{
	$allSidebars = json_encode( $GLOBALS[ 'wp_registered_sidebars' ] );
	?>
	<script>
		var AdminDefaults = {
			editpostId : "<?php echo $_GET[ 'post' ] ?>",
			allSidebars: <?php echo $allSidebars ?>
		};
	</script>
	<?php
}