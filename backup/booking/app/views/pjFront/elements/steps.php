<?php 
$front_steps = __('front_steps', true);
$current_step = $front_steps['search'];

$step1 = ' disabled';
$step2 = ' disabled';
$step3 = ' disabled';
$step4 = ' disabled';
$step5 = ' disabled';
$step6 = ' disabled';

$STORE = @$_SESSION[$controller->defaultStore];

if ($_GET['action'] == 'pjActionSearch')
{
	$step1 = ' stivaBtnActive';
	$current_step = $front_steps['search'];
} elseif (isset($STORE['step_search'])) {
	$step1 = ' stivaBtnPassed';
}
if ($_GET['action'] == 'pjActionRooms')
{
	$step2 = ' stivaBtnActive';
	$current_step = $front_steps['rooms'];
} elseif (isset($STORE['step_rooms'])) {
	$step2 = ' stivaBtnPassed';
}
if ($_GET['action'] == 'pjActionExtras')
{
	$step3 = ' stivaBtnActive';
	$current_step = $front_steps['extras'];
} elseif (isset($STORE['step_extras'])) {
	$step3 = ' stivaBtnPassed';
}
if ($_GET['action'] == 'pjActionCheckout')
{
	$step4 = ' stivaBtnActive';
	$current_step = $front_steps['checkout'];
} elseif (isset($STORE['step_checkout'])) {
	$step4 = ' stivaBtnPassed';
}
if ($_GET['action'] == 'pjActionPreview')
{
	$step5 = ' stivaBtnActive';
	$current_step = $front_steps['preview'];
} elseif (isset($STORE['step_preview'])) {
	$step5 = ' stivaBtnPassed';
}
if ($_GET['action'] == 'pjActionBooking')
{
	$step6 = ' stivaBtnActive';
	$current_step = $front_steps['booking'];
}
?>
<div class="btn-group stivaNav">
	<button type="button" class="btn btn-default dropdown-toggle stivaBtnNav" data-toggle="dropdown" aria-expanded="false">
		<?php echo pjSanitize::html($current_step); ?>
		<span class="caret"></span>
	</button>

	<ul class="dropdown-menu text-uppercase" role="menu">
		<li><a href="#" class="btn btn-link stivaBtn hbSelectorSearch<?php echo $step1; ?>" role="button" style="text-align: left"><?php echo pjSanitize::html(@$front_steps['search']); ?></a></li>
		<li><a href="#" class="btn btn-link stivaBtn hbSelectorRooms<?php echo $step2; ?>" role="button" style="text-align: left"><?php echo pjSanitize::html(@$front_steps['rooms']); ?></a></li>
		<li><a href="#" class="btn btn-link stivaBtn hbSelectorExtras<?php echo $step3; ?>" role="button" style="text-align: left"><?php echo pjSanitize::html(@$front_steps['extras']); ?></a></li>
		<li><a href="#" class="btn btn-link stivaBtn hbSelectorCheckout<?php echo $step4; ?>" role="button" style="text-align: left"><?php echo pjSanitize::html(@$front_steps['checkout']); ?></a></li>
		<li><a href="#" class="btn btn-link stivaBtn hbSelectorPreview<?php echo $step5; ?>" role="button" style="text-align: left"><?php echo pjSanitize::html(@$front_steps['preview']); ?></a></li>
		<li><a href="#" class="btn btn-link stivaBtn<?php echo $step6; ?>" role="button" style="text-align: left"><?php echo pjSanitize::html(@$front_steps['booking']); ?></a></li>
	</ul><!-- /.dropdown-menu text-uppercase -->
</div><!-- /.btn-group stivaNav -->