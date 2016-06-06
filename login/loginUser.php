<?php
include 'anServer.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$postdata = file_get_contents("php://input");
$d = json_decode($postdata);
echo entrarUsuario($d->correo, $d->clave);


?>