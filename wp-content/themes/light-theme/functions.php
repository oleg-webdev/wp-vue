<?php
add_action('wp_enqueue_scripts', 'aa_func_20170617070618');
function aa_func_20170617070618()
{
	wp_enqueue_style( 'template-base-styles', get_bloginfo( 'stylesheet_url' ) );
}

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