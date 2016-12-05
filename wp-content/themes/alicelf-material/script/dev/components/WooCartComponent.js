Vue.component('minicart', {

	template: '#minicart-template',

	// Fields
	data: function() {
		return {
			cartItems : [],
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
					if(!parentEl) {
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

		removeFromCart: function(item, index) {
			var removeData = dataToPost('ajx20163730073701', item);
			this.$http.post(AMdefaults.ajaxurl, removeData).then(function(response) {});
			Cart.commit('removeFromCart', item);
		},

		toggleCart: function() {
			this.cartOpened = !this.cartOpened;
		}
	}

});

