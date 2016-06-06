function fechaFormat(fecha){
	var Dia = fecha.getDate();
	if(Dia < 10) Dia = ("0" + Dia).slice(-2);
	var Mes = fecha.getMonth() +　1;
	if(Mes < 10) Mes = ("0" + Mes).slice(-2);
	var Ano = fecha.getFullYear();
	return Dia + "-" + Mes + "-" + Ano;
}
function DiaMas1(fecha){
	return fechaFormat(new Date(fecha.getTime() + 24 * 60 * 60 * 1000));
} 

$(function() {
	var hoy = fechaFormat(new Date());
	var manana = DiaMas1(new Date());	
	
	document.getElementById("from").value = hoy;
	document.getElementById("to").value = manana;
	
    $( "#from" ).datepicker({
      changeMonth: true,  
      changeYear:true, 
	  dateFormat: 'dd-mm-yy',
      minDate:0,
	  defaultDate: 0,
      onSelect: function( selectedDate ) {
		  if(selectedDate >= $(this).datepicker('getDate')){
			  document.getElementById("to").value = DiaMas1($(this).datepicker('getDate'));
		  }
		  var min = $(this).datepicker('getDate');
		   if (min) {
			min.setDate(min.getDate() + 1);
		   }
		  $( "#to" ).datepicker( "option", "minDate", min );
      }
    });
    $( "#to" ).datepicker({      
      changeMonth: true,   
      changeYear:true,
	  dateFormat: 'dd-mm-yy',
      minDate:1,
	  defaultDate: 1
    });
	
  });


$(document).ready(function() {
    $("#Slider").owlCarousel({
		autoPlay: 10000,
		paginationSpeed : 1000,
		singleItem : true,
		pagination: true,
		navigation: true,
		navigationText: ["<img class='prev' src='images/home/prev.png'>","<img class='next' src='images/home/next.png'>"],
		addClassActive : true,
		transitionStyle : "fadeUp",
		stopOnHover : false
	});
	$(".accordion").smk_Accordion({
		showIcon: true, // Show the expand/collapse icons.
		animation: true, // Expand/collapse sections with slide aniamtion.
		closeAble: true, // Closeable section.
		closeOther: false, //Allow multiple sections to be open(boolean)
		slideSpeed: 200, // the speed of slide animation.
		activeIndex: 5
	});

	smoothScroll.init({
    selector: '[link]', // Selector for links (must be a valid CSS selector)
    speed: 1000, // Integer. How fast to complete the scroll in milliseconds
    easing: 'easeOutQuad', // Easing pattern to use
    offset: 64, // Integer. How far to offset the scrolling anchor location in pixels
    updateURL: true, // Boolean. If true, update the URL hash on scroll
});
});

var map;
function initMap() {
	marker={lat: 4.578355, lng: -74.522994};
	center={lat: 4.633131, lng: -74.26500};
ops = {
	zoom: 11,
	center: center,
	navigationControl: true,
	navigationControlOptions: {
	  style: google.maps.NavigationControlStyle.SMALL,
	  position: google.maps.ControlPosition.TOP_RIGHT
	},
	streetViewControl: false,
	mapTypeControl: false,
	disableDoubleClickZoom: true,
	scrollwheel: false,
	backgroundColor: '#f2efe9',
	mapTypeId: google.maps.MapTypeId.ROADMAP
  }
map = new google.maps.Map(document.getElementById('map'), ops);
var marker = new google.maps.Marker({
	position: marker,
	map: map,
	title: 'Natura, Anapoima'
});
}