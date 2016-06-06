<?php
$week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
$jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);

$days = __('days', true);
$new_days = array();
foreach($days as $k => $v)
{
	if($k >= $week_start)
	{
		$new_days[$k] = $v;
	}
}
foreach($days as $k => $v)
{
	if($k < $week_start)
	{
		$new_days[$k] = $v;
	}
}
$months = __('months', true);
$short_months = __('short_months', true);
ksort($months);
ksort($short_months);
$days = __('days', true);
$short_days = __('short_days', true);
?>
<form action="" method="post" class="pj-form form">
	<input type="hidden" name="add_package" value="1" />
	<p>
		<label class="title"><?php __('limit_room'); ?></label>
		<span class="inline_block">
			<?php
			if(!empty($tpl['room_arr']))
			{ 
				?>
				<select name="room_id" class="pj-form-field required" data-msg-required="<?php __('lblFieldRequired');?>">
					<option value="">-- <?php __('lblChoose'); ?> --</option>
					<?php
					foreach ($tpl['room_arr'] as $item)
					{
						?><option value="<?php echo $item['id']; ?>"><?php echo stripslashes($item['name']); ?></option><?php
					}
					?>
				</select>
				<?php
			}else{
				$message = __('lblNoRoomMessage', true);
				$message = str_replace("{STAG}", '<a href="'.$_SERVER['PHP_SELF'] . '?controller=pjAdminRooms&amp;action=pjActionCreate">', $message);
				$message = str_replace("{ETAG}", '</a>', $message);
				?><label class="block t5"><?php echo $message;?></label><?php
			} 
			?>
		</span>
	</p>
	<p>
		<label class="title"><?php __('limit_date_from'); ?></label>
		<span class="pj-form-field-custom pj-form-field-custom-after">
			<input type="text" name="date_from" id="date_from" class="pj-form-field pointer w80 datepick required" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" data-months="<?php echo join(',', $months);?>" data-shortmonths="<?php echo join(',', $short_months);?>" data-day="<?php echo join(',', $days);?>" data-daymin="<?php echo join(',', $short_days);?>"/>
			<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
		</span>
	</p>
	<p>
		<label class="title"><?php __('limit_date_to'); ?></label>
		<span class="pj-form-field-custom pj-form-field-custom-after">
			<input type="text" name="date_to" id="date_to" class="pj-form-field pointer w80 datepick required" data-msg-required="<?php __('lblFieldRequired');?>" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" data-months="<?php echo join(',', $months);?>" data-shortmonths="<?php echo join(',', $short_months);?>" data-day="<?php echo join(',', $days);?>" data-daymin="<?php echo join(',', $short_days);?>"/>
			<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
		</span>
	</p>
	<p>
		<label class="title"><?php __('discount_start_day'); ?></label>
		<span class="inline_block">
		<select name="start_day" class="pj-form-field required" data-msg-required="<?php __('lblFieldRequired');?>">
			<option value="">-- <?php __('lblChoose'); ?> --</option>
			<?php
			
			foreach ($new_days as $k => $v)
			{
				?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
			}
			?>
		</select>
		</span>
	</p>
	<p>
		<label class="title"><?php __('discount_end_day'); ?></label>
		<span class="inline_block">
		<select name="end_day" class="pj-form-field required" data-msg-required="<?php __('lblFieldRequired');?>">
			<option value="">-- <?php __('lblChoose'); ?> --</option>
			<?php
			foreach ($new_days as $k => $v)
			{
				?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
			}
			?>
		</select>
		</span>
	</p>
	<p>
		<label class="title"><?php __('discount_total_price'); ?></label>
		<span class="pj-form-field-custom pj-form-field-custom-before">
			<span class="pj-form-field-before"><abbr class="pj-form-field-icon-text"><?php echo pjUtil::formatCurrencySign(NULL, $tpl['option_arr']['o_currency'], ""); ?></abbr></span>
			<input type="text" name="total_price" class="pj-form-field align_right w70 number required" data-msg-required="<?php __('lblFieldRequired');?>"/>
		</span>
	</p>
</form>