<!DOCTYPE html>
<html lang="en"  class="no-js" ng-app="app">
<head>	
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Natura Anapoima</title>
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../css/structure_layout.css">
<!-- AngularJS Framework -->
	<script src="../js/angular.min.js"></script>	
	<script src="../js/angular-hmac-sha512.js"></script>
	<script src="../js/angular-jwt.js"></script>
	<script src="../js/angular-storage.js"></script>
  <script src="../js/cookies.js"></script>
		
</head>
<body ng-controller="control" ng-cloak>
	<?php $_GET['section']='header'; require('../layout.php'); ?> 
	
	<div id="inicio" style="height:5em"></div>
  	
    <iframe id="search" src="search.php" width="100%" frameborder="0"></iframe>
    
  	
	<footer>
		<div class="row text-center small-up-1 medium-up-3 large-up-3">
		<div class="column">
			<p>Desarrollo y programación Web: <a href="http://hitbizz.com" target="blank"> hitbizz.com</a></p>
		</div>
		<div class="column">
			<p>Diseño Gráfico: <a href="http://mickerstudio.com" target="blank">mickerstudio.com</a></p>
		</div>
		<div class="column">
			<p>www.anapoimanatura.com · Todos los derechos reservados</p>
		</div>
		</div>
	</footer>
	
	
  <!-- close wrapper, no more content after this -->
    </div>
  </div>
</div>

<script src="../js/vendor/jquery.min.js"></script>
<script src="../js/vendor/what-input.min.js"></script>
<script src="../js/Foundation.js"></script>
<script src="js/controller.Booking.js"> </script>

 <script language="javascript" type="text/javascript">
  
  document.getElementById('search').style.height = (document.body.scrollHeight)+'px';
  
  
  </script>
	    
</body>
</html>