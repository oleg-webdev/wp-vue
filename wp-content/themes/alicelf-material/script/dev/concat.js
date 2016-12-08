var eventHub = new Vue();
var amWoo = AMdefaults.wooOptions;

var isDescendant = function (parent, child) {
	var node = child.parentNode;
	while (node != null) {
		if (node == parent) {
			return true;
		}
		node = node.parentNode;
	}
	return false;
};

var dataToPost = function(action, data) {
	var formData = new FormData();
	formData.append('action', action);
	for (var part in data) {
		var dataItem = data[part];
		formData.append(part, dataItem);
	}

	return formData;
};
var Cart = new Vuex.Store({

	state: {
		products: []
	},

	mutations: {

		setProducts: function(state, data) {
			state.products = data;
		},

		removeFromCart: function(state, data) {
			state.products.splice(state.products.indexOf(data), 1);
		}

	},

	actions: {}

});
var User = new Vuex.Store({

	state: {
		userdata: null
	},

	mutations: {

		setUserdata: function(state, data) {
			state.userdata = data;
		}

	}

});
Vue.component('minicart', {

	template: '#minicart-template',

	// Fields
	data: function() {
		return {
			cartOpened: false,
			currency  : null
		}
	},

	// Dynamic Fields
	computed: {
		totalCart: function() {
			return this.cartItemsData.length;
		},

		cartItemsData: function() {
			return Cart.state.products;
		}

	},

	// Constructor
	created: function() {
		this.fetchCart();
		var vm = this;
		this.currency = this.pd().currency;

		eventHub.$on('domloaded', function(e) {
			document.getElementById('am-appwrap')
				.addEventListener('click', function(e) {
					var parentEl = $(e.target).parents('.minicart-template-holder').length;
					if(!parentEl) {
						vm.cartOpened = false;
					}
				});
		});

	},

	// Methods
	methods: {
		pd: function() {
			return this.$parent.$data;
		},

		fetchCart: function() {
			this.$http.get(AMdefaults.ajaxurl + "?action=ajx20161412071430")
				.then(function(response) {
					Cart.commit('setProducts', JSON.parse(response.body));
				});
		},

		removeFromCart: function(item, index, event) {
			var removeData = dataToPost('ajx20163730073701', item);
			this.$http.post(AMdefaults.ajaxurl, removeData).then(function(response) {});
			Cart.commit('removeFromCart', item);
		},

		toggleCart: function() {
			this.cartOpened = !this.cartOpened;
		}
	}

});


var Network = {
	template: '<div>\
		Network\
		<strong></strong>\
	</div>'
};
var Notfound = {
	template: '<div>\
		<h1 class="text-center mdl-color-text--blue-grey-700">.404 Nothing Found</h1>\
	</div>'
};

var Foo = {
	template: '<div>\
		sfsdfsfs\
		<strong></strong>\
	</div>'
};

var Bar = {
	template: '<div>\
		<div>\
		<ul>\
			<li>List Item </li>\
			<li>List Item </li>\
			<li>List Item </li>\
		</ul>\
		</div>\
	</div>'
};

var routes = [
	{path      : '/user/', component: Network},
	{path      : '/user/foo', component: Foo},
	{path      : '/user/bar', component: Bar},
	{path      : '*', component: Notfound}
];

var router = null;
if ((typeof VueRouter) !== "undefined") {
	router = new VueRouter({
		mode: 'history',
		routes: routes
	});
}


new Vue({

	el: "#am-appwrap",

	router: router,

	data: {
		currency    : amWoo.woo_currency,
		appSettings : AMdefaults,
		authInfo: AMdefaults.themeSettings.auth_info,
		confirmProps: {
			show  : false,
			answer: false
		}
	},

	computed: {
		// use dynamic in frontend
		currentUserModel: function() {
			return User.state.userdata;
		}

	},

	created: function() {
		User.commit('setUserdata', currentUser);
		document.addEventListener("DOMContentLoaded", function(e) {
			eventHub.$emit('domloaded', e);
		});
		// this.$http.get(AMdefaults.wpApiUrl+"posts")
		// 	.then(function(response) {
		// 		console.log(response.data);
		// 	});
	}

});
var MutationObserver = window.MutationObserver
	|| window.WebKitMutationObserver
	|| window.MozMutationObserver;

var ElemToObserve = document.querySelector('.mdl-layout__drawer');


if (ElemToObserve !== null) {

	var observer = new MutationObserver(function(mutations) {
		mutations.forEach(function(mutation) {
			var ContainerToObserve = document.querySelector('.mdl-layout__container');
			if ((mutation.target.className).indexOf('is-visible') > -1) {
				ContainerToObserve.classList.add('height-full');
			} else {
				ContainerToObserve.classList.remove('height-full');
			}
		});
	});

	var config = {
		attributes   : true,
		childList    : true,
		characterData: true
	};

	var mdlUpgradeDom = false;
	setInterval(function() {
		if (mdlUpgradeDom) {
			componentHandler.upgradeDom();
			mdlUpgradeDom = false;
		}
	}, 200);

	var observer = new MutationObserver(function() {
		mdlUpgradeDom = true;
	});
	observer.observe(document.body, {
		childList: true,
		subtree  : true
	});
	/* support <= IE 10
	 angular.element(document).bind('DOMNodeInserted', function(e) {
	 mdlUpgradeDom = true;
	 });
	 */
	observer.observe(ElemToObserve, config);
}

var adminBartrigger = document.getElementById('am-show-adminbar');
if (adminBartrigger) {
	var waitForAdmiBar = setInterval(function() {
		var adminbar = document.getElementById('wpadminbar');
		if (adminbar) {
			adminBartrigger.addEventListener('click', function(e) {
				adminbar.classList.contains('show') ?
					adminbar.classList.remove('show'):
					adminbar.classList.add('show');
				adminBartrigger.classList.contains('show') ?
					adminBartrigger.classList.remove('show'):
					adminBartrigger.classList.add('show');
			});
			clearInterval(waitForAdmiBar);
		}
	}, 200);
}


/**
 * ==================== Mobile menu ======================
 * 09.12.2016
 */
var startWathingBackdrop = function() {
	var drawerIterval = setInterval(function() {

		var backdrop = document.querySelector('.am-menu-backdrop'),
				menu     = document.querySelector('.mdl-layout__drawer');

		if (backdrop !== null) {
			backdrop.addEventListener('click', function() {
				if (menu.classList.contains('open-menu')) {
					menu.classList.remove('open-menu');
					backdrop.classList.remove('black-ops');
					setTimeout(function() {
						document.body.removeChild(backdrop);
					}, 300)
				}
			});

			clearInterval(drawerIterval);
		}

	}, 50)
};

document.getElementById('mobile-menu-trigger')
	.addEventListener('click', function() {
		var menu = document.querySelector('.mdl-layout__drawer'),
				elem = document.createElement('div');

		elem.classList.add('am-menu-backdrop');

		if (!menu.classList.contains('open-menu')) {
			menu.classList.add('open-menu');
			document.body.insertBefore(elem, document.body.childNodes[0]);
			startWathingBackdrop();
			setTimeout(function() {
				elem.classList.add('black-ops');
			}, 50);
		}

	});