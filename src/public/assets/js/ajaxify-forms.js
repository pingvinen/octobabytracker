(function ($, undefined) {

	$(function () {
		/**
		 * Ajaxify forms
		 */
		for (var i=0; i!=document.forms.length; i++) {
			var $form = $(document.forms[i]);

			var form = new Form($form);
			form.enableChangeTriggers();
			form.ajaxify();

			window[form.getId() + '_form'] = form;
		}
	});

})(jQuery);
