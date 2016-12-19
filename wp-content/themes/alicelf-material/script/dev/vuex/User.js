module.exports = new Vuex.Store({

	state: {
		userdata: null
	},

	mutations: {

		setUserdata: function(state, data) {
			state.userdata = data;
		}

	},

	created: function() {
		console.log(this.state.userdata);
	}


});