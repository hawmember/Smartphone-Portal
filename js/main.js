$( document ).ready(function() {
	// Wechsel von z-index der sign panel
	$(".signIn-button").click(function () {
		$('.signIn').addClass('active-panel');
		$('.signUp').removeClass('active-panel');
	});
	$(".signUp-button").click(function () {
		$('.signUp').addClass('active-panel');
		$('.signIn').removeClass('active-panel');
	});

	// Selbstschreibender Text auf der Startseite
	ityped.init('#ityped', {
	    strings:['Finde dein passendes Smartphone'],
	    startDelay: 500,
	    typeSpeed:  120,
	    loop: false, 
        showCursor: true,
    	cursorChar: "_"
	});
});