/**
 * This class is based on info and samples from
 * http://www.html5rocks.com/en/tutorials/pagevisibility/intro/
 */
(function($, undefined) {
	"use strict";

	function PageVisibility() {
	}

	PageVisibility.prototype.getHiddenPropertyName = function() {
		// if 'hidden' is natively supported just return it
		if ('hidden' in document) {
			return 'hidden';
		}

		var prefixes = ['webkit', 'moz', 'ms', 'o'];

		// otherwise loop over all the known prefixes until we find one
		for (var i = 0; i < prefixes.length; i++) {
			if ((prefixes[i] + 'Hidden') in document) {
				return prefixes[i] + 'Hidden';
			}
		}

		// otherwise it's not supported
		return null;
	};

	PageVisibility.prototype.isHidden = function() {
		var propertyName = this.getHiddenPropertyName();

		if (!propertyName) {
			return false;
		}

		return document[propertyName];
	};

	PageVisibility.prototype.getPrefix = function() {
		var propertyName = this.getHiddenPropertyName();

		if (propertyName === null) {
			return null;
		}

		return propertyName.replace(/hidden/i, '');
	};

	PageVisibility.prototype.attachVisibilityChangeListener = function(handler) {
		var prefix = this.getPrefix();

		if (prefix !== null) {
			var eventName = prefix + 'visibilitychange';
			$(document).on(eventName, function(event) { handler(event); });
		}
		else {
			alert("visibilityChange not supported");
		}
	};

	window.pageVisibility = new PageVisibility();

})(jQuery);
