<?php

use AlicelfMaterial\Helpers\AmFlash;

add_action( 'AM_content', 'aa_func_20172003032058' );
function aa_func_20172003032058()
{
	?>
	<md-dialog-alert class="alert-success-dialog"
	                 :md-type="alertok.type"
	                 :md-content-html="alertok.contentHtml"
	                 :md-ok-text="alertok.text" @close="onClose"
	                 ref="alertOkDialog">
	</md-dialog-alert>
	<md-dialog-alert class="alert-fail-dialog"
	                 :md-type="alertfail.type"
	                 :md-content-html="alertfail.contentHtml"
	                 :md-ok-text="alertfail.text" @close="onClose"
	                 ref="alertFailDialog">
	</md-dialog-alert>

	<flashmessages incomingflashes='<?php echo AmFlash::all( true ) ?>'></flashmessages>
	<?php
	AmFlash::dismissFlashes();
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