<?php

if ( ! function_exists( '__woo_options' ) ) {
	function __woo_options()
	{
		if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			return [];
		}

		return [
			'woocommerce_shop_page_id'         => get_option( 'woocommerce_shop_page_id' ),
			'woocommerce_cart_page_id'         => get_option( 'woocommerce_cart_page_id' ),
			'woocommerce_checkout_page_id'     => get_option( 'woocommerce_checkout_page_id' ),
			'woocommerce_pay_page_id'          => get_option( 'woocommerce_pay_page_id' ),
			'woocommerce_thanks_page_id'       => get_option( 'woocommerce_thanks_page_id' ),
			'woocommerce_myaccount_page_id'    => get_option( 'woocommerce_myaccount_page_id' ),
			'woocommerce_edit_address_page_id' => get_option( 'woocommerce_edit_address_page_id' ),
			'woocommerce_view_order_page_id'   => get_option( 'woocommerce_view_order_page_id' ),
			'woocommerce_terms_page_id'        => get_option( 'woocommerce_terms_page_id' ),
			'woo_currency'                     => get_woocommerce_currency_symbol()
		];
	}
}

/**
 * ==================== Shop Title ======================
 * 19.08.2016
 */
add_action( 'wp_title', 'aa_func_20162619062655', 11, 1 );
function aa_func_20162619062655( $title )
{
	$woo_presets = __woo_options();
	if ( function_exists( 'is_shop' ) ) {
		if ( is_shop() ) {
			$title = get_the_title( $woo_presets[ 'woocommerce_shop_page_id' ] ) . " | " . get_bloginfo( 'name' );
		}
	}

	return $title;
}

/**
 * ==================== Minicart A2 root ======================
 * 12.11.2016
 */
add_filter( 'walker_nav_menu_start_el', 'aa_func_20160912040959', 10, 4 );
function aa_func_20160912040959( $item_output, $item, $depth, $args )
{
	// vuecart-class
	if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		$woo_options = __woo_options();
		$cart_id     = $woo_options[ 'woocommerce_cart_page_id' ];
		if ( $cart_id === $item->object_id && in_array( 'vuecart-class', $item->classes ) && ! is_admin() ) {
			$cls         = join( " ", $item->classes );
			$item_output = "<li id='minicart-menu-item-{$item->ID}' class='{$cls} minicart-menu-item'>";
			$item_output .= "<a class='mdl-navigation__link'>";
			$item_output .= "<minicart></minicart>";
			$item_output .= "</a>";
			$item_output .= "</li>";
		}
	}

	return $item_output;
}

// Remove Unnecesarry LI elem
add_filter( 'AMenu_start_elem', 'aa_func_20162112052129', 20, 1 );
add_filter( 'AMenu_end_elem', 'aa_func_20162112052129', 20, 1 );
function aa_func_20162112052129( $item )
{
	$woo_options = __woo_options();
	$cart_id     = $woo_options[ 'woocommerce_cart_page_id' ];
	if ( $cart_id === $item->object_id && in_array( 'vuecart-class', $item->classes ) && ! is_admin() ) {
		$item = null;
	}

	return $item;
}

add_action( 'AM_afterbody_start', 'aa_func_20164929064928' );
function aa_func_20164929064928()
{
	?>
	<template id="minicart-template" xmlns:v-bind="http://www.w3.org/1999/xhtml">
		<div class="minicart-template-holder">

			<button class="mdl-button mdl-js-button mdl-button--icon" @click="toggleCart">
				<i class="material-icons mdl-badge mdl-badge--overlap" :data-badge="totalCart">shopping_cart</i>
			</button>

			<!--				enter-active-class="animated bounceIn"-->
			<!--				leave-active-class="animated bounceOut"-->
			<transition name="fademinicart">

			<div class="mdl-list transition-default" v-show="cartOpened">

				<div v-for="(item, index) in cartItemsData" class="mdl-list__item">
					<div class="mdl-list__item-primary-content">
						<figure><a :href="item.permalink"><img :src="item.images[0]" :alt="item.product.post_title"></a></figure>
						<div class="cart-item-description">
							<p class="product-title">{{item.product.post_title}}</p>
							<p class="product-title"><span v-html="currency"></span>{{item.price}} x {{item.qty}}</p>
						</div>
					</div>
					<button @click="removeFromCart(item, index, $event)"
					        class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--mini-fab">
						<i class="material-icons">clear</i>
					</button>
				</div>

			</div>
			</transition>

		</div>
	</template>
	<?php
}

// quick fix
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'aa_func_20161001101051', 10, 1);
function aa_func_20161001101051($html)
{

	$html = str_replace('"" data-show_option_none="', '" data-show_option_none="', $html);
	return $html;
}