window.eventHub = new Vue()
window.Vuex = require('vuex')
window.VueResource = require('vue-resource')

// Vue Scope goes here


let commonScript = require('./modules/common')
commonScript.run()