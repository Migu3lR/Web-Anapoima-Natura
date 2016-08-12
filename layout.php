<?php if(isset($_GET['section']) && $_GET['section']=='initSite'){ ?> 

<!doctype html>
<html class="no-js" lang="en" ng-app="app">
<head>
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Natura Anapoima</title>

<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/desarrollo/css/jquery-ui.css">
<link rel="stylesheet" href="/desarrollo/css/structure_layout.css">
<!-- AngularJS Framework -->
	<script src="/desarrollo/js/angular.min.js"></script>	
	<script src="/desarrollo/js/angular-hmac-sha512.js"></script>
	<script src="/desarrollo/js/angular-jwt.js"></script>
	<script src="/desarrollo/js/angular-storage.js"></script>
	<script src="/desarrollo/js/cookies.js"></script>

<?php } ?>

<?php if(isset($_GET['section']) && $_GET['section']=='header'){ 
  $isAuth = false; 
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
        <li><a id="item1" link href="/desarrollo/index.php#inicio">INICIO</a></li>
        <li><a id="item2" link href="/desarrollo/index.php#hospedaje">HOSPEDAJE</a></li>
        <li><a id="item3" link href="/desarrollo/index.php#reservas">RESERVAS</a></li>
        <li><a id="item4" link href="/desarrollo/index.php#servicios">SERVICIOS</a></li>
        <li><a id="item5" link href="/desarrollo/index.php#galeria">GALERÍA</a></li>
        <li><a id="item6" link href="/desarrollo/index.php#contacto">CONTACTO</a></li>
      </ul>
    </div>

    <!-- off-canvas right menu -->
    <?php if($isAuth) { //////////////////$isAuth ?>
      <div class="off-canvas position-right" id="offCanvasRight" data-off-canvas data-position="right">
        <ul class="vertical dropdown menu" data-dropdown-menu>
          <?php if($rol==='1') { ?>
            <li><a href="/desarrollo/userProfile">Perfil de Usuario</a></li>
            <li><a href="/desarrollo/userAdmin">Gestion de Usuarios</a></li>
            <li><a href="/desarrollo/booking/bookAdmin.php">Gestion de Reservas</a></li>
            <li><a href="/desarrollo/comentAdmin">Gestion de Comentarios</a></li>
            <li><a href="/desarrollo/promosAdmin">Códigos Promocionales</a></li>
            <li><a href="#" ng-click="goLogout()">CERRAR SESIÓN</a></li>
          <?php } if($rol==='0') { ?>
            <li><a href="/desarrollo/userProfile">Perfil de Usuario</a></li>
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
			  <a href="/desarrollo/"><img src="/desarrollo/images/home/logo.png" alt="Natura Anapoima"> </a>
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
            <li><a link id="item1" href="/desarrollo/index.php#inicio">INICIO</a></li>
            <li><a link id="item2" href="/desarrollo/index.php#hospedaje">HOSPEDAJE</a></li>
            <li><a link id="item3" href="/desarrollo/index.php#reservas">RESERVAS</a></li>
            <li><a link id="item4" href="/desarrollo/index.php#servicios">SERVICIOS</a></li>
            <li><a link id="item5" href="/desarrollo/index.php#galeria">GALERÍA</a></li>
            <li><a link id="item6" href="/desarrollo/index.php#contacto">CONTACTO</a></li>
            <?php if($isAuth) { //////////////////$isAuth ?>
            <li class="has-submenu">
                <?php if($rol === '1') { ?>
                <a href="#">ADMINISTRACIÓN</a>
                <ul class="submenu menu vertical" data-submenu>
                    <li><a href="/desarrollo/userProfile">Perfil de Usuario</a></li>
                    <li><a href="/desarrollo/userAdmin">Gestion de Usuarios</a></li>
                    <li><a href="/desarrollo/booking/bookAdmin.php">Gestion de Reservas</a></li>
                    <li><a href="/desarrollo/comentAdmin">Gestion de Comentarios</a></li>
                    <li><a href="/desarrollo/promosAdmin">Códigos Promocionales</a></li>
                    <li><a href="#" ng-click="goLogout()">CERRAR SESIÓN</a></li>
                </ul>
                <?php } if($rol === '0') { ?>
                <a ng-show="user.rol==0" href="#">MI CUENTA</a>
                <ul ng-show="user.rol==0" class="submenu menu vertical" data-submenu>
                  <li><a href="/desarrollo/userProfile">Perfil de Usuario</a></li>
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
<?php } ?>

<?php if(isset($_GET['section']) && $_GET['section']=='reservation'){ ?>
<div id="reservation" class="stick">
	
	<form name="registro" accept-charset="UTF-8" method="post" action="/desarrollo/booking/bar.php">
		<div class="field">
			<select name="adultos" required autocomplete="off">
				<option value="" disabled selected hidden>Adultos</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select>
		</div>
		<div class="field">
			<select name="ninos" required autocomplete="off">
				<option value="" disabled selected hidden>Niños</option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select>
		</div>
		
		<div  class="field">
			<input type="text" id="from" name="from"  placeholder="Llegada" required autocomplete="off" />
		</div>
		<div class="field">
			<input type="text" id="to" name="to" placeholder="Salida" required autocomplete="off" />
		</div>
		<div class="search">
		<button type="submit" class="promo_button button" name="buscar" />Reservar</button>
		</div>
		
	</form>
	
	</div>
<?php } ?>


<?php if(isset($_GET['section']) && $_GET['section']=='footer'){ ?>
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
	
	<div id="separator"></div>
  <!-- close wrapper, no more content after this -->
    </div>
  </div>
</div>

<script src="/desarrollo/js/vendor/jquery.min.js"></script>
<script src="/desarrollo/js/vendor/jquery-ui.js"></script>	
<script src="/desarrollo/js/vendor/what-input.min.js"></script>
<script src="/desarrollo/js/Foundation.js"></script>
<script src="/desarrollo/js/initialize.DatePicker.js"></script>

<?php } ?>


<?php if(isset($_GET['section']) && $_GET['section']=='initAdmin'){ ?>
  <title>ADMINISTRACION NATURA</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- jQuery UI -->
    <link href="/desarrollo/css/jquery-ui.css" rel="stylesheet" media="screen">
    <!-- Bootstrap -->
    <link href="/desarrollo/adminResources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="/desarrollo/adminResources/css/styles.css" rel="stylesheet">
	
	  <link href="/desarrollo/adminResources/css/angular-chart.css" rel="stylesheet">
    <link rel="stylesheet" href="/desarrollo/adminResources/css/ngDialog.css"></script>
    <link rel="stylesheet" href="/desarrollo/adminResources/css/ngDialog-theme-default.css"></script>
	
	<script src="/desarrollo/js/jinqjs.js"></script>
	<script src="/desarrollo/js/moment.js"></script>
	<script src="/desarrollo/js/angular.min.js"></script>
	<script src="/desarrollo/js/ngDialog.js"></script>     
	<script src="/desarrollo/js/Chart.js"></script>
	<script src="/desarrollo/js/angular-moment.js"></script>
	<script src="/desarrollo/js/angular-chart.js"></script>
	<script src="/desarrollo/js/angular-jwt.js"></script>
	<script src="/desarrollo/js/angular-storage.js"></script>
	<script src="/desarrollo/js/cookies.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<?php } ?>

<?php if(isset($_GET['section']) && $_GET['section']=='endAdmin'){ ?>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/desarrollo/js/vendor/jquery.min.js"></script>
	<!-- jQuery UI -->
    <script src="/desarrollo/js/vendor/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/desarrollo/adminResources/bootstrap/js/bootstrap.min.js"></script>
<?php } ?>