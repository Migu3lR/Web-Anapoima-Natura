<?php
include 'anServer.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$postdata = file_get_contents("php://input");
$d = json_decode($postdata);
//$d = json_decode('{"ID":"37","code":"COD-T37","dscr":"otro codigo","asgn":"Multiple","dscn":15,"fmin":"2016-01-01T05:00:00.000Z","fmax":"2016-12-12T05:00:00.000Z","clnt":[{"ID":"2","cdla":"2","nmbre":"migue2"}]}');
echo editarCodigo($d->ID, $d->code, $d->dscr, $d->asgn, $d->dscn, $d->fmin, $d->fmax, $d->clnt);


?>