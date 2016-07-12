<!DOCTYPE html>
<html lang="en"  class="no-js" ng-app="app">
<head>	
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Natura Anapoima</title>
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/css/structure_layout.css">
<!-- AngularJS Framework -->
	<script src="/js/angular.min.js"></script>	
	<script src="/js/angular-hmac-sha512.js"></script>
	<script src="/js/angular-jwt.js"></script>
	<script src="/js/angular-storage.js"></script>
  <script src="/js/cookies.js"></script>
		
</head>
<body ng-controller="control" ng-cloak>
	<?php $isAuth = false; 
  $rol = 0; 
  if(isset($_COOKIE['x'])) { 
     $isAuth = true; 
     $rol = $_COOKIE['x']; 
  }
  ?>
<div  class="off-canvas-wrapper">
  <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
    <!-- off-canvas title bar for 'small' screen -->
    <div class="title-bar" data-responsive-toggle="widemenu" data-hide-for="large">
      <div class="title-bar-left">
        <button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
        <span class="title-bar-title">NATURA</span>
      </div>
      <?php 
      if($isAuth) {//////////////////$isAuth 
        echo '<div class="title-bar-right">';
        echo '<span class="title-bar-title">', (($rol==='1') ? 'Administración' : 'Mi Cuenta'), '</span>'; //////////////////$rol
        echo '<button class="menu-icon" type="button" data-open="offCanvasRight"></button>';
        echo '</div>';
      } else{
        echo '<div class="title-bar-right">';
        echo '<span class="title-bar-title"><a href="#" ng-click="goLogin()">Iniciar Sesión</a></span>';
        echo '</div>';
      } ?>
    </div>

    <!-- off-canvas left menu -->
    <div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
      <ul class="vertical dropdown menu" data-dropdown-menu>
        <li><a id="item1" link href="/index.php#inicio">INICIO</a></li>
        <li><a id="item2" link href="/index.php#hospedaje">HOSPEDAJE</a></li>
        <li><a id="item3" link href="/index.php#reservas">RESERVAS</a></li>
        <li><a id="item4" link href="/index.php#servicios">SERVICIOS</a></li>
        <li><a id="item5" link href="/index.php#galeria">GALERÍA</a></li>
        <li><a id="item6" link href="/index.php#contacto">CONTACTO</a></li>
      </ul>
    </div>

    <!-- off-canvas right menu -->
    <?php if($isAuth) { //////////////////$isAuth ?>
      <div class="off-canvas position-right" id="offCanvasRight" data-off-canvas data-position="right">
        <ul class="vertical dropdown menu" data-dropdown-menu>
          <?php if($rol==='1') { ?>
            <li><a href="#">Clientes</a></li>
            <li><a href="/booking/bookAdmin.php">Reservaciones</a></li>
            <li><a href="/comentAdmin">Gestion de Comentarios</a></li>
            <li><a href="/promocodesAPP">Códigos Promocionales</a></li>
            <li><a href="#" ng-click="goLogout()">CERRAR SESIÓN</a></li>
          <?php } if($rol==='0') { ?>
            <li><a href="#">Portal de Usuario</a></li>
            <li><a href="#" ng-click="goLogout()">CERRAR SESIÓN</a></li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>
    <!-- "wider" top-bar menu for 'medium' and up -->
    <div id="widemenu" class="top-bar stick">
    <div class="row column menu-wrap">
	<div class="callout large">
      <div class="top-bar-left">
        <ul class="menu">
          <li class="menu-text">
            <div class="logo-container" >
			  <a href="/"><img src="/images/home/logo.png" alt="Natura Anapoima"> </a>
			</div>
          </li>
        </ul>
      </div>
      <div class="top-bar-right">
        <div class="user">
		<?php if($isAuth) echo '<p> {{"Bienvenido " + user.name}} </p>'; ?>
		<?php if(!$isAuth) echo '<p><a href="#" ng-click="goLogin()">Inicia sesión en Natura!</a></p>'; ?>
		</div>
        <ul class="menu" data-responsive-menu="drilldown medium-dropdown">
            <li><a link id="item1" href="/index.php#inicio">INICIO</a></li>
            <li><a link id="item2" href="/index.php#hospedaje">HOSPEDAJE</a></li>
            <li><a link id="item3" href="/index.php#reservas">RESERVAS</a></li>
            <li><a link id="item4" href="/index.php#servicios">SERVICIOS</a></li>
            <li><a link id="item5" href="/index.php#galeria">GALERÍA</a></li>
            <li><a link id="item6" href="/index.php#contacto">CONTACTO</a></li>
            <?php if($isAuth) { //////////////////$isAuth ?>
            <li class="has-submenu">
                <?php if($rol === '1') { ?>
                <a href="#">ADMINISTRACIÓN</a>
                <ul class="submenu menu vertical" data-submenu>
                    <li><a href="#">Clientes</a></li>
                    <li><a href="/booking/bookAdmin.php">Reservaciones</a></li>
                    <li><a href="/comentAdmin">Gestion de Comentarios</a></li>
                    <li><a href="/promocodesAPP">Códigos Promocionales</a></li>
                    <li><a href="#" ng-click="goLogout()">CERRAR SESIÓN</a></li>
                </ul>
                <?php } if($rol === '0') { ?>
                <a ng-show="user.rol==0" href="#">MI CUENTA</a>
                <ul ng-show="user.rol==0" class="submenu menu vertical" data-submenu>
                  <li><a href="#">Portal de Usuario</a></li>
                  <li><a href="#" ng-click="goLogout()">CERRAR SESIÓN</a></li>
                </ul>
                <?php } ?>
            </li>
            <?php } ?>
        </ul>
      </div>
    </div>
    </div>
    </div>

<!-- original content goes in this container -->
<div class="off-canvas-content" data-off-canvas-content> 
	
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

<script src="/js/vendor/jquery.min.js"></script>
<script src="/js/vendor/what-input.min.js"></script>
<script src="/js/Foundation.js"></script>
<script src="js/controller.Booking.js"> </script>

 <script language="javascript" type="text/javascript">
  
  document.getElementById('search').style.height = (document.body.scrollHeight)+'px';
  
  
  </script>
	    
</body>
</html>