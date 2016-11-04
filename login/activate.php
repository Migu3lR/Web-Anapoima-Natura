﻿<!-- se valida que al iniciar este sitio, se haya ingresado el parametro tk via GET con el token de activacion de usuario -->
<?php
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

<!-- Fuente del sitio -->
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
<!-- Estilos del sitio -->
<link rel="stylesheet" href="../css/jquery-ui.css">
<link rel="stylesheet" href="../css/structure_layout.css">
<!-- Librerias JS para control del sitio -->
	<script src="../js/angular.min.js"></script> <!-- Core de Angular -->
	<script src="../js/angular-hmac-sha512.js"></script> <!-- Libreria para encriptar -->
	<script src="../js/angular-jwt.js"></script> <!-- Libreria para lectura y generacion de Token jwt de seguridad -->
	<script src="../js/angular-storage.js"></script> <!-- Libreria para control de storage web -->
	<script src="../js/cookies.js"></script> <!-- Libreria para control de Cookies -->
	<script src="../js/angular-animate.js"></script> <!-- Libreria para animaciones web -->
	<script src="js/controller.Login.js"></script> <!-- Controlador del sitio -->

</head>
<!-- Al iniciar el sitio se llama a la funcion sendToken del Controlador del sitio -->
<!-- enviando como parametro el token de activacion recibido -->
<body ng-controller="activate" ng-init="sendToken('<?php echo $_GET['tk']; ?>')">
</body>
</html>