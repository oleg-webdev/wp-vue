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

document.getElementById('mobile-menu-trigger')
	.addEventListener('click', function(e) {
		var layoutDrawer = document.querySelector('.mdl-layout__drawer'),
				elem         = document.createElement('div');

		elem.classList.add('am-menu-backdrop');
		if (layoutDrawer.classList.contains('open-menu')) {
			layoutDrawer.classList.remove('open-menu')
			document.body.removeChild(elem)
		} else {
			layoutDrawer.classList.add('open-menu')
			document.body.insertBefore(elem, document.body.childNodes[0])
			setTimeout(function() {
				elem.classList.add('black-ops')
			}, 50)
		}
	});

setInterval(function() {
	var drawerBg     = document.querySelector('.am-menu-backdrop'),
			layoutDrawer = document.querySelector('.mdl-layout__drawer');
	if (drawerBg !== null) {
		drawerBg.addEventListener('click', function(e) {
			if (layoutDrawer.classList.contains('open-menu')) {
				layoutDrawer.classList.remove('open-menu')
				document.body.removeChild(drawerBg)
			}
		});
	}
}, 500)