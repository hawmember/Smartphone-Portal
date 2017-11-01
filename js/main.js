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

	// Oeffnen von Mehr Erfahren 
	$(".handy-more .circle.action").click(function () {
		$('.handy-info').toggleClass('open');
		$('.handy-more .circle').toggleClass('show-button');
	});


	function classToggle (evt, find, toggle) {
	    [].forEach.call(document.querySelectorAll('.' + find), function(a){
	        a.classList[evt.type === 'mouseover' ? 'add' : 'remove'](toggle);
	    });
	}

	var els = document.querySelectorAll('.test');

	for (var i = 0, len = els.length; i<len; i++){
	    els[i].addEventListener('mouseover', function(e){
	        classToggle(e, 'test', 'hov');
	    });
	    els[i].addEventListener('mouseout', function(e){
	        classToggle(e, 'test', 'hov');
	    });
	}
});