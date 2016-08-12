<?php if(isset($_POST['buscar'])){
	if(isset($_POST['adultos']) && isset($_POST['ninos']) && isset($_POST['from']) && isset($_POST['to'])){
		$adultos = $_POST['adultos'];
		$ninos = $_POST['ninos'];
		$from = $_POST['from'];
		$to = $_POST['to'];
		
		$book_url = '/desarrollo/booking/#!/Rooms/date_from:' . $from . '/date_to:' . $to . '/adults:' . $adultos . '/children:' . $ninos;
		
		header("Location: " . $book_url);
		exit();
	}
} ?>