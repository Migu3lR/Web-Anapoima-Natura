<?php
session_start();
session_destroy();
if(isset($_GET['returnUrl'])) {
    $u = $_GET['returnUrl'];	
    header("Location: /produccion/");
    exit;
} else{
    header("Location: /produccion/");
    exit;
}

?>