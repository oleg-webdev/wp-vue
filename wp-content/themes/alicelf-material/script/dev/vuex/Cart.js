var Cart = new Vuex.Store({

	state: {
		products: []
	},

	mutations: {

		setProducts: function(state, data) {
			state.products = data;
		},

		removeFromCart: function(state, data) {
			state.products.splice(state.products.indexOf(data), 1);
		}

	},

	actions: {}

});