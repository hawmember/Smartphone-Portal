$( document ).ready(function() {
	// Wechsel von z-index
	$(".signIn-button").click(function () {
		$('.sign').css({height:'363'});
		$('.signIn').addClass('active-panel');
		$('.signUp').removeClass('active-panel');
	});
	$(".signUp-button").click(function () {
		$('.sign').css({height:'435'});
		$('.signUp').addClass('active-panel');
		$('.signIn').removeClass('active-panel');
	});
});