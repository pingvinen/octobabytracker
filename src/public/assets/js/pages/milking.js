(function ($, undefined) {
	"use strict";

	var $amount = null;

	$(function () {

		$amount = $(document.forms['milkingForm']).find('[name="amount"]');

		window.milkingForm_onChange = function(e) {
			window.milkingForm_form.submit();
		};

		window.milkingForm_onAfterSubmit = function(responseBody) {
			if (responseBody.status && responseBody.status === 'finalized') {
				window.location = '/';
			}
		};
	});

})(jQuery);
