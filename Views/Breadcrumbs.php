<?php
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\Helpers\View;

if (false) {class view_breadcrumbs{}};

/** @var \BootstrapPHP\Breadcrumbs $breadcrumbs */

$_breadcrumbs = clone $breadcrumbs;

if ($_breadcrumbs->getItems()):
?>
	<ul
		<?= Html::getId($_breadcrumbs->attributes); ?>
		class="breadcrumb <?= Html::getClasses($_breadcrumbs->attributes) ?>"
		<?= Html::getData($_breadcrumbs->attributes); ?>
	>
<?php
		$_counter = 0;
		foreach($_breadcrumbs->getItems() as $_breadcrumb):

			$_counter ++;
			list( $_text, $_url, $_attributes) = $_breadcrumb;
?>
			<li
				<?= ( $_attributes ? Html::getId($_attributes) : '' ); ?>
				class="
					<?= ( ($_url == false) ? 'active' : '' ); ?>
					<?= ( $_attributes ? Html::getClasses($_attributes) : '' ); ?>
				"
				<?= ( $_attributes ? Html::getData($_attributes) : '' ); ?>
			>
<?php
				if ($_url):
?>
					<a href="<?= $_url; ?>"><?= $_text ?></a>
<?php
				else:
?>
					<?= $_text ?>
<?php
				endif;

				if ($_counter < count($_breadcrumbs->getItems())):
?>
					<span class="divider">/</span>
<?php
				endif;
?>
			</li>
<?php
		endforeach;
?>
	</ul>
<?php
endif;