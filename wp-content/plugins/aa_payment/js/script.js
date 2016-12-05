/**
 * Define the globals
 */
var SITE_URL = aa_ajax_var.site_url,
	AJAXURL = aa_ajax_var.ajax_url,
	THEME_URI = aa_ajax_var.template_uri,
	IMG_DIR = THEME_URI + '/img/';

var Loaders = {
	bouncingAbsolute : '\
			<div class="loader-absolute">\
				<div class="preview-area">\
					<div class="spinner-jx">\
						<div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div>\
					</div>\
				</div>\
			</div>',
	bouncingStatic  : '\
			<div class="loader-static">\
					<div class="preview-area">\
						<div class="spinner-jx">\
							<div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div>\
						</div>\
					</div>\
				</div>',
	infiniteSpinner : '\
			<div class="loader-backdrop">\
				<div class="loader-infinite-spinner">\
					<div class="lt"></div><div class="rt"></div><div class="lb"></div><div class="rb"></div>\
				</div>\
			</div>'
};


jQuery(document).ready(function($) {

	/**
	 * @param handler
	 * @param shouldRunHandlerOnce
	 * @param isChild
	 * @returns {*|jQuery|HTMLElement}
	 */
	$.fn.waitUntilExists = function(handler, shouldRunHandlerOnce, isChild) {
		var found = 'found';
		var $this = $(this.selector);
		var $elements = $this.not(function() {
			return $(this).data(found);
		}).each(handler).data(found, true);

		if (!isChild) {
			(window.waitUntilExists_Intervals = window.waitUntilExists_Intervals || {})[this.selector] =
				window.setInterval(function() {
					$this.waitUntilExists(handler, shouldRunHandlerOnce, true);
				}, 500)
			;
		}
		else
			if (shouldRunHandlerOnce && $elements.length) {
				window.clearInterval(window.waitUntilExists_Intervals[this.selector]);
			}

		return $this;
	};


	var alertsFn = function(status, message) {
		switch (status) {
			case "success" :
				return "<div class='updated notice is-dismissible'><p>" + message + "</p></div>";
		}
	};

	var processRemoveNotice = function() {
		var container = $('.aa-plugin-notice-container');

		$.each(container, function() {
			var that = $(this),
				buttonTrigger = that.find('button'),
				dataUser = that.attr('data-current-user'),
				dataNotice = that.attr('id'),
				dataNoticeDescriptor = that.attr('data-plugin-notice');

			buttonTrigger.on('click', function(e) {
				$.ajax({
					url       : ajaxurl,
					type      : "POST",
					data      : {
						aa_notice_descriptor: dataNoticeDescriptor,
						aa_data_user        : dataUser,
						aa_data_notice      : dataNotice,
						action              : 'ajx20164726124703'
					},
					//dataType : "html",
					beforeSend: function() {
					},
					success   : function(data) {
						console.log(data);
					},
					error     : function(jqXHR, textStatus, errorThrown) {
						alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
					}
				});

			});

		});

	};
	processRemoveNotice();


});