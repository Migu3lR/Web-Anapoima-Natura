$(document).ready(function() {
    $("#Slider").owlCarousel({
		autoPlay: true,
		slideSpeed : 500,
		paginationSpeed : 400,
		singleItem : true,
		pagination: true,
		navigation: true,
		navigationText: ["<img class='prev' src='img/prev.png'>","<img class='next' src='img/next.png'>"],
		addClassActive : true,
		transitionStyle : "fadeUp",
		stopOnHover : false
	});
	$(".accordion").smk_Accordion({
		showIcon: true, // Show the expand/collapse icons.
		animation: true, // Expand/collapse sections with slide aniamtion.
		closeAble: true, // Closeable section.
		closeOther: false, //Allow multiple sections to be open(boolean)
		slideSpeed: 200 // the speed of slide animation.
	});

	/*$('#hospedaje').parallax({
		imageSrc: '../img/hospedaje.jpg',
		naturalHeight: 100
	});
	$('#servicios').parallax({
		imageSrc: '../img/servicios.jpg',
		naturalHeight: 100
	});*/
	
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