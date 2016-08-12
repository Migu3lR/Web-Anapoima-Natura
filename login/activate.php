﻿<?php
if (!isset($_GET['tk'])) {
	header("Location: index.php");
	exit();	
}
?>

<!doctype html>
<html class="no-js" lang="en" ng-app="app">
<head>    
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Natura Anapoima</title>


<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../css/jquery-ui.css">
<link rel="stylesheet" href="../css/structure_layout.css">
<!-- AngularJS Framework -->
	<script src="../js/angular.min.js"></script>	
	<script src="../js/angular-hmac-sha512.js"></script>
	<script src="../js/angular-jwt.js"></script>
	<script src="../js/angular-storage.js"></script>
	<script src="../js/cookies.js"></script>
	<script src="../js/angular-animate.js"></script>	
	<script src="js/controller.Login.js"></script>

</head>
<body ng-controller="activate" ng-init="sendToken('<?php echo $_GET['tk']; ?>')">
</body>
</html>