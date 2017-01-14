module.exports = {

	run() {

		jQuery(document).ready(function($) {

			let homepageSlider = $('.slick-banner'),
					amSliderFade = homepageSlider.data('amqueried-transition') === 'slider-fade';

			homepageSlider.slick({
				dots         : true,
				prevArrow    : $('.prevarrow'),
				nextArrow    : $('.nextarrow'),
				autoplay     : true,
				autoplaySpeed: 4000,
				speed        : 700,
				fade         : amSliderFade,
				cssEase      : 'linear'
			});
			if (homepageSlider.slick("getSlick").slideCount > 1) {
				$('.slidernavs').addClass('shown-arrows')
			}

			var doAnimations = function(elements) {
				var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
				elements.each(function() {
					var that = $(this);
					var animationDelay = that.data('delay');
					var animationType = 'animated ' + that.data('animation');
					that.css({
						'animation-delay'        : animationDelay,
						'-webkit-animation-delay': animationDelay
					});
					that.addClass(animationType).on(animationEndEvents, function() {
						that.removeClass(animationType);
					});
				});
			};

			var doOutAnimation = function(elements) {
				var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
				elements.each(function() {
					var that = $(this);
					var animationDelay = that.data('delay');
					var animationType = 'animated ' + that.data('animation-out');
					that.css({
						'animation-delay'        : '0.01s',
						'-webkit-animation-delay': '0.01s'
					});
					that.addClass(animationType).on(animationEndEvents, function() {
						that.removeClass(animationType);
					});
				});
			};

			homepageSlider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
				var thisjqObjSlide        = $(slick.$slides[currentSlide]),
						thisanimatingElements = $(thisjqObjSlide).find('hgroup'),
						nextjqObjSlide        = $(slick.$slides[nextSlide]),
						nextAnimatingElements = $(nextjqObjSlide).find('hgroup');

				doOutAnimation(thisanimatingElements);
				doAnimations(nextAnimatingElements);
			});


		}); // jQuery ends

	}
}