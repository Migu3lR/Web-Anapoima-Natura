<html lang="es-ES" ng-app="app">

<head>
<meta charset="UTF-8" />
<title>Administracion Natura :: Codigos Promocionales</title>
<link rel='stylesheet' href='estilo.css' type='text/css' media='all' />
<script src="angular.min.js"></script>
		<script src="aprobar.js"> </script>
</head>
<body ng-controller="control">

	<div class="fullwidth" >
		<div class="menu">
			<span> <a href="generar.html"> Generar </a> </span>
			<span> <a href="administrar.php"> Administrar </a> </span>
			<span> <a href="aprobar.php"> Aprobar </a> </span>
		</div>
		<div class="content">
		<div style="clear:both">&nbsp;</div>
		<h2>Seleccione los codigos que desea aprobar</h2>
		<div style="clear:both">&nbsp;</div>
			<form accept-charset="UTF-8" ng-submit="aprobar()" >
			<table border="1" style="width:100%">
				<tr>
					<td>Codigo</td>
					<td>Descripcion</td>
					<td>Asignacion</td>
					<td>Descuento %</td>
					<td>Fecha inicio</td>
					<td>Fecha final</td>
					<td>Aprobar</td>
				</tr>
				<tr ng-repeat="code in codes" >
					<td>{{ code.cdgo }}</td>
					<td>{{ code.dscr }}</td>
					<td>{{ code.asgn }}</td>
					<td>{{ code.dscn }}</td>
					<td>{{ code.fmin }}</td>
					<td>{{ code.fmax }}</td>
					<td><input type="checkbox" ng-model="z" ng-change="change(code.ID)"></td>
				</tr>
			
			</table>
			<div style="clear:both">&nbsp;</div>
			<div><button type="submit">Aprobar codigos seleccionados</button></div>
			</form>
		
		</div>
	</div>
</body>
</html>
