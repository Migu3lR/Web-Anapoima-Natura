<!DOCTYPE html>
<html lang="en"  class="no-js" ng-app="app">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Natura Anapoima</title>

        <!--Se llaman las librerias necesarias de estilo CSS -->
        <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/structure_layout.css">
        <!-- Se llaman las librerias necesarias de Angular para JS -->
        <script src="../js/angular.min.js"> </script>	<!-- Core -->
        <script src="../js/angular-hmac-sha512.js"></script> <!-- Cifrafo SHA -->
        <script src="../js/angular-jwt.js"></script> <!-- JWT Token -->
        <script src="../js/angular-storage.js"></script> <!-- Handle del Storage Web -->
        <script src="../js/cookies.js"></script> <!-- Handle de Cookies -->
    </head>
    <body ng-controller="control" ng-cloak>
        <?php
            $_GET['section']='header';
            require('../layout.php');
        ?>
        <!-- Se invoca plantilla del Header -->
        <div id="inicio" style="height:5em"></div>

        <!-- Dentro de este IFRAME se invoca el formulario de consultas de reserva del aplicativo -->
        <?php
        $book_url = "";
        if(isset($_GET['date_from']) && isset($_GET['date_to']) && isset($_GET['adults']) && isset($_GET['children'])){
            $from = $_GET['date_from'];
            $to = $_GET['date_to'];
            $adultos = $_GET['adults'];
            $ninos = $_GET['children']; 
        
            $book_url = '#!/Rooms/date_from:' . $from . '/date_to:' . $to . '/adults:' . $adultos . '/children:' . $ninos;
        }
        //echo $book_url;
        //var_dump($_SERVER);
        ?>
        <iframe id="search" src="search.php<?php echo $book_url; ?>" width="100%" frameborder="0"></iframe>

        <!-- Seccion pie de pagina -->
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
        </div></div></div>

        <!-- Se invocan librerias necesarias para Angular y el diseño del sitio -->
        <script src="../js/vendor/jquery.min.js"></script> <!-- Jquery necesario Foundation (Diseño) -->
        <script src="../js/vendor/what-input.min.js"></script> <!-- Necesario para Foundation (Multiplataforma) --><script src="../js/Foundation.js"></script> <!-- Core de Foundation para el diseño -->
        <script src="js/controller.Booking.js"> </script> <!-- Controlador angular de esta vista -->
        <script language="javascript" type="text/javascript">
            document.getElementById('search').style.height = (document.body.scrollHeight)+'px';
        </script>
    </body>
</html>