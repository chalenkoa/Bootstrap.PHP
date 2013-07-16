<?php
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\Button;

if (false) {class view_button_group{}};

/** @var \BootstrapPHP\ButtonGroup $button_group */

$_button_group = clone $button_group;
?>
<div
	<?= Html::getId($_button_group->attributes); ?>
	class="
		btn-group
		<?= $_button_group->getDirection(); ?>
		<?= $_button_group->getAlign(); ?>
		<?= $_button_group->getDrop(); ?>
		<?= Html::getClasses($_button_group->attributes); ?>
	"
	<?= ( ($_button_group->getTypeToggle()) ? ' data-toggle="'.$_button_group->getTypeToggle().'"': '' ); ?>
	<?= Html::getData($_button_group->attributes); ?>
>
<?php
	/** @var $button Button */
	foreach((array) $_button_group->getItems() as $button)
	{
		$_button = clone $button;

		if ($_button_group->getTypeToggle())
		{
			$_button
				->setTag(Button::TAG_BUTTON)
				->setUrl('');
		}

		echo (string) $_button;
	}

	echo (string) $_button_group->getDropdownMenu();
?>
</div>