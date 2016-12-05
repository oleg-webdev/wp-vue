<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<div class="am-wrap">
	<div class="mdl-grid">
		<div class="mdl-cell--12-col">

			<?php do_action( 'woocommerce_before_main_content' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php wc_get_template_part( 'content', 'single-product' ); ?>
			<?php endwhile; // end of the loop. ?>
			<?php do_action( 'woocommerce_after_main_content' ); ?>
		</div>
	</div>
</div>
<?php get_footer( 'shop' ); ?>
