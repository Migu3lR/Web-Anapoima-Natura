<?php 
function get_ang($key){
  $t = "'token'";
  ob_start();
  echo '<input type="hidden" value="<script>document.write(localStorage.getItem($t));</script>" />';
  $myStr = ob_get_contents();
  ob_end_clean();
  return $myStr;
}

if(isset($_GET['section']) && $_GET['section']=='header'){ ?>

<div  class="off-canvas-wrapper">
  <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
    <?php 
      
      $auth = get_ang("{{isAuth}}");
      echo $auth[28];
    ?>
    <!-- off-canvas title bar for 'small' screen -->
    <div class="title-bar" data-responsive-toggle="widemenu" data-hide-for="large">
      <div class="title-bar-left">
        <button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
        <span class="title-bar-title">NATURA</span>
      </div>
      <?php 
      if(true) {//////////////////$isAuth 
        echo '<div class="title-bar-right">';
        echo '<span class="title-bar-title">', (true ? 'Administración' : 'Mi Cuenta'), '</span>'; //////////////////$rol
        echo '<button class="menu-icon" type="button" data-open="offCanvasRight"></button>';
        echo '</div>';
      } else{
        echo '<div class="title-bar-right">';
        echo '<span class="title-bar-title"><a href="http://localhost/login/">Iniciar Sesión</a></span>';
        echo '</div>';
      } ?>
    </div>

    <!-- off-canvas left menu -->
    <div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
      <ul class="vertical dropdown menu" data-dropdown-menu>
        <li><a id="item1" link href="http://localhost/index.php#inicio">INICIO</a></li>
        <li><a id="item2" link href="http://localhost/index.php#hospedaje">HOSPEDAJE</a></li>
        <li><a id="item3" link href="http://localhost/index.php#reservas">RESERVAS</a></li>
        <li><a id="item4" link href="http://localhost/index.php#servicios">SERVICIOS</a></li>
        <li><a id="item5" link href="http://localhost/index.php#galeria">GALERÍA</a></li>
        <li><a id="item6" link href="http://localhost/index.php#contacto">CONTACTO</a></li>
      </ul>
    </div>

    <!-- off-canvas right menu -->
    <?php if(true) { //////////////////$isAuth ?>
      <div class="off-canvas position-right" id="offCanvasRight" data-off-canvas data-position="right">
        <ul class="vertical dropdown menu" data-dropdown-menu>
          <?php if($rol) { ?>
            <li><a href="#">Clientes</a></li>
            <li><a href="http://localhost/booking/bookAdmin.php">Reservaciones</a></li>
            <li><a href="http://localhost/comentAdmin">Gestion de Comentarios</a></li>
            <li><a href="http://localhost/promocodesAPP">Códigos Promocionales</a></li>
            <li><a href="http://localhost/login/logout.php">CERRAR SESIÓN</a></li>
          <?php } if(!$rol) { ?>
            <li><a href="#">Portal de Usuario</a></li>
            <li><a href="http://localhost/login/logout.php">CERRAR SESIÓN</a></li>
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
			  <a href="/"><img src="http://localhost/images/home/logo.png" alt="Natura Anapoima"> </a>
			</div>
          </li>
        </ul>
      </div>
      <div class="top-bar-right">
        <div class="user" ng-switch="isAuth()">
		<p ng-switch-when="true"> {{"Bienvenido " + user.name}} </p>
		<p ng-switch-default><a href="http://localhost/login/">Inicia sesión en Natura!</a></p>
		</div>
        <ul class="menu" data-responsive-menu="drilldown medium-dropdown">
            <li><a id="item1" href="http://localhost/index.php#inicio">INICIO</a></li>
            <li><a id="item2" href="http://localhost/index.php#hospedaje">HOSPEDAJE</a></li>
            <li><a id="item3" href="http://localhost/index.php#reservas">RESERVAS</a></li>
            <li><a id="item4" href="http://localhost/index.php#servicios">SERVICIOS</a></li>
            <li><a id="item5" href="http://localhost/index.php#galeria">GALERÍA</a></li>
            <li><a id="item6" href="http://localhost/index.php#contacto">CONTACTO</a></li>
        
            <li class="has-submenu" ng-if="isAuth()">
                <a ng-show="user.rol==1" href="#">ADMINISTRACIÓN</a>
                <ul ng-show="user.rol==1" class="submenu menu vertical" data-submenu>
                    <li><a href="#">Clientes</a></li>
                    <li><a href="http://localhost/booking/bookAdmin.php">Reservaciones</a></li>
                    <li><a href="http://localhost/comentAdmin">Gestion de Comentarios</a></li>
                    <li><a href="http://localhost/promocodesAPP">Códigos Promocionales</a></li>
                    <li><a href="http://localhost/login/logout.php">CERRAR SESIÓN</a></li>
                </ul>
                <a ng-show="user.rol==0" href="#">MI CUENTA</a>
                <ul ng-show="user.rol==0" class="submenu menu vertical" data-submenu>
                  <li><a href="#">Portal de Usuario</a></li>
                  <li><a href="http://localhost/login/logout.php">CERRAR SESIÓN</a></li>
                </ul>
            </li>
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
	
	<form name="registro" accept-charset="UTF-8" method="post" action="index.php">
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
			<input type="text" id="from" name="from"  placeholder="Llegada" required autocomplete="off"/>
		</div>
		<div class="field">
			<input type="text" id="to" name="to" placeholder="Salida" required autocomplete="off"/>
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
<?php } ?>