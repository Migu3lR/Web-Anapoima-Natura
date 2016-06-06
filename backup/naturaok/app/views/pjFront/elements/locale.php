<?php if (!isset($_GET['hide']) || (int) $_GET['hide'] === 0) : ?>
<div class="btn-group stivaLanguage">
	<button type="button" class="btn btn-default dropdown-toggle stivaBtnNav" data-toggle="dropdown" aria-expanded="false">
	<?php
	if (isset($tpl['locale_arr']) && is_array($tpl['locale_arr']) && !empty($tpl['locale_arr']))
	{
		$locale_id = $controller->getLocaleId();
		foreach ($tpl['locale_arr'] as $locale)
		{
			if ($locale_id == $locale['id'])
			{
				echo pjSanitize::html($locale['title']);
				break;
			}
		}
	}
	?> <span class="caret"></span>
	</button>
	<?php
	if (isset($tpl['locale_arr']) && is_array($tpl['locale_arr']) && !empty($tpl['locale_arr']))
	{
		?>
		<ul class="dropdown-menu" role="menu">
		<?php
		foreach ($tpl['locale_arr'] as $locale)
		{
			?><li><a href="#" class="hbSelectorLocale<?php echo $locale_id == $locale['id'] ? ' stivaBtnActive' : NULL; ?>" data-id="<?php echo $locale['id']; ?>"><?php echo pjSanitize::html($locale['title']); ?></a></li><?php
		}
		?>
		</ul>
		<?php
	}
	?>
</div>
<?php endif; ?>