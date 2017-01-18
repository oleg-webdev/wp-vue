module.exports = {

	run() {

		jQuery(document).ready(function($) {

			var _BODY            = document.body,
					_HTML            = document.documentElement,
					_DOCUMENT_HEIGHT = Math.max(_BODY.scrollHeight, _BODY.offsetHeight,
						_HTML.clientHeight, _HTML.scrollHeight, _HTML.offsetHeight),
					_TOP_OFFSET      = document.documentElement.scrollTop || document.body.scrollTop,
					_LEFT_OFFSET     = document.documentElement.scrollLeft || document.body.scrollLeft;

			/**
			 * ==================== FRONTEND MODALS ======================
			 * 21.04.2016
			 */
			$('[data-modal-trigger]').on('click', function(e) {

				e.preventDefault();
				var that         = $(this),
						type         = that.attr('data-modal-trigger'),
						body         = $('body'),
						relatedModal = that.attr('data-related-modal');

				body.find(relatedModal).css({'display': 'block'});
				setTimeout(function() {
					body.find(relatedModal).addClass('show');
				}, 10);
				$(relatedModal).trigger('aaModalOpened', [type, relatedModal]);

			});


			/**
			 * ==================== Open modal from event ======================
			 * raizeModalEvent("#login-modal")
			 */
			var raizeModalEvent = function(modal) {
				var relatedTrigger = $('[data-related-modal="' + modal + '"]') || null,
						type           = relatedTrigger.length > 0 ? relatedTrigger.attr('data-modal-trigger'): null;

				$(modal).css({'display': 'block'});
				setTimeout(function() {
					$(modal).addClass('show');
				}, 10);

				$(window).trigger('aaModalOpened', [type, relatedTrigger]);
			};

			/**
			 * ==================== Remove Modal ======================
			 * detachModalEvent("#login-modal")
			 */
			var detachModalEvent = function(modal) {
				var modalOverlay   = $(modal),
						relatedTrigger = $('[data-related-modal="' + modal + '"]') || null,
						type           = relatedTrigger.length > 0 ? relatedTrigger.attr('data-modal-trigger'): null;

				modalOverlay.removeClass('show');
				setTimeout(function() {
					modalOverlay.css('display', 'none');
					$(window).trigger('aaModalClosed', [type, relatedTrigger]);
				}, 300);

			};

			/**
			 * ==================== Close modal button ======================
			 */
			var closeTrigger = $('[data-destroy-modal]');
			closeTrigger.on('click', function(e) {
				e.preventDefault();
				var that           = $(this),
						modalOverlay   = $(that.attr('data-destroy-modal')),
						relatedTrigger = $('[data-related-modal="' + that.attr('data-destroy-modal') + '"]') || null,
						type           = relatedTrigger.length > 0 ? relatedTrigger.attr('data-modal-trigger'): null;

				modalOverlay.removeClass('show');
				setTimeout(function() {
					modalOverlay.css('display', 'none');
					$(window).trigger('aaModalClosed', [type, relatedTrigger]);
				}, 300);
			});

			$('[data-itemprop="aa-modal"]').on('click', function(e) {
				var that = $(this);
				if ($(e.target).hasClass('modal-backdrop')) {
					detachModalEvent("#" + that.attr('id'));
				}
			});


			/**
			 * ==================== Doing open modal hooks ======================
			 */
			$(window).on('aaModalOpened', function(e, type, relatedTrigger) {
				$(_BODY).addClass('aa-modal-overlay');
				// console.log(e, type, relatedTrigger)

			});

			/**
			 * ==================== Doing close modal hooks ======================
			 */
			$(window).on('aaModalClosed', function(e, type, relatedTrigger) {
				$(_BODY).removeClass('aa-modal-overlay');
				// console.log(e, type, relatedTrigger)


			});


		});

	}

}