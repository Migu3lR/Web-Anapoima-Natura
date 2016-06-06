<?php
if (isset($tpl['status']))
{
	$status = __('status', true);
	switch ($tpl['status'])
	{
		case 2:
			pjUtil::printNotice(NULL, $status[2]);
			break;
	}
} else {
	?>
	<div id="welcome-box"><?php include dirname(__FILE__) . '/pjActionWelcomeGet.php'; ?></div>
	
	<div id="dialogWelcomeDone" title="<?php __('welcome_done_title', false, true); ?>" style="display:none"><?php __('welcome_done_body'); ?></div>
	<div id="dialogWelcomeSwitch" title="<?php __('welcome_switch_title', false, true); ?>" style="display:none"><?php __('welcome_switch_body'); ?></div>
	
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.btn_done = <?php __encode('welcome_switch_btn_done'); ?>;
	myLabel.btn_preview = <?php __encode('welcome_switch_btn_preview'); ?>;
	myLabel.btn_switch = <?php __encode('welcome_switch_btn_switch'); ?>;
	myLabel.btn_cancel = <?php __encode('welcome_switch_btn_cancel'); ?>;
	</script>
	<?php 
}
?>