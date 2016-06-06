<?php
include 'anServer.php';
$c = $_GET['c'];

if( isset($c)){
	$query = "SELECT id_user FROM `assignm` WHERE id_code='" . $c . "'";
	$resp = jsonList($query);
	echo $resp;
}
?>