<?php
add_action( 'wp_head', 'aa_func_20165020025046' );
function aa_func_20165020025046()
{
	global $_am;
	$width = $_am[ 'opt-site-width' ];
	$_typo = $_am[ 'opt-typography-p' ];
	?>
	<style type="text/css">
		/**
		 * ==================== Main size ======================
		 * 20.08.2016
		 */
		@media (min-width : <?php echo $width ?>px) {
			.am-wrap {
				max-width    : <?php echo $width ?>px;
				width        : 100%;
				margin-left  : auto;
				margin-right : auto;
			}
		}

		/**
		 * ==================== To mobile ======================
		 * 20.08.2016
		 */
		@media (max-width : <?php echo $width-1 ?>px) {
			.am-wrap {
				padding-left  : 15px;
				padding-right : 15px;
			}
		}

		body {
			font-family      : <?php echo $_typo['font-family'] ?>;
			font-size        : <?php echo $_typo['font-size'] ?>;
			line-height      : <?php echo $_typo['line-height'] ?>;
			color            : <?php echo $_typo['color'] ?>;
			background-color : <?php echo $_am['bg-color'] ?>;
		}

		/**
		 * ==================== Typography ======================
		 */
	</style>
	<?php

}