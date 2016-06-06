<!doctype html>
<html>
	<head>
		<title>Contact Us &amp; Subscription Plan</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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
	</head>
	<body>
		<div id="container">
			<div id="header">
				<a href="http://www.stivaweb.com/hotel/booking-software.php" id="logo" target="_blank"><img src="<?php echo PJ_INSTALL_URL . PJ_IMG_PATH; ?>backend/logo.png" alt="Hotel Booking Software" /></a>
			</div>
			<div id="middle">
				<div style="width: 900px; margin: 0 auto">
				<?php require $content_tpl; ?>
				</div>
			</div> <!-- middle -->
		</div> <!-- container -->
		<div id="footer-wrap">
			<div id="footer">
			   	<p><a href="http://www.stivaweb.com/hotel/booking-software.php" target="_blank">Hotel Booking Software</a> Copyright &copy; <?php echo date("Y"); ?> <a href="http://www.stivaweb.com" target="_blank">StivaWeb.com</a></p>
	        </div>
        </div>
	</body>
</html>