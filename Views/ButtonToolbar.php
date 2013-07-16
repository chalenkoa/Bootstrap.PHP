<?php
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\ButtonGroup;

if (false) {class view_button_toolbar{}};

/** @var \BootstrapPHP\ButtonToolbar $button_toolbar */

$_button_toolbar = clone $button_toolbar;
?>
<div
	<?= Html::getId($_button_toolbar->attributes); ?>
	class="
		btn-toolbar
		<?= Html::getClasses($_button_toolbar->attributes); ?>
	"
	<?= Html::getData($_button_toolbar->attributes); ?>
>
<?php
	/** @var ButtonGroup $button_group */
	foreach((array) $_button_toolbar->getItems() as $button_group)
	{
		echo (string) $button_group;
	}
?>
</div>