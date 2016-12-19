var VueRouter = require('vue-router')
Vue.use(VueRouter)

module.exports = new VueRouter({
	mode: 'history',
	routes :[
		{path      : '/user/', component: require('./components/Network.vue')},
		{path      : '/user/foo', component: require('./components/Foo.vue')},
		{path      : '/user/bar', component: require('./components/Bar.vue')},
		{path      : '*',  component: require('./components/Notfound.vue')}
	]
})