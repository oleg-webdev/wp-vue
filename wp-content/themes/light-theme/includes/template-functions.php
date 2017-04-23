<?php
if ( ! function_exists( 'browser_info' ) ) {
	/**
	 * @return string
	 */
	function browser_info()
	{
		if ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'MSIE' ) !== false
		     || strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Trident' ) !== false
		) {
			$browser = 'edge-iexplorer';

		} elseif ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Chrome' ) !== false ) {
			$browser = 'google-chrome';

		} elseif ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Firefox' ) !== false ) {
			$browser = 'mozilla-firefox';

		} elseif ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Opera' ) !== false ) {
			$browser = 'opera';

		} elseif ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Safari' ) !== false ) {
			$browser = 'apple-safari';

		} else {
			$browser = 'unknown-browser';
		}

		return $browser;
	}
}

/**
 * ==================== Sidebar func ======================
 *
 * @param $sidebar
 * @param $column
 */
if ( ! function_exists( 'aa_sidebar_fn' ) ) {
	function aa_sidebar_fn( $sidebar = 'default-widgetize-sidebar', $column = 4 )
	{
		if ( is_active_sidebar( $sidebar ) ) { ?>
			<aside class="col-md-<?php echo $column ?> col-12 <?php echo $sidebar ?>">
				<?php dynamic_sidebar( $sidebar ); ?>
			</aside>
		<?php }
	}
}

if ( ! function_exists( 'paged_navigation' ) ) {
	/**
	 * Paged Nav
	 */
	function paged_navigation()
	{
		if ( function_exists( 'wp_pagenavi' ) ) {
			wp_pagenavi();
		} else {
			echo "<div class='nav-previous'>" . previous_post_link( '&laquo; %link' ) . "</div><div class='nav-next'>" . next_post_link( '%link &raquo;' ) . "</div>";
		}
	}
}