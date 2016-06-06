<?php 
if (isset($_GET['theme']))
{
	?>
<!doctype html>
<html>
	<head>
		<title>Hotel Booking System by StivaWeb.com</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="fragment" content="!">
		<link href="<?php echo PJ_INSTALL_URL; ?>bookAdmin.php?controller=pjFront&action=pjActionLoadCss&cid=<?php echo @$_GET['cid']; ?><?php echo isset($_GET['theme']) && strlen($_GET['theme']) > 0 ? '&theme=' . (int) $_GET['theme'] : NULL; ?>" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<script type="text/javascript" src="<?php echo PJ_INSTALL_URL; ?>bookAdmin.php?controller=pjFront&action=pjActionLoad&cid=<?php echo @$_GET['cid']; ?><?php echo isset($_GET['theme']) && strlen($_GET['theme']) > 0 ? '&theme=' . (int) $_GET['theme'] : NULL; ?>"></script>
	</body>
</html>
	<?php 
} else {
	$titles = __('error_titles', true); 
	$bodies = __('error_bodies', true);
	pjUtil::printNotice(@$titles['AO40'], @$bodies['AO40'], false);
	?>
	<ul class="preview-themes">
	<?php 
	foreach (range(1,10) as $i)
	{
		$text = sprintf("%s %u", __('install_theme', true), $i);
		$isCurrent = (int) $tpl['option_arr']['o_theme'] == $i;
		?>
		<li>
			<?php 
			if (!$isCurrent)
			{
				?><a class="preview-thumb" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminOptions&action=pjActionPreview&amp;cid=<?php echo $controller->getForeignId(); ?>&amp;theme=<?php echo $i; ?>" target="_blank"><img src="<?php echo PJ_IMG_PATH; ?>backend/themes/<?php echo $i; ?>.jpg" alt="<?php echo $text; ?>"></a><?php
			} else {
				?><a class="preview-thumb preview-checked" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminOptions&action=pjActionPreview&amp;cid=<?php echo $controller->getForeignId(); ?>&amp;theme=<?php echo $i; ?>" target="_blank"><img src="<?php echo PJ_IMG_PATH; ?>backend/themes/<?php echo $i; ?>.jpg" alt="<?php echo $text; ?>"><i></i></a><?php
			}
			?>
			<span><a class="preview-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminOptions&action=pjActionPreview&amp;cid=<?php echo $controller->getForeignId(); ?>&amp;theme=<?php echo $i; ?>" target="_blank"><?php echo $text; ?></a></span>
			<?php 
			if (!$isCurrent)
			{
				?><span><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminOptions&action=pjActionPreview&amp;use=<?php echo $i; ?>" class="pj-button"><?php __('preview_use_theme'); ?></a></span><?php
			} else {
				?><span class="preview-current"><?php __('preview_theme_current'); ?></span><?php
			}
			?>
		</li>
		<?php
	}
	?>
	</ul>
	<?php 
}
?>