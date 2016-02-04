(function($, undefined) {

	window.Form = function($form) {
		/**
		 * @type {jQuery}
		 */
		this.$form = $form;
	};

	Form.prototype.getId = function() {
		return this.$form.attr('id');
	};

	Form.prototype.getCustomHandlerName = function(method) {
		return this.getId() + '_' + method;
	};

	Form.prototype.enableChangeTriggers = function() {
		var that  = this;
		this.$form.on('change', ".js-form-trigger-submit", function(e) {
			var onChangeName = that.getCustomHandlerName('onChange');

			if ($.isFunction(window[onChangeName])) {
				window[onChangeName](e);
				return;
			}

			throw 'window.'+onChangeName + ' is not defined as a function';
		});
	};

	Form.prototype.submit = function() {
		this.$form.submit();
	};

	Form.prototype.ajaxify = function() {
		var that = this;
		this.$form.on('submit', function(event) {
			event.preventDefault();
			event.stopPropagation();
			event.returnValue = false;

			//
			// try to call custom handler
			//
			var onSubmitName = that.getCustomHandlerName('onSubmit');

			if ($.isFunction(window[onSubmitName])) {
				window[onSubmitName](event);
				return false;
			}

			//
			// default to sending an ajax request
			//
			var data = that.getDataAsObject();
			var url = that.$form.attr('action');
			var method = that.$form.attr('method') || 'post';

			// prepare onAfterSubmit custom handler
			var onAfterSubmitName = that.getCustomHandlerName('onAfterSubmit');

			if ($.isFunction(window[onAfterSubmitName])) {
				window.ajax.send(method, url, data).done(window[onAfterSubmitName]);
			}
			else {
				window.ajax.send(method, url, data);
			}

			return false;
		});
	};

	Form.prototype.getDataAsObject = function() {
		var data = {};

		// dropdowns
		this.$form.find('select').each(function(i, elm) {
			var $elm = $(elm);
			data[$elm.attr('name')] = $elm.val();
		});

		// checkboxes
		this.$form.find(':checkbox:checked').each(function(i, elm) {
			var $elm = $(elm);
			data[$elm.attr('name')] = $elm.val();
		});

		// radio buttons
		this.$form.find(':radio:checked').each(function(i, elm) {
			var $elm = $(elm);
			data[$elm.attr('name')] = $elm.val();
		});

		// everything else (I think)
		this.$form.find(':input').not(':radio').not(':checkbox').not('select').not(':button').each(function(i, elm) {
			var $elm = $(elm);
			data[$elm.attr('name')] = $elm.val();
		});

		return data;
	};

})(jQuery);
