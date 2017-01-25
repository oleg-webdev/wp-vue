window.eventHub = new Vue()
window.Vuex = require('vuex')
window.VueResource = require('vue-resource')

// Vue MATERIAL
window.VueMaterial = require('vue-material')
Vue.use(VueMaterial)
Vue.material.registerTheme({
	default: {
		primary: {
			color: 'blue-grey',
			hue  : 600
		},
		accent : {
			color: 'blue',
			hue  : 900
		}
	}
})

// Dirrectives
require('./dirrectives/ajaxForms')

Vue.component('minicart', require('./components/WooCart/index.vue'))
Vue.component('userprofile', require('./components/Profile/index.vue'))
Vue.component('flashmessages', require('./components/Flash/Flash.vue'))

let CurrentUser = require('./vuex/User')
CurrentUser.commit('setUserdata', AMdefaults.currentUser);

let router = require('./routes')

router.beforeEach((to, from, next) => {

	let isLoggedIn = CurrentUser.state.userdata

	if ('requiresAuth' in to.meta) {
		if (to.meta.requiresAuth && !isLoggedIn) {
			next({name: 'authscreen'})
		}
		if (to.meta.requiresAuth === false && isLoggedIn) {
			next({name: 'badrequest'})
		}
	}
	next()
})


require('./script')

let amWoo = AMdefaults.wooOptions;

new Vue({
	'router': router,

	el: "#am-appwrap",

	data: {
		currency   : amWoo.woo_currency,
		appSettings: AMdefaults,
		authInfo   : AMdefaults.themeSettings.auth_info,

		alertok: {
			type       : 'success',
			contentHtml: 'Success',
			text       : 'Ok'
		},

		alertfail: {
			type       : 'fail',
			contentHtml: 'Fail',
			text       : 'Ok'
		},

	},


	computed: {
		// use dynamic in frontend
		currentUserModel: function() {
			return CurrentUser.state.userdata;
		}

	},

	created: function() {
		document.addEventListener("DOMContentLoaded", function(e) {
			eventHub.$emit('domloaded', e);
		});
	},

	mounted() {

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
			let vm = this;
			setTimeout(()=> {
				vm.alertok = {
					type       : 'success',
					contentHtml: 'Success',
					text       : 'Ok'
				};
				vm.alertfail = {
					type       : 'fail',
					contentHtml: 'Fail',
					text       : 'Ok'
				}
			}, 800)
		}

	}

})


/**
 * ==================== Modules ======================
 * 14.01.2017
 */
// let amThemeSlider = require('./modules/themeslider')
// amThemeSlider.run()
// let amThemeModal = require('./modules/modal')
// amThemeModal.run()