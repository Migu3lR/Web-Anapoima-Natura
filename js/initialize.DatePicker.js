//Funcion fechaFormat para dar formato necesarioa a la fecha
function fechaFormat(fecha){
	var Dia = fecha.getDate();
	if(Dia < 10) Dia = ("0" + Dia).slice(-2);
	var Mes = fecha.getMonth() +　1;
	if(Mes < 10) Mes = ("0" + Mes).slice(-2);
	var Ano = fecha.getFullYear();
	return Dia + "-" + Mes + "-" + Ano;
}

//Esta funcion suma un dia mas a la fecha obtenida
function DiaMas1(fecha){
	return fechaFormat(new Date(fecha.getTime() + 24 * 60 * 60 * 1000));
} 

$(function() {
	var hoy = fechaFormat(new Date());
	var manana = DiaMas1(new Date());	
	
	document.getElementById("from").value = hoy;
	document.getElementById("to").value = manana;
	
		//Se define parametros para fecha inicio en barra de reservas
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
		//Se define parametros para fecha final en barra de reservas
    $( "#to" ).datepicker({      
      changeMonth: true,   
      changeYear:true,
	  dateFormat: 'dd-mm-yy',
      minDate:1,
	  defaultDate: 1
    });
	
  });

