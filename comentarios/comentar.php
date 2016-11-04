<!-- Se realiza validacion para iniciar este sitio (se debe ingresar con el parametro tk con el token para realizar comentario) -->
<!-- Si no trae el parametro tk se reenvia a index.php -->
<?php
if (!isset($_GET['tk'])){
	header("Location: index.php");
	exit();
}
?>
<!-- Se llama a initSite del layout general -->
	<?php $_GET['section']='initSite'; require('../layout.php'); ?>
	<!-- Estilos del sitio -->
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">

  </head>
<body ng-controller="control" ng-cloak>
<!-- Se llama a header del layout general -->
<?php $_GET['section']='header'; require('../layout.php'); ?>
<!-- Se llama a reservation del layout general -->
<?php $_GET['section']='reservation'; require('../layout.php'); ?>
	<div id="inicio" style="height:1em"></div>
	<div id="comentarios">
		<div class="row">
			<div class="large-12 columns">
				<div class="callout large" >
					<div class="row text-center">
						<h1>Comentarios</h1>
					</div>

				</div>
			</div>

					<div class="row"><div class="large-12 columns"><div class="callout small">
					<h4>¡DEJANOS UN COMENTARIO!</h4>
					<!-- Formulacion para digitar nuevo comentario. Al enviar se llama a la funcion newPost -->
						<form accept-charset="UTF-8" ng-submit="newPost(nombre,email,mensaje,rate,'<?php echo $_GET['tk']; ?>')">
							<div class="rate">
							<span>Calificanos: </span>
							<!-- Campo para seleccion de la puntuacion a asignar -->
							<span class="rating">
								<input type="radio" class="rating-input" id="rating-input-1-5" name="rating-input-1" ng-model="rate" value="5" />
								<label for="rating-input-1-5" class="rating-star"></label>
								<input type="radio" class="rating-input" id="rating-input-1-4" name="rating-input-1" ng-model="rate" value="4" />
								<label for="rating-input-1-4" class="rating-star"></label>
								<input type="radio" class="rating-input" id="rating-input-1-3" name="rating-input-1" ng-model="rate" value="3" />
								<label for="rating-input-1-3" class="rating-star"></label>
								<input type="radio" class="rating-input" id="rating-input-1-2" name="rating-input-1" ng-model="rate" value="2" />
								<label for="rating-input-1-2" class="rating-star"></label>
								<input type="radio" class="rating-input" id="rating-input-1-1" name="rating-input-1" ng-model="rate" value="1" />
								<label for="rating-input-1-1" class="rating-star"></label>
							</span>
							</div>
							<div class="name-field">
							<input type="text" required placeholder="Nombre" ng-model="nombre">
							</div>
							<div class="email-field">
							<input type="email" required	placeholder="Dirección de correo electrónico"  ng-model="email">
							</div>
							<div class="text-field">
							<textarea required rows="5"
							placeholder="Mensaje"  ng-model="mensaje"></textarea>
							</div>
							<button type="submit" class="promo_button button" >Enviar</button>
						</form>
					</div></div></div>

				</div>
			</div>
		</div>
	</div>
<!-- Se llama a footer del layout general -->
	<?php $_GET['section']='footer'; require('../layout.php'); ?>
	<script src="js/controller.Comentarios.js"> </script>
  </body>
</html>