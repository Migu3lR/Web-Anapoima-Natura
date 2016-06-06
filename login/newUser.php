<?php
include 'anServer.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$postdata = file_get_contents("php://input");
$d = json_decode($postdata);
echo nuevoUsuario($d->nombre, $d->apellido, $d->correo, $d->clave, $d->fecha, $d->telefono, $d->tipo, $d->documento, $d->nacionalidad, $d->municipio);


?>