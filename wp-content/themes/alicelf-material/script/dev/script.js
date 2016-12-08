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