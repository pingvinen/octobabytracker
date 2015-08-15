(function ($, undefined) {
	"use strict";

	var $typeMilk = null;
	var $typeFormula = null;
	var $type = null;
	var $amount = null;

	function setType(which) {
		var $elm = null;

		switch (which) {
			case 'milk':
				$elm = $typeMilk;
				$type.val('milk');
				break;

			case 'formula':
				$elm = $typeFormula;
				$type.val('formula');
				break;
		}

		resetTypeButtons();
		$elm.removeClass('btn-primary').addClass('btn-success');

		window.bottleForm_onChange();
	}

	function resetTypeButtons() {
		$typeMilk.removeClass('btn-success').addClass('btn-primary');
		$typeFormula.removeClass('btn-success').addClass('btn-primary');
	}

	$(function () {

		$typeMilk = $('#typeMilk');
		$typeFormula = $('#typeFormula');
		$amount = $(document.forms['bottleForm']).find('[name="amount"]');
		$type = $(document.forms['bottleForm']).find('[name="type"]');


		window.bottleForm_onChange = function(e) {
			if (window.bottleForm_form) { // if called during "boot", the form may not be defined yet as ajaxify runs after this script
				window.bottleForm_form.submit();
			}
		};

		window.bottleForm_onAfterSubmit = function(responseBody) {
			if (responseBody.status && responseBody.status === 'finalized') {
				window.location = '/';
			}
		};

		$typeMilk.on('click', function() { setType('milk'); });
		$typeFormula.on('click', function() { setType('formula'); });

		if ($type.val() === 'milk' || $type.val() === 'formula') {
			setType($type.val());
		}
	});

})(jQuery);
