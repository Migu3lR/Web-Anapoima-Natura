<?php if(isset($_POST['buscar'])){
	//Este sitio recibe las solucitudes de la barra (formulario) de booking
	if(isset($_POST['adultos']) && isset($_POST['ninos']) && isset($_POST['from']) && isset($_POST['to'])){
		// Se consulta si los parametros necesarios para llamar al aplicativo de Booking estan completos
		$adultos = $_POST['adultos'];
		$ninos = $_POST['ninos'];
		$from = $_POST['from'];
		$to = $_POST['to'];
		
		$book_url = '/desarrollo/booking?date_from=' . $from . '&date_to=' . $to . '&adults=' . $adultos . '&children=' . $ninos;
		header("Location: " . $book_url); //Se llama al aplicativo con la funcion header de PHP...
		exit(); //Cerramos el codigo para asegurar el salto correcto de pagina.
	}
} ?>