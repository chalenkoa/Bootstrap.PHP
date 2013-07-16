<?php
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\Nav;
use BootstrapPHP\HeaderNavItem;
use BootstrapPHP\NavItem;


if (false) {class view_nav{}};

/** @var \BootstrapPHP\Nav $nav */

$_nav = clone $nav;
?>
<ul
	<?= Html::getId($_nav->attributes); ?>
	class="
		nav
		nav-list
		<?= Html::getClasses($_nav->attributes); ?>
	"
	<?= Html::getData($_nav->attributes); ?>
>
<?php
	/** @var NavItem $item */
	foreach($_nav->getItems() as $item):

		$_attributes = $item->getAttributes();
?>
		<li
			<?= ( $_attributes ? Html::getId($_attributes) : '' ); ?>
			class ="
				<?= ( $item->getActive()				? 'active'		: '' ); ?>
				<?= ( $item->getDisabled()				? 'disabled'	: '' ); ?>
				<?= ( $item instanceof HeaderNavItem 	? 'nav-header'	: '' ); ?>
				<?= ( $_attributes ? Html::getClasses($_attributes) : '' ); ?>
			"
			<?= ( $_attributes ? Html::getData($_attributes) : '' ); ?>
		>
<?php

			if ($item instanceof HeaderNavItem):

				echo $item->getText();

			else:

				if ($item->getText() === $_nav::DIVIDER):

					echo '<li class="divider"></li>';

				else:
?>
					<a href="<?= $item->getUrl(); ?>">
<?php
						if ($item->getIcon())
						{
							echo Html::getIcon($item->getIcon()).' ';
						}

						echo $item->getText();

						if ($item->getSubNav())
						{
							echo $item->getSubNav();
						}
?>
					</a>
<?php
				endif;
			endif;
?>
		</li>
<?php
	endforeach;
?>
</ul>
