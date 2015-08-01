(function ($, undefined) {
	"use strict";

	$(function () {
		window.diaperForm_onChange = function(e) {
			window.diaperForm_form.submit();
		};

		window.diaperForm_onAfterSubmit = function(responseBody) {
			if (responseBody.status && responseBody.status === 'finalized') {
				window.location = '/';
			}
		};

	});

})(jQuery);
