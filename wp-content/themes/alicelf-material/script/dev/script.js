var domready = require('domready')
var defaultAMscript = {
	run: function(){
		/**
		 * ==================== Common Functions ======================
		 * 19.12.2016
		 */
		window.isDescendant = function (parent, child) {
			var node = child.parentNode;
			while (node != null) {
				if (node == parent) {
					return true;
				}
				node = node.parentNode;
			}
			return false;
		};

		window.dataToPost = function(action, data) {
			var formData = new FormData();
			formData.append('action', action);
			for (var part in data) {
				var dataItem = data[part];
				formData.append(part, dataItem);
			}

			return formData;
		};

		/**
		 * ==================== MDL Upgrade DOM when changes ======================
		 * 10.12.2016
		 */
		var MutationObserver = window.MutationObserver
			|| window.WebKitMutationObserver
			|| window.MozMutationObserver;
		var observer = new MutationObserver(function() {
			componentHandler.upgradeDom();
		});
		observer.observe(document.body, {childList: true,subtree : true});

		/**
		 * ==================== Admin Bar ======================
		 * 10.12.2016
		 */
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
			}, 500);
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
							document.body.classList.remove('lock-overflow');
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

		domready(function(){
			document.getElementById('mobile-menu-trigger')
				.addEventListener('click', function() {

					var menu = document.querySelector('.mdl-layout__drawer'),
							elem = document.createElement('div');

					elem.classList.add('am-menu-backdrop');

					if (!menu.classList.contains('open-menu')) {
						menu.classList.add('open-menu');
						document.body.classList.add('lock-overflow');
						document.body.insertBefore(elem, document.body.childNodes[0]);
						startWathingBackdrop();
						setTimeout(function() {
							elem.classList.add('black-ops');
						}, 50);
					}

				});
		})

	}
}
defaultAMscript.run()
module.exports = defaultAMscript