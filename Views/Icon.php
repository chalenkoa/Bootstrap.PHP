<?php
use BootstrapPHP\Helpers\Html;

if (false) {class view_icon{}};

/** @var \BootstrapPHP\Icon $icon */

$_icon = clone $icon;
?>
<i
	<?= Html::getId($_icon->attributes); ?>
	class="<?=
		$_icon->getType().' '.
		( $_icon->getWhite() ? 'icon-white ' : '' ).
		Html::getClasses($_icon->attributes)
	?>"
	<?= Html::getData($_icon->attributes); ?>
></i>