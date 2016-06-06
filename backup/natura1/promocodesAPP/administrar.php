<html lang="es-ES" ng-app="app">
<head>
<meta charset="UTF-8" />
<title>Administracion Natura :: Codigos Promocionales</title>
<link rel='stylesheet' href='estilo.css' type='text/css' media='all' />
<script src="angular.min.js"></script>
<script src="angular-sanitize.min.js"> </script>
<script src="administrar.js"> </script>

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

<h2 ng-if="!codeEdit">Seleccione uno de los codigos para editar</h2>
<h2 ng-if="codeEdit">Llene los datos para modificar el codigo</h2>
<div style="clear:both">&nbsp;</div>
<form ng-if="codeEdit" accept-charset="UTF-8" ng-submit="editar()" >
<label><strong>Descripcion</strong> 
<input style="width: 215px" ng-model="dscr" ng-value="edit.dscr" size="31" type="text" required ng-change="changeDscr(dscr)"/></label>

<div style="clear:both">&nbsp;</div>
<label><strong>Tipo de Asignacion</strong> </label>
<table width="300px">
<tr>
<td><center><input type="radio" name="asgn" ng-model="asgn" value="Unico" required ng-change="changeA('Unico')" {{ a1 | html }}></center></td>
<td><center><input type="radio" name="asgn" ng-model="asgn" value="Masivo" required ng-change="changeA('Masivo')" {{ a2 | html }}></center></td>
<td><center><input type="radio" name="asgn" ng-model="asgn" value="Multiple" required ng-change="changeA('Multiple')" {{ a3 | html }}></center></td>
</tr>
<tr>
<td><center>Unico</center></td>
<td><center>Masivo</center></td>
<td><center>Multiple</center></td>
</tr>
</table>
<div style="clear:both">&nbsp;</div>
<div ng-if="!mostrar">
<div style="float:left; padding-right:50px;">
<label><strong>Busque los clientes a quienes les asignara el codigo</strong> </label>
<br>
<input style="width: 300px" type="text" ng-model="buscar" ng-change="searching(buscar)"><br>
<select style="width: 300px; height:100px" multiple>
<option ng-repeat="user in filtered" ng-dblclick="addUser(user)" value="{{ user }}">{{ user.nmbre | capitalize }}</option>
</select>
</div>
<div style="float:left">
<label><strong>Lista de clientes a asignar:</strong> </label>
<br>
<select style="width: 300px; height:120px"  multiple>
<option ng-dblclick="list.splice($index,1)" ng-repeat="user in list" value="{{ user }}">{{ user.nmbre | capitalize }}</option>
</select>
</div>
</div>
<div style="clear:both">&nbsp;</div>

<div style="float:left; padding-right:98px;">
<label><strong>Fecha de Inicio</strong>
<input style="width: 192px" ng-model="fmin" ng-value="edit.fmin" type="date" required ng-change="changeFmin(fmin)">
</label>
</div>

<div style="float:left; ">
<label><strong>Fecha de Fin</strong>
<input style="width: 208px" ng-model="fmax" ng-value="edit.fmax" type="date" required ng-change="changeFmax(fmax)">
</label>
</div>

<div style="clear:both">&nbsp;</div>
<label><strong>Descuento</strong>
<select name="dscn" ng-model="dscn" required ng-change="changeDscn(dscn)">
<option value="5" ng-selected="d5">5%</option>
<option value="10" ng-selected="d10">10%</option>
<option value="15" ng-selected="d15">15%</option>
</select>
</label>

<div style="clear:both">&nbsp;</div>
<button type="submit">Actualizar codigo</button>
</form>
<form ng-if="!codeEdit" accept-charset="UTF-8" ng-submit="select()" >
<table border="1" style="width:100%">
<tr>
<td>Codigo</td>
<td>Descripcion</td>
<td>Asignacion</td>
<td>Descuento %</td>
<td>Fecha inicio</td>
<td>Fecha final</td>
<td>Editar</td>
</tr>
<tr ng-repeat="code in codes" >
<td>{{ code.cdgo }}</td>
<td>{{ code.dscr }}</td>
<td>{{ code.asgn }}</td>
<td>{{ code.dscn }}</td>
<td>{{ code.fmin }}</td>
<td>{{ code.fmax }}</td>
<td><input type="radio" ng-model="e" value="{{ code.ID }}" ng-change="change(code.ID)"></td>
</tr>
</table>


<div style="clear:both">&nbsp;</div>
<button type="submit">Editar codigo seleccionado</button>
</form>
</div>
</div>
</body>
</html>
