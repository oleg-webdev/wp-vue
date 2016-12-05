// main.js
var Vue = require('vue')
var Hello = require('./hello.vue')

new Vue({
	el: '#app',

	components: {
		Hello
	},

	template: "<div> sdfs <hello> </div>"
})
