<?php
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\PaginationItem;

if (false) {class view_pagination{}};

/** @var \BootstrapPHP\Pagination $pagination */

$_pagination = clone $pagination;

if ( count( (array) $_pagination->getItems()) === 0 ) return;
?>
<div
	<?= Html::getId($_pagination->attributes); ?>
	class="
		pagination
		<?= $_pagination->getSize(); ?>
		<?= $_pagination->getAlign(); ?>
		<?= Html::getClasses($_pagination->attributes); ?>
	"
	<?= Html::getData($_pagination->attributes); ?>
>
	<ul>
<?php
		/**	@var PaginationItem $item */
		foreach( (array) $_pagination->getItems() as $item):

			$_attributes = $item->attributes;
?>
			<li
				<?= ( $_attributes ? Html::getId($_attributes) : '' ); ?>
				class="
					<?= ( ($item->active) 	? 'active'	 : '' ); ?>
					<?= ( ($item->disabled)	? 'disabled' : '' ); ?>
					<?= ( $_attributes ? Html::getClasses($_attributes) : '' ); ?>
				"
				<?= ( $_attributes ? Html::getData($_attributes) : '' ); ?>
			>
				<a href="<?= $item->url; ?>">
					<?= $item->text; ?>
				</a>
			</li>
<?php
		endforeach;
?>
	</ul>
</div>