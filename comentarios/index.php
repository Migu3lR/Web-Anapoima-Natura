<?php $_GET['section']='initSite'; require('../layout.php'); ?>	
	
	<!-- Natura Wireframe -->
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">
	
  </head>
<body ng-controller="control" ng-cloak>
<?php $_GET['section']='header'; require('../layout.php'); ?>
<?php $_GET['section']='reservation'; require('../layout.php'); ?>
	<div id="inicio" style="height:1em"></div>
	<div id="comentarios">
		<div class="row">
			<div class="large-12 columns">
				<div class="callout large" >
					<div class="row text-center">
						<h1>Comentarios</h1>
					</div>
					
					<div class="row" ng-repeat="post in posts | limitTo : paginacion : paginacion*(pag-1)" >
						<div class="large-12 columns"><div class="callout small">
							<div class="row">
								<div class="left">
									<img class="avatar" src="../images/comentarios/user.png">
								</div>
								<div class="left">
									<h5>{{post.nombre}}</h5>
									<p class="puntaje" ng-if="post.rate != 0"><img ng-src="../images/comentarios/star{{post.rate}}.png"></p>
									<p class="fecha">{{post.fecha}}</p>
								</div>
							</div>
							<div class="row">
								<p>{{post.mensaje}}</p>
							</div>
							<hr>
						</div></div>
					</div>
					
					<div class="row text-center"><div class="large-12 columns"><div class="callout small">
						<span ng-if="paginas > 1" class="pags" ng-repeat="i in paginas | range">
						
						<a ng-click="changePag(i)">{{ i }}</a>
						</span>
					</div></div></div>										
					
					
				</div>
			</div>
		</div>
	</div>

	<?php $_GET['section']='footer'; require('../layout.php'); ?>
	<script src="js/controller.Comentarios.js"> </script>
	
  </body>
</html>