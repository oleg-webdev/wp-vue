new Vue({

	el: "#am-appwrap",

	router: router,

	data: {
		currency    : amWoo.woo_currency,
		appSettings : AMdefaults,
		authInfo    : AMdefaults.themeSettings.auth_info,
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
		User.commit('setUserdata', AMdefaults.currentUser);
		document.addEventListener("DOMContentLoaded", function(e) {
			eventHub.$emit('domloaded', e);
		});
		// this.$http.get(AMdefaults.wpApiUrl+"posts")
		// 	.then(function(response) {
		// 		console.log(response.data);
		// 	});
	}

});