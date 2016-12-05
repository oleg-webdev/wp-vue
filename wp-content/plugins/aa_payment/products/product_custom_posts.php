<?php

use Apayment\CustomPosts;

/**
 * ==================== Configure base products ======================
 * 24.07.2016
 *
 */

$product_post_type = 'product-items';
add_action( 'wp_loaded', 'aa_func_20164024114019' );
function aa_func_20164024114019()
{
	$labels   = array(
		'name'               => __( 'Product Items' ),
		'singular_name'      => __( 'Product Item' ),
		'add_new'            => __( 'New Product' ),
		'add_new_item'       => 'Add new product item',
		'edit_item'          => 'Edit product item',
		'new_item'           => 'New product item',
		'view_item'          => 'View product item',
		'search_items'       => 'Search product item',
		'not_found'          => 'product item not found',
		'not_found_in_trash' => 'Empty basket product items',
		'parent_item_colon'  => '',
		'menu_name'          => 'Products'
	);
	$args     = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'product-items' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'taxonomies'         => array( 'category', 'post_tag' ),
		'supports'           => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'comments',
			'custom-fields',
			'page-attributes'
		)
	);

	$product_items = new CustomPosts( 'product-items', $labels, $args );
	// can set menu position for example ->run(65)
	$product_items->run(100);
//	$product_items->taxonomy('category_recent', 'Cat Taxonomy', 'slug_tax_recent');
//	$product_items->createField('text','customarray', 'customtext');
//	$product_items->addContextualHelp('Some Contextual text');
//	$product_items->postFormatSupport();
}