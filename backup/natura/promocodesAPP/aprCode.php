<?php
include 'anServer.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$postdata = file_get_contents("php://input");

$codes = json_decode($postdata);
$cod = $codes -> codes; 
$er = 0;
foreach ($cod as $code){
	$a = $code -> ap;
	
	if ($a) {
		$rsl = aprobarCodigo($code -> ID);
		if(!$rsl) $er++;
	}
}
echo json_encode('{"error":'. $er .'}');
?>