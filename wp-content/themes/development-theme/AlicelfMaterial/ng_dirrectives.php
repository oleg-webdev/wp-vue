<?php

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