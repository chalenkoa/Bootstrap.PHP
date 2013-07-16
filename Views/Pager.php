<?php
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Pager;
use BootstrapPHP\PagerItem;;

if (false) {class view_pager{}};

/** @var \BootstrapPHP\Pager $pager */

$_pager = clone $pager;

if (count( (array) $_pager->getItems()) === 0) return;
?>
<ul
	<?= Html::getId($_pager->attributes); ?>
	class="pager <?= Html::getClasses($_pager->attributes) ?>"
	<?= Html::getData($_pager->attributes); ?>
>
<?php
	/** @var PagerItem $_pager_item */
	foreach((array) $_pager->getItems() as $_type => $_pager_item):

		$_attributes = $_pager_item->attributes;
?>
		<li
			<?= ( $_attributes ? Html::getId($_attributes) : '' ); ?>
			class="
				<?= ( ($_type === PagerItem::TYPE_PREVIOUS) 	? 'previous' : '' ); ?>
				<?= ( ($_type === PagerItem::TYPE_NEXT) 		? 'next' 	 : '' ); ?>
				<?= ( ($_pager_item->disabled) 					? 'disabled' : '' ); ?>
				<?= ( $_attributes ? Html::getClasses($_attributes) : '' ); ?>
			"
			<?= ( $_attributes ? Html::getData($_attributes) : '' ); ?>
		>
			<a href="<?= $_pager_item->url; ?>">
				<?=
				(
					( $_type === PagerItem::TYPE_PREVIOUS )
					? (
						( $_pager->getArrow(Pager::ARROW_LEFT) )
						? $_pager->getArrow(Pager::ARROW_LEFT)
						: '&larr;'
					)
					: ''
				); ?>
				<?= $_pager_item->text; ?>
				<?=
				(
					( $_type === PagerItem::TYPE_NEXT )
					? (
						( $_pager->getArrow(Pager::ARROW_RIGHT) )
						? $_pager->getArrow(Pager::ARROW_RIGHT)
						: '&rarr;'
					)
					: ''
				); ?>
			</a>
		</li>
<?php
	endforeach;
?>
</ul>