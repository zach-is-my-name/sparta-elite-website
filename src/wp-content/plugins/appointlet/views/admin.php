<p class="appointlet-user">
	<label for="<?=$this->get_field_id('user')?>">Appointlet ID:</label>
	<input type="text" name="<?=$this->get_field_name('user')?>" id="appointlet-user-<?=$this->get_field_id('user')?>" value="<?=$user?>">
</p>

<p><label>Button Color:</label></p>

<?php foreach ($this->get_buttons() as $button_name => $button_src): ?>
<p class="appointlet-button">
	<input
		type="radio"
		name="<?=$this->get_field_name('button')?>"
		id="<?=$this->get_field_id('button')?>-<?=$button_name?>"
		value="<?=$button_src?>"

		<?php if ($button_src == $button): ?>
		checked="checked"
		<?php endif; ?>
	>

	<label for="<?=$this->get_field_id('button')?>-<?=$button_name?>">
		<img src="<?=$button_src?>" alt="<?=$button_name?>">
	</label>
</p>
<?php endforeach; ?>

<p class="appointlet-button">
	<input
		type="radio"
		name="<?=$this->get_field_name('button')?>"
		id="<?=$this->get_field_id('button')?>-custom"

		<?php if (!strstr($button, 'appointlet.s3.amazonaws.com')): ?>
		checked="checked"
		<?php endif; ?>
	>

	<label for="<?=$this->get_field_id('button')?>-custom">
		<input
			class="appointlet-button-custom"
			type="text"
			name="appointlet_button_custom"
			placeholder="URL for custom button"
			value="<?php if (!strstr($button, 'appointlet.s3.amazonaws.com')): ?><?=$button?><?php endif; ?>"
		>
	</label>
</p>