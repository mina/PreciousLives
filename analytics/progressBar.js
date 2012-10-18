var progressBar = (function () {
	"use strict";	
	
	var pb;
	
	$(document).ready(function () {
		pb = $("#progress-bar");
		
	});
	
	
		
	return {
		show: function () {
			progressBar.setWidth(0);
			pb.removeClass("hidden");
		},
		
		hide: function () {
			pb.hide();
		},
		
		setWidth: function (width) {
			pb.children().first().css('width', width);
		}
	}
})();