var body = document.body; 
var html = document.documentElement; 

var activado = 0;

var capacidadF	= 75;
var diasF		= 365;
var	bookingF	= 88;
var	visitantesF	= 95;

var capacidad	= 0;
var	dias		= 0;
var	booking		= 0;
var	visitantes	= 0;

var segDelay 	= 3;

var intC;
var intD;
var intB;
var intV;

function sumarC(){ 
	capacidad  += 1; 
	document.getElementById("pntj1").innerHTML = "<h1>"+capacidad+"</h1>";
	if (capacidad == capacidadF) clearInterval(intC); 
}
function sumarD(){ 
	dias 	   += 1; 
	document.getElementById("pntj2").innerHTML = "<h1>"+dias+"</h1>";
	if (dias == diasF) clearInterval(intD);
}
function sumarB(){ 
	booking    += 1; 
	document.getElementById("pntj3").innerHTML = "<h1>"+(booking/10)+"</h1>";
	if (booking == bookingF) clearInterval(intB);
}
function sumarV(){ 
	visitantes += 1; 
	document.getElementById("pntj4").innerHTML = "<h1>"+(visitantes/10)+"</h1>";
	if (visitantes == visitantesF) clearInterval(intV);
}

function activarPntj(){
	intC = setInterval(sumarC, (segDelay*1000)/capacidadF);
	intD = setInterval(sumarD, (segDelay*1000)/diasF);
	intB = setInterval(sumarB, (segDelay*1000)/bookingF);
	intV = setInterval(sumarV, (segDelay*1000)/visitantesF);
	activado = 1;
}
document.addEventListener('scroll', 
	function(event){
		var scroll = document.body.scrollTop + document.documentElement.scrollTop;
		if (scroll >= 1446 && activado == 0){ activarPntj();}
	}
,true);