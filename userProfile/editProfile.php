<?php $_GET['section']='initSite'; require('../layout.php'); ?>

  <script src="../js/ng-file-upload-shim.min.js"></script>
  <script src="../js/ng-file-upload.min.js"></script>
  <script src="../js/ng-img-crop.js"></script>
        
  <link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">
  		
  </head>
<body ng-controller="control" ng-cloak  ng-show="isAuth">

<?php $_GET['section']='header'; require('../layout.php'); ?>



<div id="inicio" style="height:3em"></div>
	<div id="profile">
		<div class="row">
			<div class="large-12 columns">
				<div class="callout large" >
					<div class="row text-center">
						<h2>Perfil de Usuario</h2><hr>
					</div>
					
          <!-- Pestañas con formularios de edicion de perfil -->
          <div class="row collapse">
            <div class="medium-3 columns">
              <ul class="tabs vertical" id="example-vert-tabs" data-tabs>
                <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Datos personales</a></li>
                <li class="tabs-title"><a href="#panel2v">Cambiar foto de Perfil</a></li>
                <li class="tabs-title"><a href="#panel3v">Información general</a></li>
                <li class="tabs-title"><a href="#panel4v">Información Financiera</a></li>
                <li class="tabs-title"><a href="#panel5v">Opciones de Seguridad</a></li>
              </ul>
              <a href="index.php" class="button bt_volver"> Volver al Panel Principal </a>
            </div>
            <div class="medium-9 columns">
              <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
                <div class="tabs-panel is-active" id="panel1v">
                  <form accept-charset="UTF-8" ng-submit="editPersonal(nombre,telefono,pais,ciudad,nacimiento)">
                  <table class="editPersonal">
                    <tr>
                      <td class="title">Nombre Completo</td>
                      <td><input type="text" maxlength="50" ng-value="userinfo.nmbre" ng-model="nombre" Required></td>
                    </tr>
                    <tr>
                      <td class="title">Teléfono</td>
                      <td><input type="text" maxlength="10" ng-value="userinfo.tlfno" ng-model="telefono"></td>
                    </tr>
                    <tr>
                      <td class="title">Nacionalidad</td>
                      <td><input type="text" maxlength="20" ng-value="userinfo.ncnldad" ng-model="pais" Required></td>
                    </tr>
                    <tr>
                      <td class="title">Ciudad</td>
                      <td><input type="text" maxlength="20" ng-value="userinfo.cdad" ng-model="ciudad" Required></td>
                    </tr>
                    <tr>
                      <td class="title">Fecha de Nacimiento</td>
                      <td><input type="text" maxlength="10" ng-value="userinfo.fcha_ncmnto" ng-model="nacimiento" Required></td>
                    </tr>
                  </table>
                  <button type="submit" class="success button">Guardar cambios</button>
                  </form>
                </div>
                <div class="tabs-panel" id="panel2v">
                  
                  <form name="myForm" >
                    <p>Imagen de perfil actual:</p>
                    <img ng-src="../avtr_uploads/{{userinfo.avatar}}">
                    <br><br>
                    <p>Seleccione o arrastre una imagen almacenada en su equipo y subala a su perfil:</p>
                    
                    <div ngf-drop ng-model="picFile" ngf-pattern="image/*"
                        class="cropArea">
                        <img-crop image="picFile  | ngfDataUrl"                 
                        result-image="croppedDataUrl" ng-init="croppedDataUrl=''">
                        </img-crop>
                    </div>
                    <button ngf-select ng-model="picFile" accept="image/*" class="button secondary">Seleccione una imagen</button>
                    <button ng-disabled="picFile.name==null" ng-click="upload(croppedDataUrl, userinfo.id_cln)" class="button success">Subir imagen a mi perfil</button> 
                    <br> 
                    
                </form>
                  
                </div>
                <div class="tabs-panel" id="panel3v">
                  <p>Proximamente...</p>
                </div>
                <div class="tabs-panel" id="panel4v">
                  <p>Proximamente...</p>
                </div>
                <div class="tabs-panel" id="panel5v">
                  <h4> Cambiar contraseña </h4>
                  <form accept-charset="UTF-8" ng-submit="editPwd(anterior,confirmacion,nueva)">
                  <table class="editPersonal">
                    <tr>
                      <td class="title">
                        <label ng-class="valid.anterior ? '' : 'error'">Actual Contraseña:</label>
                      </td>
                      <td>
                        <input type="password" autocomplete="off"  required ng-model="anterior">
                        <span ng-if="!valid.anterior">Este campo es obligatorio. Debes ingresar tu contraseña actual.</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="title">
                        <label ng-class="valid.nueva ? '' : 'error'">Nueva Contraseña</label>
                      </td>
                      <td>
                        <input type="password" autocomplete="off"  required ng-model="nueva">
                        <span ng-if="!valid.nueva">La contranseña debe ser de minimo 8 caracteres.</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="title">
                        <label ng-class="valid.confirmacion ? '' : 'error'">Confirmar Contraseña</label>
                      </td>
                      <td>
                        <input type="password" autocomplete="off"  required ng-model="confirmacion">
                        <span ng-if="!valid.confirmacion" >Debes ingresar la misma contraseña del campo anterior.</span>
                      </td>
                    </tr>
                  </table>
                  <button type="submit" class="success button">Guardar cambios</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
					
        </div>
      </div>
    </div>
  </div>
</div>


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

<script src="../js/vendor/jquery.min.js"></script>
<script src="../js/Foundation.js"></script>
<script src="js/controller.UserProfile.js"> </script>
</body>
</html>
	