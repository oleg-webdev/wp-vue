var User = new Vuex.Store({

	state: {
		userdata: null
	},

	mutations: {

		setUserdata: function(state, data) {
			state.userdata = data;
		}

	}

});