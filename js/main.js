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
	if ( $(".main-site").length) { // checkt ob man auf der startseite ist
		ityped.init('#ityped', {
		    strings:['Finde dein passendes Smartphone'],
		    startDelay: 500,
		    typeSpeed:  120,
		    loop: false, 
	        showCursor: true,
	    	cursorChar: "_"
		});
	}

	// Suchleiste on Focus sichtbar machen
    $(".search-input").focus( function() {
        $(".search-form").css( "opacity", "1" );
    });

	// Oeffnen von Mehr Erfahren 
	$(".handy-more .circle").click(function () {
		$('.handy-info').toggleClass('open');
		$('.handy-more .circle').toggleClass('open');
		$('.handy-more .circle').toggleClass('close');
	});

	// Display aufschieben 
	$("li.displayMain a").click(function () {
		$('.displayMain ul').toggleClass('open');
		$('li.displayMain a').toggleClass('close');
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
	// Hier die Klassen hinzufuegen
	hoverByClass("her");hoverByClass("spe");hoverByClass("far");hoverByClass("pre");hoverByClass("abm");hoverByClass("gew");hoverByClass("gro");hoverByClass("auf");hoverByClass("art");

	// Slider Wert live anzeigen 
	var rangeSlider = function(){
	  var slider = $('.range-slider'),
	      range = $('.filter-range'),
	      value = $('.filter-range-value');
	    
	  slider.each(function(){

	    value.each(function(){
	      var value = $(this).prev().attr('value');
	      $(this).html(value);
	    });

	    range.on('input', function(){
	      $(this).next(value).html(this.value);
	    });
	  });
	};
	// Funktionen ausfuehren
	rangeSlider();
});





// Suchleiste Begriffe vorschlagen
if ( $(".main-site").length) { // checkt ob man auf der startseite ist
	$( function() {
	    $.widget( "custom.catcomplete", $.ui.autocomplete, {
	      _create: function() {
	        this._super();
	        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
	      },
	      _renderMenu: function( ul, items ) {
	        var that = this,
	          currentCategory = "";
	        $.each( items, function( index, item ) {
	          var li;
	          if ( item.category != currentCategory ) {
	            ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
	            currentCategory = item.category;
	          }
	          li = that._renderItemData( ul, item );
	          if ( item.category ) {
	            li.attr( "aria-label", item.category + " : " + item.label );
	          }
	        });
	      }
	    });
	    var data = [
	      { label: "iPhone 1G", category: "Apple" },
	      { label: "iPhone 3G", category: "Apple" },
	      { label: "iPhone 3GS", category: "Apple" },
	      { label: "iPhone 4", category: "Apple" },
	      { label: "iPhone 4S", category: "Apple" },
	      { label: "iPhone 5", category: "Apple" },
	      { label: "iPhone 5C", category: "Apple" },
	      { label: "iPhone 5S", category: "Apple" },
	      { label: "iPhone 6", category: "Apple" },
	      { label: "iPhone 6 Plus", category: "Apple" },
	      { label: "iPhone 6S", category: "Apple" },
	      { label: "iPhone SE", category: "Apple" },
	      { label: "iPhone 6S Plus", category: "Apple" },
	      { label: "iPhone 7", category: "Apple" },
	      { label: "iPhone 7 Plus", category: "Apple" },
	      { label: "iPhone 8", category: "Apple" },
	      { label: "iPhone 8 Plus", category: "Apple" },
	      { label: "iPhone X", category: "Apple" },
	      { label: "Samsung Galaxy S1", category: "Samsung" },
	      { label: "Samsung Galaxy S2", category: "Samsung" },
	      { label: "Samsung Galaxy S3", category: "Samsung" },
	      { label: "Samsung Galaxy S4", category: "Samsung" },
	      { label: "Samsung Galaxy S5", category: "Samsung" },
	      { label: "Samsung Galaxy S6", category: "Samsung" },
	      { label: "Samsung Galaxy S6 Edge", category: "Samsung" },
	      { label: "Samsung Galaxy S7", category: "Samsung" },
	      { label: "Samsung Galaxy S7 Edge", category: "Samsung" },
	      { label: "Samsung Galaxy S8", category: "Samsung" },
	      { label: "Samsung Galaxy S8+", category: "Samsung" },
	      { label: "HTC U11", category: "HTC" },
	      { label: "HTC 10", category: "HTC" },
	      { label: "HTC One M9", category: "HTC" },
	      { label: "HTC One M8", category: "HTC" },
	      { label: "HTC One", category: "HTC" },
	      { label: "Sony Xperia Z", category: "Sony" },
	      { label: "Sony Xperia Z1", category: "Sony" },
	      { label: "Sony Xperia Z2", category: "Sony" },
	      { label: "Sony Xperia Z3", category: "Sony" },
	      { label: "Sony Xperia Z3+", category: "Sony" },
	      { label: "Sony Xperia Z5", category: "Sony" },
	      { label: "Sony Xperia X", category: "Sony" },
	      { label: "OnePlus One", category: "OnePlus" },
	      { label: "OnePlus 2", category: "OnePlus" },
	      { label: "OnePlus X", category: "OnePlus" },
	      { label: "OnePlus 3", category: "OnePlus" },
	      { label: "OnePlus 3T", category: "OnePlus" },
	      { label: "OnePlus 5", category: "OnePlus" }
	    ];
	 
	    $( ".search-input" ).catcomplete({
	      delay: 0,
	      source: data
	    });
	});
}
