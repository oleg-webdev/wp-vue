Vue.component('usercomponent', {

	template:'<em></em>',

	props: ['userdata'],

	data: function() {
		return {}
	},

	created: function() {

		console.log(this.userdata);

	}


});