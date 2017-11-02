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

	// Higlighten aller gleichen Attribute
	function hoverByClass(classname){
		var elms=document.getElementsByClassName(classname);
		for(var i=0;i<elms.length;i++){
			elms[i].onmouseover = function(){
				for(var k=0;k<elms.length;k++){
					elms[k].style.backgroundColor="#74d4fc";
					elms[k].style.color= "#fff";
				}
			};
			elms[i].onmouseout = function(){
				for(var k=0;k<elms.length;k++){
					elms[k].style.backgroundColor= "transparent";
					elms[k].style.color= "#555";
				}
			};
		}
	}
	hoverByClass("her");
	hoverByClass("spe");
	hoverByClass("far");
	hoverByClass("pre");
	hoverByClass("abm");
	hoverByClass("gew");
	hoverByClass("gro");
	hoverByClass("auf");
	hoverByClass("art");
});