(function ($, undefined) {
	"use strict";

	function Ajax() {
		this.onErrorCallback = null;
	}

	Ajax.prototype.setOnErrorCallback = function(newCallback) {
		this.onErrorCallback = newCallback;
	};

	Ajax.prototype.onError = function(message) {
		if ($.isFunction(this.onErrorCallback)) {
			this.onErrorCallback(message);
		}
	};

	Ajax.prototype.onUnknownError = function() {
		this.onError("An unknown error occurred");
	};

	Ajax.prototype.onNoResponse = function() {
		this.onError("It does not seem that the backend is running");
	};

	/**
	 * Send an AJAX request to the server.
	 *
	 * Parsing of "Status.Code" is done within this method. Should
	 * the status code be an error, the "fail" promise will
	 * be executed.
	 *
	 * @param {String} method The request method (GET, POST etc)
	 * @param {String} url The url
	 * @param {Object} data Data to send to the backend
	 * @returns {jQuery.Deferred.promise}
	 */
	Ajax.prototype.send = function(method, url, data) {
		var postData = $.extend({}, data);

		// add a cache-avoiding timestamp param
		url = this.addParamToUrl(url, "tttsss", (new Date()).getTime());


		//
		// from http://stackoverflow.com/a/5112734
		//

		var deferred = new $.Deferred();
		var promise = deferred.promise();

		var jqXhr = $.ajax({
			type: method.toUpperCase(),
			url: url,
			data: postData,
			dataType: "json",
			cache: "false"
		});

		jqXhr.fail($.proxy(function() {

			this.onUnknownError();

			deferred.reject(null);
		}, this));


		jqXhr.done($.proxy(function(responseBody) {

			if (responseBody === null) {
				this.onNoResponse();
				deferred.reject(null);
				return;
			}

			//
			// check for errors
			//
			if (responseBody["responseStatus"] !== undefined) {
				var msg = responseBody.responseStatus.message;
				var num;
				var field;
				var err;
				for (var x in responseBody.responseStatus.errors) {
					err = responseBody.responseStatus.errors[x];

					num = (Number(x)+1)+") ";
					field = "";
					if (err.FieldName !== "") {
						field = err.FieldName+": ";
					}

					msg += "\n"+num+field+err.Message;
				}
				this.onError(msg);
				deferred.reject(responseBody);
				return;
			}

			//
			// all hail the glorius response :)
			//
			deferred.resolve(responseBody);
		}, this));

		return promise;
	};

	Ajax.prototype.addParamToUrl = function(url, key, value) {
		key = encodeURI(key);
		value = encodeURI(value);

		var glue = "&";

		//
		// look for existing query
		//
		if (url.split("?").length === 1) {
			// no existing query
			glue = "?";
		}

		return url + glue + key + "=" + value;
	};

	window.ajax = new Ajax();
})(jQuery);
