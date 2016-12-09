<?php
add_action( 'AM_afterbody_start', 'aa_func_20165123065104', 20 );
function aa_func_20165123065104()
{
	if ( is_super_admin( get_current_user_id() ) ) {
		?>
		<i title="Show Admin Bar" id="am-show-adminbar" class="material-icons">settings</i>
		<?php
	}
}

add_action( 'admin_head', 'aa_func_20163316093324' );
function aa_func_20163316093324()
{
	$allSidebars = json_encode( $GLOBALS[ 'wp_registered_sidebars' ] );
	$editpostId  = isset( $_GET[ 'post' ] ) ? $_GET[ 'post' ] : "";
	?>
	<script>
		var AdminDefaults = {
			editpostId : "<?php echo $editpostId ?>",
			allSidebars: <?php echo $allSidebars ?>
		};
	</script>
	<?php
}