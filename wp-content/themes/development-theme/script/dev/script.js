let domready = require('domready')
let defaultAMscript = {
	run: function() {

		const IS_HOME     = document.body.classList.contains('home'),
					_BODY       = document.body,
					_TOP_OFFSET = document.documentElement.scrollTop || document.body.scrollTop;

		_TOP_OFFSET > 150 ? _BODY.classList.add('scrolled-body'): _BODY.classList.remove('scrolled-body')

		window.addEventListener('scroll', function(e) {
			let _TOP_OFFSET = document.documentElement.scrollTop || document.body.scrollTop;

			_TOP_OFFSET > 150 ? _BODY.classList.add('scrolled-body'): _BODY.classList.remove('scrolled-body')
		});


		window.requestAnimFrame = (function() {
			return window.requestAnimationFrame ||
				window.webkitRequestAnimationFrame ||
				window.mozRequestAnimationFrame ||
				function(callback) {
					window.setTimeout(callback, 1000 / 60);
				};
		})();

		/**
		 * ==================== Common Functions ======================
		 */
		// or document.querySelector("p").closest(".near.ancestor")
		window.findAncestor = (el, cls) => {
			while ((el = el.parentElement) && !el.classList.contains(cls));
			return el;
		};


		window.itemIsPureObject = function(item) {
			if (item !== null && typeof item === 'object') {
				if (!(item instanceof Array))
					return item instanceof Object;

				return false;
			}
			return false;
		};

		window.dataToPost = function(action, data) {
			let formData = new FormData();
			formData.append('action', action);

			for (let part in data) {
				let dataItem = data[part];

				if (itemIsPureObject(dataItem)) {
					let details = JSON.stringify(dataItem);
					formData.append(part, details);
				} else {
					formData.append(part, dataItem);
				}

			}

			return formData;
		};

		/**
		 * ==================== MDL Upgrade DOM when changes ======================
		 * 10.12.2016
		 */
		let MutationObserver = window.MutationObserver
			|| window.WebKitMutationObserver
			|| window.MozMutationObserver;
		let observer = new MutationObserver(function() {
			componentHandler.upgradeDom();
		});
		observer.observe(document.body, {
			childList: true,
			subtree  : true
		});


		/**
		 * ==================== Regular Domready script ======================
		 * 26.12.2016
		 */
		let appHandler     = document.getElementById('am-appwrap'),
				opacityMeasure = 0;

		let invokeStepAppearing = () => {
			let appHandler = document.getElementById('am-appwrap')
			opacityMeasure += 0.04
			appHandler.style.opacity = opacityMeasure
			if (opacityMeasure <= 1) {
				requestAnimationFrame(invokeStepAppearing);
			}
		};


		// appHandler.style.opacity = 0;
		domready(() => {

			// invokeStepAppearing()
			let hideElemsUntilDomLoaded = document.querySelectorAll('.hide-until-dom-loaded');
			for (let i = hideElemsUntilDomLoaded.length; i--;) {
				let _elem = hideElemsUntilDomLoaded[i]
				setTimeout(() => {
					_elem.classList.add('ready-to-interract')
				}, 100)
			}

			// Iframe height
			let pageIframes = document.querySelectorAll('iframe');
			if (pageIframes.length > 0) {
				for (let i = pageIframes.length; i--;) {
					let elem       = pageIframes[i],
							elemHeight = elem.getAttribute('height')

					if (elemHeight) elem.style.height = `${elemHeight}px`

				}
			}

		});

		let parallaxCanBeUsed = () => {
			return typeof TweenMax !== 'undefined';
		}


		/**
		 * ==================== jQuery ======================
		 * 26.12.2016
		 */
		jQuery(document).ready(function($) {

			// Smooth scrolling
			// if ( IS_HOME && parallaxCanBeUsed() ) {
			// 	let $window        = $(window),
			// 			scrollTime     = .37,
			// 			scrollDistance = 250;
			//
			// 	$window.on("mousewheel DOMMouseScroll", function(event) {
			//
			// 		event.preventDefault();
			//
			// 		let delta = event.originalEvent.wheelDelta / 120 || -event.originalEvent.detail / 3;
			// 		let scrollTop = $window.scrollTop();
			// 		let finalScroll = scrollTop - parseInt(delta * scrollDistance);
			//
			// 		TweenMax.to($window, scrollTime, {
			// 			scrollTo : {
			// 				y       : finalScroll,
			// 				autoKill: true
			// 			},
			// 			ease     : Power1.easeOut,
			// 			overwrite: 5
			// 		});
			//
			// 	});
			// }


			// Smoth scroll to position
			// let triggers = document.querySelectorAll('[data-smoth-trigger]')
			// if (triggers.length > 0 && typeof TweenMax !== 'undefined') {
			// 	for (let i = triggers.length; i--;) {
			// 		let _el = triggers[i]
			// 		_el.addEventListener('click', function(e) {
			// 			e.preventDefault()
			// 			let _href = e.target.getAttribute('href')
			// 			if (_href) {
			// 				TweenMax.to(window, .5, {scrollTo: _href})
			// 			} else {
			// 				_href = e.target.parentElement.getAttribute('href')
			// 				if (_href)
			// 					TweenMax.to(window, .5, {scrollTo: _href})
			// 			}
			// 		});
			// 	}
			// }


		});

	}
}

defaultAMscript.run()
module.exports = defaultAMscript