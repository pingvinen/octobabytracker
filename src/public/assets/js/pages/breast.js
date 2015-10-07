(function($, undefined) {
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
	var startedAt = null;

	function begin(which) {
		setActiveBoob(which);
	}

	function pause() {
		window.clearInterval(interval);
		interval = null;

		updateTotalSeconds(getTotalSecondsNow());
		startedAt = null;

		$pause.parent().hide();
		$play.parent().show();
	}

	function start() {
		if (interval === null) {
			interval = window.setInterval(onTick, 1000);
			startedAt = new Date();

			$play.parent().hide();
			$pause.parent().show();
		}
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

	function getTotalSecondsNow() {
		if (startedAt == null) {
			return totalSeconds;
		}

		var sinceStart = Math.floor(((new Date()).getTime() - startedAt.getTime())/1000);
		return totalSeconds + sinceStart;
	}

	function onTick() {
		var tmpTotalSeconds = getTotalSecondsNow();
		updateCounter(tmpTotalSeconds);

		var minutes = Math.floor(tmpTotalSeconds / 60);
		if (minutes > $totalMinutes.val()) {
			$totalMinutes.val(minutes);
			$totalMinutes.change();
		}
	}

	function updateCounter(counterSeconds) {
		var minutes = Math.floor(counterSeconds / 60);
		var seconds = counterSeconds - (minutes * 60);

		if (seconds < 10) {
			seconds = '0' + seconds;
		}

		$counter.html(minutes + ':' + seconds);
	}

	function updateTotalSeconds(newTotal) {
		totalSeconds = newTotal;
		updateCounter(totalSeconds);
	}

	$(function() {

		$beginLeft = $('#beginLeft');
		$beginRight = $('#beginRight');
		$counter = $('#counter');
		$totalMinutes = $(document.forms['breastForm']).find('[name="totalMinutes"]');
		$whichBoob = $(document.forms['breastForm']).find('[name="whichBoob"]');
		$pause = $('#pause');
		$play = $('#play');

		window.breastForm_onChange = function(e) {
			if (startedAt != null) {
				// we need this, otherwise the seconds goes haywire
				startedAt = new Date();
			}
			// we need this in case the user manually changed the field
			updateTotalSeconds($totalMinutes.val() * 60);

			if (window.breastForm_form) { // if called during "boot", the form may not be defined yet as ajaxify runs after this script
				window.breastForm_form.submit();
			}
		};

		window.breastForm_onAfterSubmit = function(responseBody) {
			if (responseBody.status && responseBody.status === 'finalized') {
				window.location = '/';
			}
		};

		$beginLeft.on('click', function() {
			begin('left');
		});
		$beginRight.on('click', function() {
			begin('right');
		});
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
