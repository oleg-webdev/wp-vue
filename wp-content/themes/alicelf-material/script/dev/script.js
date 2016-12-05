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
		if(adminbar) {
			adminBartrigger.addEventListener('click', function (e) {
				adminbar.classList.contains('show') ?
					adminbar.classList.remove('show') :
					adminbar.classList.add('show');
				adminBartrigger.classList.contains('show') ?
					adminBartrigger.classList.remove('show') :
					adminBartrigger.classList.add('show');
			});
			clearInterval(waitForAdmiBar);
		}
	}, 200);
}