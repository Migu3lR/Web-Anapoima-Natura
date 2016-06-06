<h1 class="welcome-h1"><?php __('welcome_heading'); ?></h1>

<p class="welcome-text"><?php __('welcome_text_1'); ?></p> 
<p class="welcome-text"><?php __('welcome_text_2'); ?></p>

<div class="welcome-steps">
	<div class="welcome-step<?php echo (int) $tpl['option_arr']['o_welcome_done_1'] === 1 ? ' welcome-step-done' : NULL; ?>">
		<div class="welcome-step-title"><?php __('welcome_step_1_title'); ?></div>
		<div class="welcome-step-desc"><?php __('welcome_step_1_desc'); ?></div>
		<div class="welcome-step-row">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
				<input type="hidden" name="controller" value="pjAdminRooms" />
				<input type="hidden" name="action" value="pjActionIndex" />
				<button type="submit" class="pj-button"><?php __('welcome_step_1_btn'); ?></button>
			</form>
		</div>
		<?php
		if ((int) $tpl['option_arr']['o_welcome_done_1'] === 1)
		{
			?><i class="welcome-step-check"></i><?php
		} else {
			?><div class="welcome-step-row"><a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="welcome-skip" data-index="1"><?php __('welcome_step_done'); ?></a></div><?php
		}
		?>
	</div>
	
	<div class="welcome-step<?php echo (int) $tpl['option_arr']['o_welcome_done_2'] === 1 ? ' welcome-step-done' : NULL; ?>">
		<div class="welcome-step-title"><?php __('welcome_step_2_title'); ?></div>
		<div class="welcome-step-desc"><?php __('welcome_step_2_desc'); ?></div>
		<div class="welcome-step-row">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
				<input type="hidden" name="controller" value="pjAdminRooms" />
				<input type="hidden" name="action" value="pjActionPrices" />
				<button type="submit" class="pj-button"><?php __('welcome_step_2_btn'); ?></button>
			</form>
		</div>
		<?php
		if ((int) $tpl['option_arr']['o_welcome_done_2'] === 1)
		{
			?><i class="welcome-step-check"></i><?php
		} else {
			?><div class="welcome-step-row"><a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="welcome-skip" data-index="2"><?php __('welcome_step_done'); ?></a></div><?php
		}
		?>
	</div>
	
	<div class="welcome-step<?php echo (int) $tpl['option_arr']['o_welcome_done_3'] === 1 ? ' welcome-step-done' : NULL; ?>">
		<div class="welcome-step-title"><?php __('welcome_step_3_title'); ?></div>
		<div class="welcome-step-desc"><?php __('welcome_step_3_desc'); ?></div>
		<div class="welcome-step-row">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
				<input type="hidden" name="controller" value="pjAdminOptions" />
				<input type="hidden" name="action" value="pjActionIndex" />
				<input type="hidden" name="tab" value="7" />
				<button type="submit" class="pj-button"><?php __('welcome_step_3_btn'); ?></button>
			</form>
		</div>
		<?php
		if ((int) $tpl['option_arr']['o_welcome_done_3'] === 1)
		{
			?><i class="welcome-step-check"></i><?php
		} else {
			?><div class="welcome-step-row"><a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="welcome-skip" data-index="3"><?php __('welcome_step_done'); ?></a></div><?php
		}
		?>
	</div>
	
	<div class="welcome-step<?php echo (int) $tpl['option_arr']['o_welcome_done_4'] === 1 ? ' welcome-step-done' : NULL; ?>">
		<div class="welcome-step-title"><?php __('welcome_step_4_title'); ?></div>
		<div class="welcome-step-desc"><?php __('welcome_step_4_desc'); ?></div>
		<div class="welcome-step-row">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
				<input type="hidden" name="controller" value="pjAdminOptions" />
				<input type="hidden" name="action" value="pjActionIndex" />
				<input type="hidden" name="tab" value="5" />
				<button type="submit" class="pj-button"><?php __('welcome_step_4_btn'); ?></button>
			</form>
		</div>
		<?php
		if ((int) $tpl['option_arr']['o_welcome_done_4'] === 1)
		{
			?><i class="welcome-step-check"></i><?php
		} else {
			?><div class="welcome-step-row"><a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="welcome-skip" data-index="4"><?php __('welcome_step_done'); ?></a></div><?php
		}
		?>
	</div>
	
	<div class="welcome-step<?php echo (int) $tpl['option_arr']['o_welcome_done_5'] === 1 ? ' welcome-step-done' : NULL; ?>">
		<div class="welcome-step-title"><?php __('welcome_step_5_title'); ?></div>
		<div class="welcome-step-desc"><?php __('welcome_step_5_desc'); ?></div>
		<div class="welcome-step-row">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
				<input type="hidden" name="controller" value="pjAdminOptions" />
				<input type="hidden" name="action" value="pjActionIndex" />
				<input type="hidden" name="tab" value="3" />
				<button type="submit" class="pj-button"><?php __('welcome_step_5_btn'); ?></button>
			</form>
		</div>
		<?php
		if ((int) $tpl['option_arr']['o_welcome_done_5'] === 1)
		{
			?><i class="welcome-step-check"></i><?php
		} else {
			?><div class="welcome-step-row"><a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="welcome-skip" data-index="5"><?php __('welcome_step_done'); ?></a></div><?php
		}
		?>
	</div>
	
	<div class="welcome-step<?php echo (int) $tpl['option_arr']['o_welcome_done_6'] === 1 ? ' welcome-step-done' : NULL; ?>">
		<div class="welcome-step-title"><?php __('welcome_step_6_title'); ?></div>
		<div class="welcome-step-desc"><?php __('welcome_step_6_desc'); ?></div>
		<div class="welcome-step-row">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
				<input type="hidden" name="controller" value="pjAdminOptions" />
				<input type="hidden" name="action" value="pjActionIndex" />
				<input type="hidden" name="tab" value="6" />
				<button type="submit" class="pj-button"><?php __('welcome_step_6_btn'); ?></button>
			</form>
		</div>
		<?php
		if ((int) $tpl['option_arr']['o_welcome_done_6'] === 1)
		{
			?><i class="welcome-step-check"></i><?php
		} else {
			?><div class="welcome-step-row"><a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="welcome-skip" data-index="6"><?php __('welcome_step_done'); ?></a></div><?php
		}
		?>
	</div>
</div>

<div class="welcome-contact"><?php __('welcome_contact'); ?></div>