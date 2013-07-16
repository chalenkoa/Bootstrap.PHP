<?php
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Helpers\Html;

if (false) {class view_alert{}};

/** @var \BootstrapPHP\Alert $alert */

$_alert = clone $alert;
?>
<div
	<?= Html::getId($_alert->attributes); ?>
	class="
		alert
		<?= $_alert->getType(); ?>
		<?= ( $_alert->getBlock() ? 'alert-block ' : '' ); ?>
		<?= Html::getClasses($_alert->attributes)?>
	"
	<?= Html::getData($_alert->attributes); ?>
>
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<?= $_alert->getText(); ?>
</div>