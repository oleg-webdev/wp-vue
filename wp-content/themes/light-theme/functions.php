<?php
require "includes/template-functions.php";
require "includes/template-actions.php";
require "plugin_deps/init.php";
require "includes/opitons.php";
require "menu/AMenu.php";
require "includes/media_links.php";

//wp_nav_menu( [ 'theme_location' => 'primary', ] );
register_nav_menus( [
	'primary'     => 'Primary Navigation',
	'footer_menu' => 'Footer menu',
] );

// aa_sidebar_fn( $sidebar, $col )
register_sidebar( [
		'name'          => 'Default sidebar',
		'id'            => 'default-widgetize-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="wdg-title">',
		'after_title'   => '</h4>'
	]
);