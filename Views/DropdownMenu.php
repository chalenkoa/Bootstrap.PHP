<?php
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\Helpers\View;
use BootstrapPHP\DropdownMenu;

if (false) {class view_dropdown_menu{}};

/** @var \BootstrapPHP\DropdownMenu $dropdown_menu */

$_dropdown_menu = clone $dropdown_menu;
?>
<ul
	<?= Html::getId($_dropdown_menu->attributes); ?>
	class="
		dropdown-menu
		<?= ( ($_dropdown_menu->getAlign() === DropdownMenu::ALIGN_RIGHT) ? 'pull-right' : '' );  ?>
		<?= Html::getClasses($_dropdown_menu->attributes) ?>
	"
	<?= Html::getData($_dropdown_menu->attributes); ?>
	<?= (
		( get_class($_dropdown_menu) === get_class(new DropdownMenu()) )
		? 'role="menu" aria-labelledby="dropdownMenu"'
		: ''
	) ?>

>
<?php
	foreach($_dropdown_menu->getItems() as $item):

		$disabled 	= ( $item->isDisabled()	? 'disabled' : '' );
		$icon 		=
		(
			( $item->getIcon() )
			? Html::getIcon($item->getIcon(), $item->isDisabled()).'&nbsp;'
			: '<i class="i"></i>'
		);
		$text		= $item->getText();

		$attributes = $item->getAttributes();
		$id 		= '';
		$classes	= '';
		$data 		= '';
		if ($attributes)
		{
			$id 		= Html::getId($attributes);
			$classes	= Html::getClasses($attributes);
			$data 		= Html::getData($attributes);
		}

		if ($item instanceof BootstrapPHP\LinkDropdownMenuItem):

			/** @var BootstrapPHP\LinkDropdownMenuItem $item */
			if ($item->getText() === BootstrapPHP\DropdownMenu::DIVIDER):
?>
				<li class="divider"></li>
<?php
			else:
?>
				<li class="<?= $disabled; ?>">
					<a
						tabindex="-1"
						<?= ( $item->getUrl() ? 'href="'.$item->getUrl().'"' : '' );  ?>
						<?= $id; ?>
						class="<?= $classes; ?>"
						<?= $data; ?>
					>
						<?= $icon ?> <?= $text ?>
					</a>
				</li>
<?php
			endif;

		elseif ($item instanceof BootstrapPHP\SubmenuDropdownMenuItem):

			/** @var BootstrapPHP\SubmenuDropdownMenuItem $item */
?>
			<li class="<?= ( $disabled ? $disabled : ' dropdown-submenu' ); ?>">
				<a
					tabindex="-1"
					href="#"
					<?= $id; ?>
					class="<?= $classes; ?>"
					<?= $data; ?>
				>
					<?= $icon ?> <?= $text ?>
				</a>
				<?= $item->getDropdownSubmenu(); ?>
			</li>
<?php
		elseif ($item instanceof BootstrapPHP\HeaderDropdownMenuItem):

			/** @var BootstrapPHP\HeaderDropdownMenuItem $item */
?>
			<li class="nav-header">
				<?= $item->getText(); ?>
			</li>
<?php
		endif;

	endforeach;
?>
</ul>