<?php

/*
 * Walker Of  Main Menu
 */

class AMenu extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{
		$indent    = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$value     = '';
		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		/* If this item has a dropdown menu, add the 'dropdown' class for Bootstrap */

		$item->hasChildren && $classes[] = 'dropdown';
		in_array( 'current-menu-item', $classes ) && $classes[] = 'active ';

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$render_condition = apply_filters('AMenu_start_elem', $item);

		if($render_condition){
			$output .= $indent . '<li' . $id . $value . $class_names . '>';
		}

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		// new addition for active class on the a tag
		// Add attributes for active link in menu
		$item_output = '<a' . $attributes . '>';
		$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
		if ( $item->hasChildren && $depth == 0 ) {
			$item_output .= '<span class="caret"></span></a>';
		} elseif ( $item->hasChildren && $depth >= 1 ) {
			$item_output .= '<span class="caret right-caret"></span></a>';
		} else {
			$item_output .= '</a>';
		}

		/* Output the actual caret for the user to click on to toggle the menu */
		if ( $item->description ) {
//			$item_output .= "<span>$item->description</span>";
		}

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$end_elem = apply_filters('AMenu_end_elem', $item);
		if($end_elem){
			$output .= "</li>\n";
		}
	}

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output )
	{
		$element->hasChildren = isset( $children_elements[ $element->ID ] ) && ! empty( $children_elements[ $element->ID ] );
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

// Allow HTML descriptions in WordPress Menu
remove_filter( 'nav_menu_description', 'strip_tags' );
add_filter( 'wp_setup_nav_menu_item', 'al_allow_html' );
function al_allow_html( $menu_item )
{
	$menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );

	return $menu_item;
}

add_filter('nav_menu_css_class', 'aa_func_20165524105506', 10, 3);
function aa_func_20165524105506($classes, $item, $args)
{
	// mdl-navigation__link
	if(!in_array('mdl-navigation__link', $classes)) {
		$classes[] = 'mdl-navigation__link';
	}
	return $classes;
}