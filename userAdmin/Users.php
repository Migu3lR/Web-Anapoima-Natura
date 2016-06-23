<?php
include 'anServer.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$data = file_get_contents("php://input");
$d = json_decode($data);
echo getUsers();
?>