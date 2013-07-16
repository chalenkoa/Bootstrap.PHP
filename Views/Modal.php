<?php
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Helpers\Html;

if (false) {class view_modal{}};

/** @var \BootstrapPHP\Modal $modal */

$_modal = clone $modal;
?>
<div
	<?= Html::getId($_modal->attributes); ?>
	class="
		modal
		hide
		<?= ( $_modal->getFaded() ? 'fade' : '' ); ?>
		<?= Html::getClasses($_modal->attributes)?>
	"
	tabindex="-1"
	role="dialog"
	aria-hidden="true"
	<?= ( $_modal->getBackdrop() ? 'data-backdrop="'.$_modal->getBackdrop().'"'	: '' ); ?>
	<?= ( $_modal->getBodyUrl()	 ? 'data-remote="'.$_modal->getBodyUrl().'"' 	: '' ); ?>
 	data-keyboard="<?= ( $_modal->getKeyboard() ? 'true' : 'false' ); ?>"
	<?= Html::getData($_modal->attributes); ?>
>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?= $_modal->getHeader(); ?></h3>
	</div>
	<div class="modal-body">
		<?= $_modal->getBody(); ?>
	</div>
<?php
	$footer = $_modal->getFooter();
	if ($footer):
?>
		<div class="modal-footer">
			<?= $footer; ?>
		</div>
<?php
	endif;
?>
</div>