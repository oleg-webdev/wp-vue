Vue.component('minicart', require('./components/WooCart/index.vue'))
window.VueResource = require('vue-resource')
var CurrentUser = require('./vuex/User')

window.eventHub = new Vue()
var router = require('./routes')
require('./script')

var amWoo = AMdefaults.wooOptions;

new Vue({
	'router':router,

	el: "#am-appwrap",

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
			return CurrentUser.state.userdata;
		}

	},

	created: function() {
		CurrentUser.commit('setUserdata', AMdefaults.currentUser);
		document.addEventListener("DOMContentLoaded", function(e) {
			eventHub.$emit('domloaded', e);
		});
	},

	methods: {

		clickHandler: function (event) {
			console.log(event.target.tagName);
		}

	}

});