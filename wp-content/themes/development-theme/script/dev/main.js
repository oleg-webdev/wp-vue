window.eventHub = new Vue()
window.Vuex = require('vuex')
window.VueResource = require('vue-resource')
window.VueMaterial = require('vue-material')
Vue.use(VueMaterial)
require('./dirrectives/ajaxForms')

Vue.material.registerTheme({
	default: {
		primary: {
			color: 'blue-grey',
			hue  : 600
		},
		accent : 'blue'
	}
})

Vue.component('minicart', require('./components/WooCart/index.vue'))
Vue.component('userprofile', require('./components/Profile/index.vue'))
var CurrentUser = require('./vuex/User')

var router = require('./routes')
require('./script')

var amWoo = AMdefaults.wooOptions;

new Vue({
	'router': router,

	el: "#am-appwrap",

	data: {
		currency   : amWoo.woo_currency,
		appSettings: AMdefaults,
		authInfo   : AMdefaults.themeSettings.auth_info,

		alertok: {
			type   : 'success',
			content: ' ',
			text   : 'Ok'
		},

		alertfail: {
			type   : 'fail',
			content: ' ',
			text   : 'Ok'
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

		openDialog(ref, params) {
			this[params.alert] = params.data
			this.$refs[ref].open();
		},

		closeDialog(ref) {
			this.$refs[ref].close();
		},
		onClose() {
			this.alertok = {
				type   : 'success',
				content: ' ',
				text   : 'Ok'
			};
			this.alertfail = {
				type   : 'fail',
				content: ' ',
				text   : 'Ok'
			}
		}

	}

});