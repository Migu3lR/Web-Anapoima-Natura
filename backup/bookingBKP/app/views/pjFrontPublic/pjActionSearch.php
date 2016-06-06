<?php
$week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
$jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);
$STORE = @$_SESSION[$controller->defaultStore];
?>
<div class="col-md-12 col-md-offset-1">
	<br>
	<div class="panel panel-default clearfix stivaPanel">
		<?php include dirname(__FILE__) . '/elements/head.php'; ?>

		<div class="panel-body stivaPanelBody">
			<h4 class="stivaPanelTitle"><?php __('front_title'); ?></h4>
			<br>
			<div class="row">
				<form action="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFrontPublic&amp;action=pjActionRoom" method="post" class="hbSelectorSearchForm stivaFormCheck">
					<input type="hidden" name="step_search" value="1" />
					<div class="col-lg-2 col-md-2">
						<div class="form-group">
							<label><?php __('front_adults'); ?></label>

							<select class="form-control" name="adults" data-msg-required="<?php __('front_validate_adults', false, true); ?>">
							<?php
							foreach (range(1, 10) as $i)
							{
								?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php
							}
							?>
							</select>
						</div>
					</div><!-- /.col-md-3 -->
					
					<div class="col-lg-2 col-md-2">
						<div class="form-group">
							<label><?php __('front_children'); ?></label>

							<select class="form-control" name="children">
							<?php
							foreach (range(0, 10) as $i)
							{
								?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php
							}
							?>
							</select>
						</div>
					</div><!-- /.col-md-3 -->

					<div class="col-lg-3 col-md-4">
						<div class="form-group stivaCalendar">
							<label for="from"><?php __('front_check_in'); ?></label>

							<div class="input-group">
								<input type="text" class="form-control hbSelectorDatepick" name="date_from" readonly="readonly" value="<?php echo pjUtil::formatDate(isset($STORE['date_from']) && !empty($STORE['date_from']) ? $STORE['date_from'] : date("Y-m-d", strtotime("+1 day")), "Y-m-d", $tpl['option_arr']['o_date_format']); ?>" data-dformat="<?php echo $jqDateFormat; ?>" data-fday="<?php echo $week_start; ?>" data-msg-required="<?php __('front_validate_date_from', false, true); ?>">
								<a href="#" class="input-group-addon calendar-trigger"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></a>
							</div>
						</div>
					</div><!-- /.col-md-3 -->
					
					<div class="col-lg-3 col-md-4">
						<div class="form-group stivaCalendar">
							<label for="to"><?php __('front_check_out'); ?></label>
							
							<div class="input-group">
								<input type="text" class="form-control hbSelectorDatepick" name="date_to" readonly="readonly" value="<?php echo pjUtil::formatDate(isset($STORE['date_to']) && !empty($STORE['date_to']) ? $STORE['date_to'] : date("Y-m-d", strtotime("+2 day")), "Y-m-d", $tpl['option_arr']['o_date_format']); ?>" data-dformat="<?php echo $jqDateFormat; ?>" data-fday="<?php echo $week_start; ?>" data-msg-required="<?php __('front_validate_date_to', false, true); ?>">
								<a href="#" class="input-group-addon calendar-trigger"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></a>
							</div>
						</div>
					</div><!-- /.col-md-2 -->
					
					<div class="col-lg-2 col-sm-4">
						<div class="form-group">
							<label>&nbsp;</label>
							
							<div class="input-group">
								<button type="submit" class="btn btn-default btn-block"<?php echo !$tpl['isTrialExpired'] ? NULL : ' disabled'; ?>><?php __('front_search'); ?></button>
							</div>
						</div>
					</div><!-- /.col-md-2 -->
				</form>
			</div><!-- /.row -->
			<?php 
			if ($tpl['isTrialExpired'])
			{
				?><h4 class="stivaPanelTitle">*** StivaWeb.com trial account expired! ***</h4><?php
			}
			?>
		</div><!-- /.panel-body stivaPanelBody -->
	</div><!-- /.panel stivaPanel -->
</div><!-- /.col-md-10 -->