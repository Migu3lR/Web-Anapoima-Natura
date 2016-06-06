<?php
include 'anServer.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$json = jsonUsers();
echo $json;
?>