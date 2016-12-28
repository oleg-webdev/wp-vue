window.eventHub = new Vue()
window.Vuex = require('vuex')
window.VueResource = require('vue-resource')
window.VueMaterial = require('vue-material')
Vue.use(VueMaterial)

Vue.material.registerTheme({
	default: {
		primary: {
			color: 'blue-grey',
			hue: 600
		},
		accent: 'black'
	}
})

Vue.component('minicart', require('./components/WooCart/index.vue'))
Vue.component('userprofile', require('./components/Profile/index.vue'))
var CurrentUser = require('./vuex/User')

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
		var vm = this;
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