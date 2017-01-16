var VueRouter = require('vue-router')
Vue.use(VueRouter)


const netwoRkUrlendpoint = AMdefaults.routerPrefix + AMdefaults.networkSlug

module.exports = new VueRouter({
	mode  : 'history',
	routes: [
		{
			name     : 'userentrypoint',
			path     : `/${netwoRkUrlendpoint}/`,
			component: require('./components/Network.vue'),
			meta     : {requiresAuth: true}
		},
		{
			path     : `/${netwoRkUrlendpoint}/settings`,
			component: require('./components/Settings.vue'),
			meta     : {requiresAuth: true}
		},
		{
			path     : `/${netwoRkUrlendpoint}/media`,
			component: require('./components/Media.vue'),
			meta     : {requiresAuth: true}
		},


		{ // Restore pass screen
			path     : `/${netwoRkUrlendpoint}/screen/restorepass`,
			component: require('./components/RestorePass.vue'),
		},


		{
			name     : 'authscreen',
			path     : `/${netwoRkUrlendpoint}/auth`,
			component: require('./components/authComponent.vue'),
			meta     : {requiresAuth: false}
		},
		{
			name     : 'badrequest',
			path     : `/${netwoRkUrlendpoint}/badrequest`,
			component: require('./components/common/BadRequest.vue')
		},

		{
			path     : '*',
			component: require('./components/common/Notfound.vue')
		},
	]
})