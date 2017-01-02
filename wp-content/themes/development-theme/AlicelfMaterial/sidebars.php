<?php

register_sidebar( [
		'name'          => 'Default sidebar',
		'id'            => 'default-widgetize-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="wdg-title">',
		'after_title'   => '</h4>'
	]
);

register_sidebar( [
		'name'          => 'Alternative sidebar',
		'id'            => 'alternative-widgetize-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="wdg-title">',
		'after_title'   => '</h4>'
	]
);

/**
 * ==================== Sidebar func ======================
 * @param $sidebar
 * @param $column
 */
if ( ! function_exists( 'aa_sidebar_fn' ) ) {
	function aa_sidebar_fn( $sidebar = 'default-widgetize-sidebar', $column = 3 )
	{
		if ( is_active_sidebar( $sidebar ) ) { ?>
			<aside class="mdl-cell mdl-cell--<?php echo $column ?>-col <?php echo $sidebar ?>-sidebar">
				<?php dynamic_sidebar( $sidebar ); ?>
			</aside>
		<?php }
	}
}