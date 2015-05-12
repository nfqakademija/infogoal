$(document).ready(function(){

    // hide #back-top first
	$("#scrollToTop").addClass("offscreen");

	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 1000) {
				$('#scrollToTop').removeClass("offscreen");
			} else {
				$('#scrollToTop').addClass("offscreen");
			}
		});

		// scroll body to 0px on click
		$('a#scrollToTop').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 300);
			return false;
		});
	});

});