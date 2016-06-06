/* Initialize */
var body = document.body; 
var html = document.documentElement; 

var segDelay 	= 3;

var activado = 0;

var capacidadF	= 75;
var diasF		= 365;
var	bookingF	= 88;
var	visitantesF	= 95;

var capacidad	= 0;
var	dias		= 0;
var	booking		= 0;
var	visitantes	= 0;

var intC;
var intD;
var intB;
var intV;

/*  Scores Script  */
	/*  Rounded number  */
var start_angle = -0.5 * Math.PI;
var end_angleV = (1.5*Math.PI * visitantesF) / 100;
var end_angleB = (1.5*Math.PI * bookingF) / 100;
var arc_end_angleV = start_angle;
var arc_end_angleB = start_angle;
//var angle_stepV = end_angleV/segDelay;
var angle_stepV = (1.5*Math.PI * visitantes) / 100;
var angle_stepB = (1.5*Math.PI * booking) / 100;

var canvasB = document.getElementById('arcBooking');
var canvasV = document.getElementById('arcVisitantes');
var contextB = canvasB.getContext('2d');
var contextV = canvasV.getContext('2d');

function drawB() {
    contextB.beginPath();
    contextB.lineWidth = 6;
	contextB.lineJoin = 'round';
	contextB.lineCap = "round";
	contextB.arc(
        canvasB.width / 2,
        canvasB.height / 2,
        (canvasB.width/2)-(contextB.lineWidth/2),
        start_angle,
        arc_end_angleB,
        false);
	contextB.stroke();
	arc_end_angleB = (1.5*Math.PI * (booking-20)) / 100;
}
function drawV() {
    contextV.beginPath();
    contextV.lineWidth = 6;
	contextV.lineJoin = 'round';
	contextV.lineCap = "round";
	contextV.arc(
        canvasV.width / 2,
        canvasV.height / 2,
        (canvasV.width/2)-(contextV.lineWidth/2),
        start_angle,
        arc_end_angleV,
        false);
	contextV.stroke();
	arc_end_angleV = (1.5*Math.PI * visitantes) / 100;
}      
// requestAnimationFrame(drawB);
// requestAnimationFrame(drawB);
// requestAnimationFrame(drawB);
// requestAnimationFrame(drawB);
// requestAnimationFrame(drawB);
// requestAnimationFrame(drawB);
// requestAnimationFrame(drawB);


/*  Sequence  */	
function sumarC(){ 
	capacidad  += 1; 
	document.getElementById("pntj1").innerHTML = "<h1>"+capacidad+"</h1>";
	if (capacidad >= capacidadF) clearInterval(intC); 
}
function sumarD(){ 
	dias 	   += 1; 
	document.getElementById("pntj2").innerHTML = "<h1>"+dias+"</h1>";
	if (dias >= diasF) clearInterval(intD);
}
function sumarB(){ 
	booking    += 1; 
	document.getElementById("pntj3").innerHTML = "<h1>"+(booking/10)+"</h1>";
	if (booking >= bookingF) clearInterval(intB);
}
function sumarArcB(){ 
	requestAnimationFrame(drawB);
	if (end_angleB >= arc_end_angleB) clearInterval(intArcB);
}
function sumarV(){ 
	visitantes += 1; 
	document.getElementById("pntj4").innerHTML = "<h1>"+(visitantes/10)+"</h1>";
	if (visitantes >= visitantesF) clearInterval(intV);
}
function sumarArcV(){ 
	requestAnimationFrame(drawV);
	if (end_angleV >= arc_end_angleV) clearInterval(intArcV);
}

function activarPntj(){
	intC = setInterval(sumarC, (segDelay*1000)/capacidadF);
	intD = setInterval(sumarD, (segDelay*1000)/diasF);
	intB = setInterval(sumarB, (segDelay*1000)/bookingF);
	intArcB = setInterval(sumarArcB, (segDelay*1000)/end_angleB);
	intV = setInterval(sumarV, (segDelay*1000)/visitantesF);
	intArcV = setInterval(sumarArcV, (segDelay*1000)/end_angleV);
	
	activado = 1;
}
document.addEventListener('scroll', 
	function(event){
		var scroll = document.body.scrollTop + document.documentElement.scrollTop;
		if (scroll >= 1446 && activado == 0){ activarPntj();}
	}
,true);
