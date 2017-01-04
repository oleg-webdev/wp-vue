module.exports = new Vuex.Store({

	state: {
		userdata: null
	},

	mutations: {

		setUserdata(state, data) {
			state.userdata = data
		}

	},

	actions: {

	},

	created: function() {
		console.log(this.state.userdata);
	}


});