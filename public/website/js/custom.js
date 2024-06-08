$(function(){
	$('#navbar-toggle').click(function () {
		if (!$('html').hasClass('navbar-open')) {
			$('html').addClass('navbar-open');
		}
	});
	$('#nav-close-btn').click(function () {
		if ($('html').hasClass('navbar-open')) {
			$('html').removeClass('navbar-open');
		}
	});
});