<!--se llama a initSite del layout general -->
<?php $_GET['section']='initSite'; require('../layout.php'); ?>
  <!-- se invocan librerias para carga de la imagen de perfil de usuario -->
  <script src="../js/ng-file-upload-shim.min.js"></script>
  <script src="../js/ng-file-upload.min.js"></script>
  <script src="../js/ng-img-crop.js"></script>

  <link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">

  </head>
<body ng-controller="control" ng-cloak ng-show="isAuth"> <!-- se valida que el ingreso sea con un usuario logueado -->
<!--se llama a header del layout general -->
<?php $_GET['section']='header'; require('../layout.php'); ?>

<div id="inicio" style="height:3em"></div>
	<div id="profile">
		<div class="row">
			<div class="large-12 columns">
				<div class="callout large" >
					<div class="row text-center">
						<h2>Perfil de Usuario</h2><hr>
					</div>
					<!-- En el panel inicial se muestran opciones para entrar a distintas secciones -->
					<div class="row" >
						<div class="medium-4 small-12 columns text-center">
							<img class="avatar" ng-src="../avtr_uploads/{{userinfo.avatar}}">
              <div class="user_name"> <h5>{{userinfo.nmbre | limitTo : 20}}</h5> </div>
              <a href="editProfile.php" class="button"> Editar Perfil </a>
              <select ng-model="opcion">
                <option ng-repeat="opcion in opciones track by $index" value="{{opcion.opcion}}" ng-if="opcion.opcion !== 0" > {{opcion.descOpcion}} </option>
                <option ng-repeat="opcion in opciones track by $index" value="{{opcion.opcion}}" ng-if="opcion.opcion === 0" selected="selected"> {{opcion.descOpcion}} </option>
              </select>
						</div>
            <div ng-switch="opcion" class="medium-8 small-12 columns">

              <!-- PANEL PRINCIPAL -->
              <table ng-switch-default class="userProfile">
                <tr>
                  <td class="title">Usuario</td>
                  <td>{{roles[userinfo.rol].descRol}}</td>
                </tr>
                <tr>
                  <td class="title">Nombre Completo</td>
                  <td>{{userinfo.nmbre}}</td>
                </tr>
                <tr>
                  <td class="title">Correo Electrónico</td>
                  <td>{{userinfo.crreo}}</td>
                </tr>
                <tr>
                  <td class="title">Teléfono</td>
                  <td>{{userinfo.tlfno}}</td>
                </tr>
                <tr>
                  <td class="title">Nacionalidad</td>
                  <td>{{userinfo.ncnldad}}</td>
                </tr>
                <tr>
                  <td class="title">Ciudad</td>
                  <td>{{userinfo.cdad}}</td>
                </tr>
                <tr>
                  <td class="title">Fecha de Nacimiento</td>
                  <td>{{userinfo.fcha_ncmnto}}</td>
                </tr>
              </table>

              <!-- VER RESERVAS -->
              <div ng-switch-when="1">
                <div ng-repeat="book in userbookings">
                  <table class="userProfile">
                  <tr>
                    <td class="title">ID de Reserva</td>
                    <td>{{book.id_reserva}}</td>
                  </tr>
                  <tr>
                    <td class="title">Fecha de Reserva</td>
                    <td>{{book.fecha_reserva}}</td>
                  </tr>
                  <tr>
                    <td class="title">Estado de Reserva</td>
                    <td>{{book_status[book.estado_reserva]}}</td>
                  </tr>
                  <tr>
                    <td class="title">Fecha de Llegada</td>
                    <td>{{book.llegada_reserva}}</td>
                  </tr>
                  <tr>
                    <td class="title">Fecha de Retiro</td>
                    <td>{{book.retiro_reserva}}</td>
                  </tr>
                  </table>
                </div>
              </div>

              <!-- VER COMENTARIOS -->
              <div ng-switch-when=2>
                <div ng-repeat="coment in usercomments">
                  <table class="userProfile">
                  <tr>
                    <td class="title">Fecha</td>
                    <td>{{coment.fecha}}</td>
                  </tr>
                  <tr ng-if="coment.puntaje>0">
                    <td class="title">Puntaje otorgado</td>
                    <td><img ng-src="../images/comentarios/star{{coment.puntaje}}.png"../></td>
                  </tr>
                  <tr>
                    <td class="title">Comentario</td>
                    <td>{{coment.mensaje}}</td>
                  </tr>
                  </table>
                </div>
              </div>


						</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- seccion pie de pagina -->
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
<!-- librerias necesarias para el diiseño -->
<script src="../js/vendor/jquery.min.js"></script>
<script src="../js/Foundation.js"></script>
<!--Controlador de la vista -->
<script src="js/controller.UserProfile.js"> </script>
</body>
</html>
