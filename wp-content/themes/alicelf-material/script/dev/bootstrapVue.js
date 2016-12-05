new Vue({

	el: "#am-appwrap",

	router: router,

	data: {
		currency    : amWoo.woo_currency,
		confirmProps: {
			show  : false,
			answer: false
		}
	},

	created: function() {
		document.addEventListener("DOMContentLoaded", function(e) {
			eventHub.$emit('domloaded', e);
		});
	}

});