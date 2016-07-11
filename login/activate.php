﻿<?php
if (!isset($_GET['tk'])) header("Location: index.php");
?>

<!doctype html>
<html class="no-js" lang="en" ng-app="app">
<head>
	
    <?php $_GET['section']='initSite'; require('../layout.php'); ?> 
	
	<script src="/js/angular-animate.js"></script>	
	<script src="js/controller.Login.js"></script>

</head>
<body ng-controller="activate" ng-init="sendToken('<?php echo $_GET['tk']; ?>')">
</body>
</html>