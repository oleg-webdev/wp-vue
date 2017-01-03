<style lang="scss">

</style>
<template id="minicart-template">
	<div class="minicart-template-holder">

		<button class="mdl-button mdl-js-button mdl-button--icon" @click="toggleCart">
			<i class="material-icons mdl-badge mdl-badge--overlap" :data-badge="totalCart">shopping_cart</i>
		</button>

		<!--enter-active-class="animated bounceIn"-->
		<!--leave-active-class="animated bounceOut"-->
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

<script>
	import Cart from '../../vuex/Cart'
	export default {
		// Fields
		data: function() {
			return {
				cartOpened: false,
				currency  : null
			}
		},

		// Dynamic Fields
		computed: {
			totalCart: function() {
				return this.cartItemsData.length;
			},

			cartItemsData: function() {
				return Cart.state.products;
			}

		},

		// Constructor
		created: function() {
			this.fetchCart();
			var vm = this;
			this.currency = this.pd().currency;

			eventHub.$on('domloaded', function(e) {
				document.getElementById('am-appwrap')
					.addEventListener('click', function(e) {
						var parentEl = $(e.target).parents('.minicart-template-holder').length;
						if (!parentEl) {
							vm.cartOpened = false;
						}
					});
			});

		},

		// Methods
		methods: {
			pd: function() {
				return this.$parent.$data;
			},

			fetchCart: function() {
				this.$http.get(AMdefaults.ajaxurl + "?action=ajx20161412071430")
					.then(function(response) {
						Cart.commit('setProducts', JSON.parse(response.body));
					});
			},

			removeFromCart: function(item, index, event) {
				const removeData = dataToPost('ajx20163730073701', item);
				Cart.commit('removeFromCart', item);
				this.$http.post(AMdefaults.ajaxurl, removeData).then(function(response) {
//					console.log(JSON.parse(response.data));
				});
			},

			toggleCart: function() {
				this.cartOpened = !this.cartOpened;
			}
		}
	}
</script>