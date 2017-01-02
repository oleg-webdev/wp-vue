jQuery(document).ready(function ($){

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
				type           = relatedTrigger.length > 0 ? relatedTrigger.attr('data-modal-trigger') : null;

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
				type           = relatedTrigger.length > 0 ? relatedTrigger.attr('data-modal-trigger') : null;

		modalOverlay.removeClass('show');
		setTimeout(function() {
			modalOverlay.css('display', 'none');
			$(window).trigger('aaModalClosed', [type, relatedTrigger]);
		}, 300);

	};

	/**
	 * ==================== Close modal button ======================
	 * closeParentModal("#login-modal")
	 */
	var closeParentModal = function(modal) {
		var closeTrigger = $('[data-destroy-modal="' + modal + '"]'),
				modalOverlay = $(closeTrigger.attr('data-destroy-modal'));

		closeTrigger.on('click', function(e) {
			e.preventDefault();
			modalOverlay.removeClass('show');
			setTimeout(function() {
				modalOverlay.css('display', 'none');
				$(window).trigger('aaModalClosed');
			}, 300);
		});

	};

	var closeTrigger = $('[data-destroy-modal]');
	closeTrigger.on('click', function(e) {
		e.preventDefault();
		var that         = $(this),
				modalOverlay = $(that.attr('data-destroy-modal'));

		modalOverlay.removeClass('show');
		setTimeout(function() {
			modalOverlay.css('display', 'none');
			$(window).trigger('aaModalClosed');
		}, 300);
	});

	$('[itemscope="aa-modal"]').on('click', function(e) {
		var that = $(this);
		if ($(e.target).hasClass('modal-backdrop')) {
			detachModalEvent("#"+that.attr('id'));
		}
	});

	$(window).on('aaModalOpened', function(e) {
		$(_BODY).addClass('aa-modal-overlay');
	});

	$(window).on('aaModalClosed', function(e, type, relatedTrigger) {
		$(_BODY).removeClass('aa-modal-overlay');
		// console.log(type);
	});

//raizeModalEvent("#login-modal");
//setTimeout(function(){
//	detachModalEvent("#login-modal");
//}, 3000);
//$(window).on('aaModalOpened', function(e, type, relatedModal){
//	console.log(e, type, relatedModal);
//});
});