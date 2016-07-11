/* Initialize */
var body = document.body; 
var html = document.documentElement; 

var segDelay 	= 10;
var lineWidth 	= 8;

var activado = 0;

var	bookingF	= 93;
var	visitantesF	= 94;

var	booking		= 0;
var	visitantes	= 0;

var intB;
var intV;

/*  Scores Script  */
	/*  Rounded number  */
var start_angle = -0.5 * Math.PI;
var end_angleV = ((2*Math.PI * visitantesF) / 100) + start_angle;
var end_angleB = ((2*Math.PI * bookingF) / 100) + start_angle;
var arc_end_angleV = start_angle;
var arc_end_angleB = start_angle;
//var angle_stepV = end_angleV/segDelay;
var angle_stepV = (1.5*Math.PI * visitantes) / 100;
var angle_stepB = (1.5*Math.PI * booking) / 100;

var canvasB = document.getElementById('arcBooking');
var canvasV = document.getElementById('arcVisitantes');
var contextB0 = canvasB.getContext('2d');
var contextV0 = canvasV.getContext('2d');
var contextB = canvasB.getContext('2d');
var contextV = canvasV.getContext('2d');

contextB0.beginPath();
contextB0.lineWidth = lineWidth;
contextB0.lineJoin = 'round';
contextB0.lineCap = "round";
contextB0.globalAlpha=0.1;
contextB0.arc(
	canvasB.width / 2,
	canvasB.height / 2,
	(canvasB.width/2)-(contextB0.lineWidth/2),
	0,
	2*Math.PI);
contextB0.strokeStyle = '#000';
contextB0.webkitImageSmoothingEnabled=true;
contextB0.stroke();

contextV0.beginPath();
contextV0.lineWidth = lineWidth;
contextV0.lineJoin = 'round';
contextV0.lineCap = "round";
contextV0.globalAlpha=0.1;
contextV0.arc(
	canvasB.width / 2,
	canvasB.height / 2,
	(canvasB.width/2)-(contextV0.lineWidth/2),
	0,
	2*Math.PI);
contextV0.strokeStyle = '#000';
contextV0.webkitImageSmoothingEnabled=true;
contextV0.stroke();

function drawB() {
    contextB.beginPath();
    contextB.lineWidth = lineWidth;
	contextB.lineJoin = 'round';
	contextB.lineCap = "round";
	contextB.globalAlpha=1.0;
	contextB.arc(
        canvasB.width / 2,
        canvasB.height / 2,
        (canvasB.width/2)-(contextB.lineWidth/2),
        start_angle,
        arc_end_angleB,
        false);
	contextB.strokeStyle = '#fff';
	contextB.webkitImageSmoothingEnabled=true;
	contextB.stroke();
	arc_end_angleB = ((2*Math.PI * booking) / 100) + start_angle;
}
function drawV() {
    contextV.beginPath();
    contextV.lineWidth = lineWidth;
	contextV.lineJoin = 'round';
	contextV.lineCap = "round";
	contextV.globalAlpha=1.0;
	contextV.arc(
        canvasV.width / 2,
        canvasV.height / 2,
        (canvasV.width/2)-(contextV.lineWidth/2),
        start_angle,
        arc_end_angleV,
        false);
	contextV.strokeStyle = '#fff';
	contextB.webkitImageSmoothingEnabled=true;
	contextV.stroke();
	arc_end_angleV = ((2*Math.PI * visitantes) / 100) + start_angle;
}  

/*  Sequence  */	
function sumarB(){ 
	booking    += 1; 
	requestAnimationFrame(drawB);
	document.getElementById("pntj3").innerHTML = "<h1>" +
	((booking == 100) ? (booking/10) : (booking/10).toFixed(1)) +
	"</h1>";
	if (booking >= bookingF) clearInterval(intB);
}function sumarV(){ 
	visitantes += 1; 
	requestAnimationFrame(drawV);
	document.getElementById("pntj4").innerHTML = "<h1>" +
	((visitantes == 100) ? (visitantes/10) : (visitantes/10).toFixed(1)) +
	"</h1>";
	if (visitantes >= visitantesF) clearInterval(intV);
}

function activarPntj(){
	intB = setInterval(sumarB, (segDelay*1000)/bookingF);
	intV = setInterval(sumarV, (segDelay*1000)/visitantesF);
	
	activado = 1;
}


/* Menu Animation */
function existeClase(obj,cls)
  {
	return obj.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
	
  }

  function addClass(obj,cls)
  {
   if(!existeClase(obj,cls)) {
	obj.className+=" "+cls;
   }
  }
  
  function alterClass(obj,cls)
  {
   if(!existeClase(obj,cls)) {
    obj.className+=" "+cls;
   }
   else{
	   var exp =new RegExp('(\\s|^)'+cls+'(\\s|$)');
		obj.className=obj.className.replace(exp,"");
   }
  }

  function removeClass(obj,cls)
  {
   if(existeClase(obj,cls)) {
    var exp =new RegExp('(\\s|^)'+cls+'(\\s|$)');
    obj.className=obj.className.replace(exp,"");
   }
  }


var menu1 = document.getElementById('item1');
var menu2 = document.getElementById('item2');
var menu3 = document.getElementById('item3');
var menu4 = document.getElementById('item4');
var menu5 = document.getElementById('item5');
var menu6 = document.getElementById('item6');
var a = 'actual';

addClass(menu1,a);
removeClass(menu2,a);
removeClass(menu3,a);
removeClass(menu4,a);
removeClass(menu5,a);
removeClass(menu6,a);

/*  SCROLL LISTENER  */
document.addEventListener(
    'scroll',
    function(event){

var scroll = document.body.scrollTop + document.documentElement.scrollTop;   


if (scroll >= 1446 && activado == 0){ activarPntj();} /* Activa Puntajes */

    }
    ,true // Capture event
);

function getDist(id){
	var scrollTop     = $(window).scrollTop(),
        elementOffset = $('#'+id).offset().top,
        distance      = (elementOffset - scrollTop);
	return distance;
}
function seccion(id){
	var divh = document.getElementById(id).offsetHeight;
	var divh = divh * (-1);
	var dist = getDist(id) - document.getElementById('widemenu').offsetHeight;
	//console.log(id+'|'+dist+':'+divh);
	if(dist <= 0 && dist >= divh) return true;
	else return false
	
}
$(window).on('scroll', function () {
	if (seccion('Slider')){
	addClass(menu1,a);
	removeClass(menu2,a);
	removeClass(menu3,a);
	removeClass(menu4,a);
	removeClass(menu5,a);
	removeClass(menu6,a);
	}

	if (seccion('hospedaje')){
	addClass(menu2,a);
	removeClass(menu1,a);
	removeClass(menu3,a);
	removeClass(menu4,a);
	removeClass(menu5,a);
	removeClass(menu6,a);
	}

	if (seccion('reservas')){
	addClass(menu3,a);
	removeClass(menu2,a);
	removeClass(menu1,a);
	removeClass(menu4,a);
	removeClass(menu5,a);
	removeClass(menu6,a);
	}

	if (seccion('servicios') || seccion('puntajes')){
	addClass(menu4,a);
	removeClass(menu2,a);
	removeClass(menu3,a);
	removeClass(menu1,a);
	removeClass(menu5,a);
	removeClass(menu6,a);
	}

	if (seccion('galeria')){
	addClass(menu5,a);
	removeClass(menu2,a);
	removeClass(menu3,a);
	removeClass(menu4,a);
	removeClass(menu1,a);
	removeClass(menu6,a);
	}

	if (seccion('contacts')){
	addClass(menu6,a);
	removeClass(menu2,a);
	removeClass(menu3,a);
	removeClass(menu4,a);
	removeClass(menu5,a);
	removeClass(menu1,a);
	}
});


/////////////* ACCION BOTON CONTACTO HOME *///////////
var contact = document.getElementById('info');
var contact2 = document.getElementById('contactForm');
var contact3 = document.getElementById('social');
var cls = 'active';

function activate(){
	alterClass(contact,cls);
	alterClass(contact2,cls);
	alterClass(contact3,cls);
}

