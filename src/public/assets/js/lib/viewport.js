(function($, undefined) {

	"use strict";

	function Viewport() {
	}

	Viewport.prototype.height = function() {
		return $(window).height();
	};

	Viewport.prototype.width = function() {
		return $(window).width();
	};

	Viewport.prototype.scrollTop = function() {
		return $(window).scrollTop();
	};

	Viewport.prototype.scrollLeft = function() {
		return $(window).scrollLeft();
	};

	Viewport.prototype.centerElement = function($elm) {
		$elm.css( this.getCenterCss($elm) );
	};

	Viewport.prototype.getCenterCss = function($elm) {
		var css = {};

		css["top"] = "0";

		if (this.height() <= $elm.height())
		{
			css["position"] = "absolute";
			css["top"] = this.scrollTop();
		}
		else
		{
			css["position"] = "fixed";
			css["top"] = (this.height()-$elm.height())/2;
		}

		if (this.width() > $elm.width())
		{
			css["left"] = (this.width()-$elm.width())/2;
		}
		else
		{
			css["left"] = "0";
		}

		return css;
	};

	Viewport.prototype.getHorizontalCenterCss = function($elm) {
		var css = {};

		if (this.width() > $elm.width())
		{
			css.left = (this.width()-$elm.width())/2;
		}
		else
		{
			css.left = "0";
		}

		return css;
	};

	window.viewport = new Viewport();

})(jQuery);
