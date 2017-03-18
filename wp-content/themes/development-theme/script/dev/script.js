let domready = require('domready')
let defaultAMscript = {
	run: function() {

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
		domready(function() {
			// invokeStepAppearing()
			let hideElemsUntilDomLoaded = document.querySelectorAll('.hide-until-dom-loaded');
			hideElemsUntilDomLoaded.forEach(function (el, index, array) {
				setTimeout(function() {
					el.classList.add('ready-to-interract')
				}, 100)
			})


		});


		/**
		 * ==================== jQuery ======================
		 * 26.12.2016
		 */
		jQuery(document).ready(function($) {

		});

	}
}
defaultAMscript.run()
module.exports = defaultAMscript