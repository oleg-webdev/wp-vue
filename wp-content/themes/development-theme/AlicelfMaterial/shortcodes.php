<?php

// ============= Preformatted =============
use AlicelfMaterial\Helpers\AmAttachment;

if ( ! function_exists( 'remove_br_from_shortcodes' ) ) {
	add_shortcode( 'remove_br_from_shortcodes', 'remove_br_from_shortcodes' );
	function remove_br_from_shortcodes( $atts = [], $content = null )
	{
		ob_start();
//		$shortcode_data = shortcode_atts( [
//			'params' => $atts[ 'params' ]
//		], $atts );
		echo str_replace( [ '<br>', '<br/>', '<br />', '<p>', '</p>' ], '', do_shortcode( $content ) );

		return ob_get_clean();
	}
}

// ============= Aa_img =============
if ( ! function_exists( 'aa_img' ) ) {
	add_shortcode( 'aa_img', 'aa_img' );
	function aa_img( $args )
	{
		ob_start();
		$_atts      = shortcode_atts( [
			'id'    => $args[ 'id' ],
			'class' => ! empty( $args[ 'class' ] ) ? $args[ 'class' ] : "img-responsive",
		], $args );
		$image_info = AmAttachment::get_attachment( $_atts[ 'id' ] );

		if ( $image_info ) {
			$_url   = $image_info[ 'src' ];
			$_title = $image_info[ 'title' ];
			$_alt   = $image_info[ 'alt' ];
			echo "<img src='{$_url}' class='{$_atts['class']}' alt='{$_alt}' title='{$_title}'>";
		}

		return ob_get_clean();
	}
}

/**
 * ==================== Slider ======================
 * Slick slider shortcode
 */
if ( ! function_exists( 'get_theme_slider' ) ) {
	add_shortcode( 'get_theme_slider', 'get_theme_slider' );
	function get_theme_slider( $atts )
	{
		ob_start();

		global $_am;
		$transition = null;

		switch ( $_am[ 'opt-carouseltransition' ] ) {
			case 2 :
				$transition = 'slider-fade';
				break;
			default :
				$transition = 'slider-slide';
		}

		do_action( 'aa_theme_carousel_process', $transition );

		return ob_get_clean();
	}
}

add_action( 'aa_theme_carousel_process', 'aa_func_20154807014848', 10, 1 );
function aa_func_20154807014848( $transition )
{
	global $_am;
	?>
	<div class="head-banner clearfix">
		<div class="slick-banner" data-amqueried-transition="<?php echo $transition ?>">
			<?php
			foreach ( $_am[ 'opt-slides' ] as $slide ) {
				?>
				<div>
					<div class="animated-inner-content">
						<hgroup
							data-animation="fadeInLeft" data-animation-out="fadeOutRight" data-delay="0.5s">
							<h1><?php echo $slide[ 'title' ] ?></h1>
							<h2><?php echo $slide[ 'description' ] ?></h2>
							<?php if(!empty($slide[ 'url' ])) echo $slide[ 'url' ] ?>
						</hgroup>
					</div>
					<img class="mainbg" src="<?php echo $slide[ 'image' ] ?>" alt="<?php echo $slide[ 'title' ] ?>">
				</div>
				<?php
			}
			?>
		</div>
		<i class="material-icons prevarrow slidernavs">keyboard_arrow_left</i>
		<i class="material-icons nextarrow slidernavs">keyboard_arrow_right</i>
	</div>
	<?php
}