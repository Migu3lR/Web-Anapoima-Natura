<?php
include 'anServer.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$postdata = file_get_contents("php://input");
$d = json_decode($postdata);
$cod = nuevoCodigo($d->asgn);
echo generarCodigo($cod, $d->dscr, $d->asgn, $d->dscn, $d->fmin, $d->fmax, $d->clnt);


?>