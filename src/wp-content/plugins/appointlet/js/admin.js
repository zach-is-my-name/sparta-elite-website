(function ($) {
	"use strict";
	$(function () {
		$('.appointlet-button-custom').keyup(function(){
			$(this).parent().prev().val($(this).val());
		});
	});
}(jQuery));