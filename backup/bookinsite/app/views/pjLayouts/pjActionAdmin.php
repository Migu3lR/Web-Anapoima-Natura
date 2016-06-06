<!doctype html>
<html>
	<head>
		<title>Reservaciones - Natura Anapoima</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
		<?php
		foreach ($controller->getCss() as $css)
		{
			echo '<link type="text/css" rel="stylesheet" href="'.(isset($css['remote']) && $css['remote'] ? NULL : PJ_INSTALL_URL).$css['path'].htmlspecialchars($css['file']).'" />';
		}
		foreach ($controller->getJs() as $js)
		{
			echo '<script src="'.(isset($js['remote']) && $js['remote'] ? NULL : PJ_INSTALL_URL).$js['path'].htmlspecialchars($js['file']).'"></script>';
		}
		?>
		<!--[if gte IE 9]>
  		<style type="text/css">.gradient {filter: none}</style>
		<![endif]-->
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
			
			<?php 
			$include_menu = dirname(dirname(PJ_INSTALL_PATH)) . '/include-menu2.php';
			if (is_file($include_menu))
			{
				include $include_menu;
			}
			?>
			<div id="middle">
				<div id="leftmenu">
					<?php require PJ_VIEWS_PATH . 'pjLayouts/elements/leftmenu.php'; ?>
				</div>
				<div id="right">
					<div class="content-top"></div>
					<div class="content-middle" id="content">
					<?php require $content_tpl; ?>
					</div>
					<div class="content-bottom"></div>
				</div> <!-- content -->
				<div class="clear_both"></div>
			</div> <!-- middle -->
		
		</div> <!-- container -->
        </div>
	</body>
</html>