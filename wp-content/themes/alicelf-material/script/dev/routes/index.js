var VueRouter = require('vue-router')
Vue.use(VueRouter)

module.exports = new VueRouter({
	mode: 'history',
	routes :[
		{path      : '/user/', component: require('./components/Network.vue')},
		{path      : '/user/settings', component: require('./components/Settings.vue')},
		{path      : '/user/media', component: require('./components/Media.vue')},
		{path      : '*',  component: require('./components/Notfound.vue')}
	]
})