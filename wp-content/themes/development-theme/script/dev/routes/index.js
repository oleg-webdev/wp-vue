var VueRouter = require('vue-router')
Vue.use(VueRouter)

module.exports = new VueRouter({
	mode  : 'history',
	routes: [
		{
			name     : 'userentrypoint',
			path     : '/user/',
			component: require('./components/Network.vue'),
			meta     : {requiresAuth: true}
		},
		{
			path     : '/user/settings',
			component: require('./components/Settings.vue'),
			meta     : {requiresAuth: true}
		},
		{
			path     : '/user/media',
			component: require('./components/Media.vue'),
			meta     : {requiresAuth: true}
		},


		{ // Restore pass screen
			path     : '/user/screen/restorepass',
			component: require('./components/RestorePass.vue'),
		},


		{
			name     : 'authscreen',
			path     : '/user/auth',
			component: require('./components/authComponent.vue'),
			meta     : {requiresAuth: false}
		},
		{
			name     : 'badrequest',
			path     : '/user/badrequest',
			component: require('./components/common/BadRequest.vue')
		},
		{
			path     : '*',
			component: require('./components/common/Notfound.vue')
		},
	]
})