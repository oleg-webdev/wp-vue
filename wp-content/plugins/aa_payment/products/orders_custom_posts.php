<?php

use Apayment\CustomPosts;

/**
 * ==================== Configure base orders ======================
 * 24.07.2016
 */

add_action( 'wp_loaded', 'aa_func_20160224120244' );
function aa_func_20160224120244()
{
	$labels   = array(
		'name'               => __( 'Order Items' ),
		'singular_name'      => __( 'Order Item' ),
		'add_new'            => __( 'New Order' ),
		'add_new_item'       => 'Add new order item',
		'edit_item'          => 'Edit order item',
		'new_item'           => 'New order item',
		'view_item'          => 'View order item',
		'search_items'       => 'Search order item',
		'not_found'          => 'order item not found',
		'not_found_in_trash' => 'Empty basket order items',
		'parent_item_colon'  => '',
		'menu_name'          => 'Orders'
	);
	$args     = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'order-items' ),
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

	$order_items = new CustomPosts( 'order-items', $labels, $args );
	// can set menu position for example ->run(65)
	$order_items->run(100);
//	$order_items->taxonomy('category_recent', 'Cat Taxonomy', 'slug_tax_recent');
//	$order_items->createField('text','customarray', 'customtext');
//	$order_items->addContextualHelp('Some Contextual text');
//	$order_items->postFormatSupport();
}