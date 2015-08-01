(function ($, undefined) {

	$(function () {

		/**
		 * Ajax error handler
		 */
		window.ajax.setOnErrorCallback(function(message) {
			$('#alertBoxContainer').append(
				$('<div></div>').addClass('alert alert-error').html(message)
			);
		});

		/**
		 * Enable the commit button
		 */
		$('form').find('.js-commit').on('click', function(e) {
			var $btn = $(this);

			$btn.parentsUntil('form').parent().append(
				$('<input>').attr('type', 'hidden').val(true).attr('name', 'docommit')
			);
		});

	});

})(jQuery);
