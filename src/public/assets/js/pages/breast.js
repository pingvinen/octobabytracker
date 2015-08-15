(function ($, undefined) {
	"use strict";

	var $beginLeft = null;
	var $beginRight = null;
	var $pause = null;
	var $play = null;

	var $whichBoob = null;
	var $totalMinutes = null;

	var $counter = null;
	var totalSeconds = 0;

	var interval = null;

	function begin(which) {
		setActiveBoob(which);
	}

	function pause() {
		window.clearInterval(interval);
		interval = null;

		$pause.parent().hide();
		$play.parent().show();
	}

	function start() {
		interval = window.setInterval(onTick, 1000);

		$play.parent().hide();
		$pause.parent().show();
	}

	function setActiveBoob(which) {
		var $elm = null;

		switch (which) {
			case 'left':
				$elm = $beginLeft;
				$whichBoob.val('left');
				break;

			case 'right':
				$elm = $beginRight;
				$whichBoob.val('right');
				break;
		}

		$beginLeft.attr('disabled', 'disabled');
		$beginRight.attr('disabled', 'disabled');
		$pause.removeAttr('disabled');

		$elm.removeClass('btn-primary').addClass('btn-success');

		window.breastForm_onChange();
		start();
	}

	function onTick() {
		totalSeconds++;
		updateCounter();

		var minutes = Math.floor(totalSeconds / 60);
		if (minutes > $totalMinutes.val()) {
			$totalMinutes.val(minutes);
			$totalMinutes.change();
		}
	}

	function updateCounter() {
		var minutes = Math.floor(totalSeconds / 60);
		var seconds = totalSeconds - (minutes * 60);

		if (seconds < 10) {
			seconds = '0' + seconds;
		}

		$counter.html(minutes + ':' + seconds);
	}

	function updateTotalSeconds(newTotal) {
		totalSeconds = newTotal;
		updateCounter();
	}

	$(function () {

		$beginLeft = $('#beginLeft');
		$beginRight = $('#beginRight');
		$counter = $('#counter');
		$totalMinutes = $(document.forms['breastForm']).find('[name="totalMinutes"]');
		$whichBoob = $(document.forms['breastForm']).find('[name="whichBoob"]');
		$pause = $('#pause');
		$play = $('#play');

		window.breastForm_onChange = function(e) {
			totalSeconds = $totalMinutes.val() * 60;

			if (window.breastForm_form) { // if called during "boot", the form may not be defined yet as ajaxify runs after this script
				window.breastForm_form.submit();
			}
		};

		window.breastForm_onAfterSubmit = function(responseBody) {
			if (responseBody.status && responseBody.status === 'finalized') {
				window.location = '/';
			}
		};

		$beginLeft.on('click', function() { begin('left'); });
		$beginRight.on('click', function() { begin('right'); });
		$pause.on('click', pause);
		$play.on('click', start);

		$pause.attr('disabled', 'disabled');
		$play.parent().hide().removeClass('hidden'); // the "hidden" class prevents "blink" on page load

		if ($totalMinutes.val() > 0) {
			updateTotalSeconds($totalMinutes.val() * 60);
		}

		if ($whichBoob.val() === 'left' || $whichBoob.val() === 'right') {
			setActiveBoob($whichBoob.val());
			pause();
		}
	});

})(jQuery);
