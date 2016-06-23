<!doctype html>
<html class="no-js" lang="en" ng-app="app">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Natura Anapoima</title>
	
<?php

if(isset($_POST['buscar'])){
	if(isset($_POST['adultos']) && isset($_POST['ninos']) && isset($_POST['from']) && isset($_POST['to'])){
		$adultos = $_POST['adultos'];
		$ninos = $_POST['ninos'];
		$from = $_POST['from'];
		$to = $_POST['to'];
		
		$book_url = '../booking/#!/Rooms/date_from:' . $from . '/date_to:' . $to . '/adults:' . $adultos . '/children:' . $ninos;
		
		header("Location: " . $book_url);
		exit();
	}
}
?>
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
	
	<!-- Natura Wireframe -->
	<link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="css/structure_layout.css">
    
        
	<!-- Natura System -->
	<script src="../js/angular.min.js"></script>	
    <script src="js/natura.js"> </script>
	
  </head>
<body ng-controller="control" ng-cloak>
<?php $_GET['section']='header'; require('../layout.php'); ?>
<?php $_GET['section']='reservation'; require('../layout.php'); ?>
<img src="http://placehold.it/2000x3000" alt="" />

<?php $_GET['section']='footer'; require('../layout.php'); ?>

<script src="../js/vendor/jquery-1.10.2.js"></script>
    <script src="../js/vendor/jquery-ui.js"></script>	
    <script src="../js/vendor/what-input.min.js"></script>
	
	<script src="../js/structure.js"></script>
	
	<!-- Apps -->
	
	<script src="../js/smooth-scroll.js"></script> <!-- SmoothScrolling -->
	
	<script src="js/initialize.js"></script> <!-- SlideShow -->
	