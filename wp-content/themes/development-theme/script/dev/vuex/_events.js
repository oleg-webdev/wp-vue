module.exports = new Vue({

	created() {
		let vm = this
		// Dom ready to interract
		document.addEventListener("DOMContentLoaded", function(e) {
			vm.$emit('domloaded', e);
		});

	},

	// Central simple events storage
	methods: {

	}

})