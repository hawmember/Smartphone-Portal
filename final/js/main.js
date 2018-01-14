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
	if ( $(".typed-text").length) { // checkt ob man auf der startseite ist
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

	// Oeffnen von Mehr Erfahren ALT
	// $(".handy-more .circle").click(function () {
	// 	$('.handy-info').toggleClass('open');
	// 	$('.handy-more .circle').toggleClass('open');
	// 	$('.handy-more .circle').toggleClass('close');
	// });

	// Wrap Class for handy model klein
	for($i = 0; $i <= 46; $i++){
		$( ".m"+$i+" ul > .speWrap" ).wrapAll( "<li class='spe'>Speicher: </li>");
		$( ".m"+$i+" ul > .farWrap" ).wrapAll( "<li class='far'>Farbe: </li>");
		$( ".m"+$i+" ul > .preWrap" ).wrapAll( "<li class='pre'>Preis: </li>");
	}
	// Wrap Class for handy model
	$( ".handy-model-gross ul > .speWrap" ).wrapAll( "<li class='spe'>Speicher: </li>");
	$( ".handy-model-gross ul > .farWrap" ).wrapAll( "<li class='far'>Farbe: </li>");
	$( ".handy-model-gross ul > .preWrap" ).wrapAll( "<li class='pre'>Preis: </li>");

	// Check Binaer and add class 
	$('span.binaer').filter(function(){
    	return $.trim($(this).text()) == '0'
	}).addClass("null");
	$('span.binaer').filter(function(){
    	return $.trim($(this).text()) == '1'
	}).addClass("one");


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
	hoverByClass("her");hoverByClass("abm");hoverByClass("gew");hoverByClass("speE");hoverByClass("bet");hoverByClass("pro");hoverByClass("arb");hoverByClass("atot");hoverByClass("acpu");hoverByClass("aux");hoverByClass("a3d");hoverByClass("aram");hoverByClass("dgro");hoverByClass("dauf");hoverByClass("dart");hoverByClass("fmeg");hoverByClass("fauf");hoverByClass("fbli");hoverByClass("fvid");hoverByClass("rmeg");hoverByClass("rauf");hoverByClass("rbli");hoverByClass("rvid");hoverByClass("dtot");hoverByClass("dfot");hoverByClass("dvid");hoverByClass("alau");hoverByClass("atyp");hoverByClass("akap");hoverByClass("awec");hoverByClass("mob");hoverByClass("spr");hoverByClass("ans");hoverByClass("kop");hoverByClass("ama");

	if (!$(".handy-model-gross").length) {
		hoverByClass("spe");hoverByClass("far");hoverByClass("pre");
	}

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

	// Tags
	$(".tags-open").click(function () { 
		$(".tags-item-wrap").toggleClass('active');
	});
	$(".tag-item").click(function () { 
		$(this).toggleClass('active-tag');
	});

	// Sortier Checkboxen
	$(".selected-item").click(function() {
	  $(this).toggleClass("select_onclick");
	  $(this).siblings(".option-wrap").toggleClass("active");
	});

	$('input[type="radio"]').on("click", function() {
	  var selectedOption = $(this).parents('.option').clone();
	  $(this).parents().siblings('.selected-item').html(selectedOption);
	  $(this).parents().removeClass("active");
	  $(this).parents().siblings('.selected-item').removeClass("select_onclick");
	});

	$(".option-wrap input").click(function(){
		document.getElementById("sortieren").submit();
	});

	$(".filter-bench input").click(function(){
		document.getElementById("sortierenBenchmark").submit();
	});

	// Filtersystem
	$('.filter-form').change(function(){
		for($i = 0; $i <= 46; $i++){
			// Speicher 8gb
			if($(".filter-spe .8gb").is(':checked')) {
				if (!$('.m'+$i+' .spe span.8').length) {
					$('.m'+$i).parent().fadeOut();
				}
			}
			// Speicher 16gb
			else if($(".filter-spe .16gb").is(':checked')) {
				if (!$('.m'+$i+' .spe span.16').length) {
					$('.m'+$i).parent().fadeOut();
				}
			}
			// Speicher 32gb
			else if($(".filter-spe .32gb").is(':checked')) {
				if (!$('.m'+$i+' .spe span.32').length) {
					$('.m'+$i).parent().fadeOut();
				}
			}
			// Speicher 64gb
			else if($(".filter-spe .64gb").is(':checked')) {
				if (!$('.m'+$i+' .spe span.64').length) {
					$('.m'+$i).parent().fadeOut();
				}
			}
			// Speicher 128gb
			else if($(".filter-spe .128gb").is(':checked')) {
				if (!$('.m'+$i+' .spe span.128').length) {
					$('.m'+$i).parent().fadeOut();
				}
			}
			// Speicher 256gb
			else if($(".filter-spe .256gb").is(':checked')) {
				if (!$('.m'+$i+' .spe span.256').length) {
					$('.m'+$i).parent().fadeOut();
				}
			}
			// Checkboxen An us Schalter
			else if($(".filter-erw .onoffswitch-checkbox").is(':checked')) {
				$element = $('.m'+$i+' .ama span.binaer').text();
				if ($element == "0") {
					$('.m'+$i).parent().fadeOut();
				}
			}
			else {
				$('.m'+$i).parent().fadeIn();
			}

		}
	});

    // gleiche hoehe
    boxSameHeight('.handy-model-klein .spe');
    boxSameHeight('.handy-model-klein .far');
    boxSameHeight('.handy-model-klein .pre');
    boxSameHeight('.handy-model-klein .bet');
    boxSameHeight('.handy-model-klein .atot');
    boxSameHeight('.handy-model-klein .dtot');

    $(window).resize(function() {
        boxSameHeight('.handy-model-klein .far');
        boxSameHeight('.handy-model-klein .pre');
        boxSameHeight('.handy-model-klein .bet');
        boxSameHeight('.handy-model-klein .atot');
        boxSameHeight('.handy-model-klein .dtot');
        boxSameHeight('.handy-model-klein .spe');
    });

});

// gleiche hoehe
var boxSameHeight = function(elem) {
    var highestBox = 0;
    $(elem).each(function(){  
        $(this).css('height','auto');
        if($(this).height() > highestBox){  
            highestBox = $(this).height();  
        }
    });    
    $(elem).height(highestBox);
};




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
	      { label: "iPhone", category: "Apple" },
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
	      { label: "Samsung Galaxy S", category: "Samsung" },
	      { label: "Samsung Galaxy S II", category: "Samsung" },
	      { label: "Samsung Galaxy S III", category: "Samsung" },
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
