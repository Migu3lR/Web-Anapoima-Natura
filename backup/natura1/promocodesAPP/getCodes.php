<?php
include 'anServer.php';
if( isset($_GET['e'])){
	$query = "SELECT * FROM `promocodes` WHERE estdo=" . $_GET['e'];
	$resp = jsonCodes($query);
	echo $resp;
}
?>