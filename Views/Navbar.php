<?php
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\NavbarItemBase;
use BootstrapPHP\LinkNavbarItem;
use BootstrapPHP\TextNavbarItem;
use BootstrapPHP\DropdownNavbarItem;
use BootstrapPHP\FormNavbarItem;

if (false) {class view_navbar{}};

/** @var \BootstrapPHP\Navbar $navbar */

$_navbar = clone $navbar;
?>
<div
	<?= Html::getId($_navbar->attributes); ?>
	class="
		navbar
		<?= $_navbar->getPosition(); ?>
		<?= ( $_navbar->getInverse() ? 'navbar-inverse' : '' ); ?>
		<?= Html::getClasses($_navbar->attributes)?>
	"
	<?= Html::getData($_navbar->attributes); ?>
>
	<div class="navbar-inner">
<?php
		if ($_navbar->getCollapsible()):
?>
			<div class="container">

				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
<?php
		endif;

		list($brand_name, $brand_url) = $_navbar->getBrand();
		if ($brand_name):
?>
			<a class="brand" href="<?= $brand_url; ?>">
				<?= $brand_name; ?>
			</a>

<?php
		endif;

		if ($_navbar->getCollapsible()) echo '<div class="nav-collapse">';

		/** @var NavbarItemBase $item */
		foreach((array) $_navbar->getItems() as $item):

			$close_ul = false;
			$open_ul  = false;
			if ($item instanceof FormNavbarItem)
			{
				if ($ul !== '')
				{
					$close_ul = true;
					$ul 	  = '';
				}

			} else
			{
				if ($ul === '')
				{
					$open_ul  = true;

				} elseif ($ul !== $item->getRight())
				{
					$close_ul = true;
					$open_ul  = true;
				}

				$ul = $item->getRight();
			}
			if ($close_ul) echo '</ul>';
			if ($open_ul)  echo '<ul class="nav '.( $item->getRight() ? 'pull-right' : '' ).'">';

			$id 		= '';
			$classes	= '';
			$data 		= '';
			if ($item->getAttributes())
			{
				$attributes = $item->getAttributes();

				$id 		= Html::getId($attributes);
				$classes	= Html::getClasses($attributes);
				$data 		= Html::getData($attributes);
			}

			if ($item instanceof LinkNavbarItem):
?>
				<?php /** @var LinkNavbarItem $item */ ?>
				<li class="<?= ( $item->getActive() ? 'active' : '' ); ?>">
					<a
						<?= $id; ?>
						href="<?= $item->getUrl(); ?> <?= $classes; ?>"
						<?= $data; ?>
					>
						<?= $item->getText(); ?>
					</a>
				</li>
<?php
			elseif ($item instanceof TextNavbarItem):
?>
				<?php /** @var TextNavbarItem $item */ ?>
<?php
				if ($item->getText() === $_navbar::DIVIDER):
?>
					<li class="divider-vertical"></li>
<?php
				else:
?>
					<li
						<?= $id; ?>
						class="navbar-text <?= $classes; ?>"
						<?= $data; ?>
					>
						<?= $item->getText(); ?>
					</li>
<?php
				endif;

			elseif ($item instanceof DropdownNavbarItem):
?>
				<?php /** @var DropdownNavbarItem $item */ ?>
				<li class="dropdown">
					<a
						<?= $id; ?>
						href="#"
						class="dropdown-toggle <?= $classes; ?>"
						data-toggle="dropdown"
						<?= $data; ?>
					>
						<?= $item->getText(); ?>
						<b class="caret"></b>
					</a>
					<?= $item->getDropdownMenu(); ?>
				</li>

<?php
			elseif ($item instanceof FormNavbarItem):
?>
				<?php /** @var FormNavbarItem $item */ ?>
				<?= $item->getForm(); ?>

<?php
			endif;

		endforeach;
		if ($ul !== '') echo '</ul>';

		if ($_navbar->getCollapsible()) echo '</div>';
		if ($_navbar->getCollapsible()) echo '</div>';
?>
	</div>
</div>