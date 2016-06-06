<?php 
if (isset($tpl['api_tickets_iframe'], $tpl['api_tickets_iframe']['url']))
{
	?>
	<iframe src="<?php echo pjSanitize::html($tpl['api_tickets_iframe']['url']); ?>" style="width: 100%; height: 700px; background: #fff; padding: 10px; border: none" frameborder="0"></iframe>
	<?php 
}
?>