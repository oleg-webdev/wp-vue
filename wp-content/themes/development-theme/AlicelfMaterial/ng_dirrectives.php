<?php
add_action('AM_content', 'aa_func_20172003032058');
function aa_func_20172003032058()
{
	?>
	<md-dialog-alert class="alert-success-dialog"
		:md-type="alertok.type"
		:md-content="alertok.content"
		:md-ok-text="alertok.text" @close="onClose"
		ref="alertOkDialog">
	</md-dialog-alert>
	<md-dialog-alert class="alert-fail-dialog"
	  :md-type="alertfail.type"
		:md-content="alertfail.content"
		:md-ok-text="alertfail.text" @close="onClose"
		ref="alertFailDialog">
	</md-dialog-alert>
<!--	<div class="am-wrap">-->
<!--		<form method="post" role="form" v-amajax>-->
<!--			<input type="hidden" name="__method" value="post"/>-->
<!--			<input type="hidden" name="__action" value="ajx20174803014813"/>-->
<!---->
<!--			<div class="form-group">-->
<!--				<input type="text" class="form-control" name="" placeholder="Input...">-->
<!--			</div>-->
<!---->
<!--			<button type="submit" class="btn btn-primary">Submit</button>-->
<!--		</form>-->
<!--	</div>-->
	<?php
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