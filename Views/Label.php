<?php
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\Label;
use BootstrapPHP\Badge;

if (false) {class view_label{}};

/** @var Label|Badge $label */

$_label = clone $label;
?>
<span
	<?= Html::getId($_label->attributes); ?>
	class="
		<?= $_label::NAME; ?>
		<?= ( $_label->getType() ? $_label::NAME.'-'.$_label->getType() : '' ); ?>
		<?= Html::getClasses($_label->attributes); ?>
	"
	<?= Html::getData($_label->attributes); ?>
>
	<?= $_label->getText();	?>
</span>