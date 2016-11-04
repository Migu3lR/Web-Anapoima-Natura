<!-- Este sitio es una plantilla base para creacion de otros sitios -->

<!-- Se llama a initSite del layout general que contiene librerias y estilos generales-->
<?php $_GET['section']='initSite'; require('../layout.php'); ?>

  </head>
<!-- Si se necesita un controlador, se invoca en el body -->
<body ng-controller="control" ng-cloak>
<!-- Se invoca la seccion header del layout general que contiene encabezado del sitio con menu -->
<?php $_GET['section']='header'; require('../layout.php'); ?>
<!-- Si se requiere se puede llamar a la barra de reservas incovacion reservacion del layout general -->
<?php $_GET['section']='reservation'; require('../layout.php'); ?>
<img src="http://placehold.it/2000x3000" alt="" />
<!-- Se invoca footer del layout general -->
<?php $_GET['section']='footer'; require('../layout.php'); ?>
<!-- Si se necesita un controlador, en este punto se llama al js del mismo -->
<script src="js/controller.Layout.js"> </script>
</body>
</html>
