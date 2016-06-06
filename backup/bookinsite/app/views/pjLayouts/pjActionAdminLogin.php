<!doctype html>
<html>
	<head>
		<title>Reservaciones - Natura Anapoima</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
		<?php
		foreach ($controller->getCss() as $css)
		{
			echo '<link type="text/css" rel="stylesheet" href="'.(isset($css['remote']) && $css['remote'] ? NULL : PJ_INSTALL_URL).$css['path'].$css['file'].'" />';
		}
		
		foreach ($controller->getJs() as $js)
		{
			echo '<script src="'.(isset($js['remote']) && $js['remote'] ? NULL : PJ_INSTALL_URL).$js['path'].$js['file'].'"></script>';
		}
		?>
		<link rel="stylesheet" href="css/structure.css" /> 
		<link rel="stylesheet" href="css/design.css" />
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div id="logo">
					<a href="http://anapoimanatura.com/booking/" target="_blank">Sistema de Reservas</a>
				</div>
			</div>
			<div id="middle">
				<div id="login-content">
				<?php require $content_tpl; ?>
				</div>
			</div> <!-- middle -->
		</div> <!-- container -->
        </div>
	</body>
</html>