new Vue({

	el: "#am-appwrap",

	router: router,

	data: {
		currency    : amWoo.woo_currency,
		appSettings : AMdefaults,
		confirmProps: {
			show  : false,
			answer: false
		}
	},

	computed: {
		// use dynamic in frontend
		currentUserModel: function() {
			return User.state.userdata;
		}

	},

	created: function() {
		User.commit('setUserdata', currentUser);
		document.addEventListener("DOMContentLoaded", function(e) {
			eventHub.$emit('domloaded', e);
		});
	}

});