<?php 
if (isset($tpl['api_upgrade_iframe'], $tpl['api_upgrade_iframe']['url']))
{
	?>
	<iframe src="<?php echo pjSanitize::html($tpl['api_upgrade_iframe']['url']); ?>" style="width: 100%; height: 700px" frameborder="0"></iframe>
	<?php 
}
?>