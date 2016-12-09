<?php
// Recognize menu location by id
if ( ! function_exists( 'get_menu_loc_by_id' ) ) {
	function get_menu_loc_by_id( $nav_menu_selected_id )
	{
		$_menu           = wp_get_nav_menu_object( $nav_menu_selected_id )->term_id;
		$theme_locations = get_nav_menu_locations();

		return array_search( $_menu, $theme_locations );
	}
}

// append media script to menu page
add_action( 'admin_head', 'aa_func_20165429115424' );
function aa_func_20165429115424()
{
	$screen = get_current_screen();
	if ( $screen->id === 'nav-menus' )
		wp_enqueue_media();
}


// Change default admin menu screen
add_filter( 'wp_edit_nav_menu_walker', 'custom_nav_edit_walker', 10, 1 );
function custom_nav_edit_walker( $menu_id )
{
	return 'AMenuAdminScreen';
}

// Allow HTML descriptions in menu
remove_filter( 'nav_menu_description', 'strip_tags' );
add_filter( 'wp_setup_nav_menu_item', 'al_allow_html' );
function al_allow_html( $menu_item )
{
	$menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );

	return $menu_item;
}

// Add custom menu item class in frontend
add_filter( 'nav_menu_css_class', 'aa_func_20165524105506', 10, 3 );
function aa_func_20165524105506( $classes, $item, $args )
{
	if ( ! in_array( 'mdl-navigation__link', $classes ) ) {
		$classes[] = 'mdl-navigation__link';
	}

	return $classes;
}

/**
 * ==================== Frontend render ======================
 */
add_filter( 'AMenu_start_elem', 'aa_func_20161009061036', 10, 1 );
function aa_func_20161009061036( $item )
{
	// Skip Vue cart item
	if ( ! in_array( 'vuecart-class', $item->classes ) && ! is_admin() ) {

	}
	return $item;
}

/**
 * ==================== Backend ======================
 */
add_action('admin__menu_item_before', 'aa_func_20160809080813', 10 ,1);
function aa_func_20160809080813($item)
{

}