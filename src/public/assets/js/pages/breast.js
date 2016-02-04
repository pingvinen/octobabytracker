(function($, undefined) {
	"use strict";

	var $beginLeft = null;
	var $beginRight = null;
	var $pause = null;
	var $play = null;

	var $whichBoob = null;
	var $totalMinutes = null;
	var $totalSeconds = null;

	var $counter = null;

	var interval = null;
	/**
	 * @type {Date}
	 */
	var startedAt = null;
	var totalSeconds = 0;

	function begin(which) {
		setActiveBoob(which, true);
	}

	function pause() {
		window.ajax.send('POST', '/breast/timing/stop', {})
			.done(function(response) {
				updateCounter(Number(response.totalSeconds));
				totalSeconds = Number(response.totalSeconds);
			});

		window.clearInterval(interval);
		interval = null;
		showPlay();
	}

	function showPlay() {
		$pause.parent().hide();
		$play.parent().show();
	}

	function start() {
		window.ajax.send('POST', '/breast/timing/start', {'whichBoob': $whichBoob.val()})
			.done(function(response) {
				updateCounter(response.totalSeconds);

				if (interval === null) {
					interval = window.setInterval(onTick, 1000);
					startedAt = new Date();

					$play.parent().hide();
					$pause.parent().show();
				}
			});
	}

	function onTick() {
		var now = new Date();

		var seconds = Number(Math.floor((now.getTime() - startedAt.getTime()) / 1000));

		updateCounter(totalSeconds + seconds);
		updateTotalMinutes(totalSeconds + seconds);
	}

	function getMinutesAndSeconds(counterSeconds) {
		var minutes = Math.floor(counterSeconds / 60);
		var seconds = counterSeconds - (minutes * 60);

		return { minutes: Number(minutes), seconds: Number(seconds) };
	}

	function updateCounter(counterSeconds) {
		var minSecs = getMinutesAndSeconds(counterSeconds);

		if (minSecs.seconds < 10) {
			minSecs.seconds = '0' + minSecs.seconds;
		}

		$counter.html(minSecs.minutes + ':' + minSecs.seconds);
	}

	function updateTotalMinutes(counterSeconds) {
		var minSecs = getMinutesAndSeconds(counterSeconds);

		if (minSecs.minutes != $totalMinutes.val()) {
			$totalMinutes.val(minSecs.minutes);
		}
	}

	function setActiveBoob(which, doStart) {
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

		if (doStart) {
		//	start();
		}
	}


	$(function() {

		$beginLeft = $('#beginLeft');
		$beginRight = $('#beginRight');
		$counter = $('#counter');
		$totalMinutes = $(document.forms['breastForm']).find('[name="totalMinutes"]');
		$totalSeconds = $(document.forms['breastForm']).find('[name="totalSeconds"]');
		$whichBoob = $(document.forms['breastForm']).find('[name="whichBoob"]');
		$pause = $('#pause');
		$play = $('#play');

		window.breastForm_onChange = function(e) {
			// we need this in case the user manually changed the field
			//updateTotalSeconds($totalMinutes.val() * 60);

			if (window.breastForm_form) { // if called during "boot", the form may not be defined yet as ajaxify runs after this script
				window.breastForm_form.submit();
			}
		};

		window.breastForm_onAfterSubmit = function(responseBody) {
			if (responseBody.status && responseBody.status === 'finalized') {
				//window.location = '/';
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

		if ($totalSeconds.val() > 0) {
			updateCounter($totalSeconds.val());
			totalSeconds = Number($totalSeconds.val());
		}

		if ($whichBoob.val() === 'left' || $whichBoob.val() === 'right') {
			setActiveBoob($whichBoob.val(), false);
		}

		showPlay();
	});

})(jQuery);
