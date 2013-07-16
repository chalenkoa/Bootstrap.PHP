<?php
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\Tabs;
use BootstrapPHP\Pills;
use BootstrapPHP\Base\NavItemBase;
use BootstrapPHP\Base\DropdownNavItem;
use BootstrapPHP\Base\ContentNavItem;

if (false) {class view_tabs{}};

/** @var Tabs|Pills $tabs */

$_tabs = clone $tabs;

if ($_tabs->getContented())
{
	$tab_content = '<div class="tab-content">';

	/**	@var ContentNavItem $item */
	foreach((array) $_tabs->getContentItems() as $item)
	{
		$tab_content .= '
			<div
				id="'.$item->getId().'"
				class="
					tab-pane
					'.( $item->getActive() 							? 'active'	: '' ).'
					'.( $_tabs->getFaded() 							? 'fade' 	: '' ).'
					'.( ($item->getActive() && $_tabs->getFaded())	? 'in' 		: '' ).'
				"
			>
				<p>'.$item->getContent().'</p>
			</div>
		';
	}
	$tab_content .= '</div>';
}

if ($_tabs->getContented())
{
	echo '<div class="tabbable '.( $_tabs instanceof Tabs ? $_tabs->getDirection() : '' ).'">';
	if (
			($_tabs instanceof Tabs)
		&&	($_tabs->getDirection() === $_tabs::DIRECTION_BELOW)
	) {
		echo $tab_content;

		$tab_content = ''; 	// удалением содержания мы избавляемся от повторной проверки,
							// просто вставим в места, где нажно вывести, если не здесь
	}
}
?>
	<ul
		<?= Html::getId($_tabs->attributes); ?>
		class="
			nav
			nav-<?= $_tabs::NAME ?>
			<?= ( $_tabs->getStacked() ? 'nav-stacked' : '' ); ?>
			<?= Html::getClasses($_tabs->attributes); ?>
		"
		<?= Html::getData($_tabs->attributes); ?>
	>
<?php
		/**	@var \BootstrapPHP\Base\NavItemBase $item */
		foreach($_tabs->getItems() as $item):

			$_attributes = $item->getAttributes();
			$id 	 = ( $_attributes ? Html::getId($_attributes) 		: '' );
			$classes = ( $_attributes ? Html::getClasses($_attributes) 	: '' );
			$data 	 = ( $_attributes ? Html::getData($_attributes) 	: '' );
?>
			<li
				class ="
					<?= ( $item->getActive()				? 'active'		: '' ); ?>
					<?= ( $item->getDisabled()				? 'disabled'	: '' ); ?>
					<?= ( $item instanceof DropdownNavItem 	? 'dropdown'	: '' ); ?>
				"
			>
<?php
				if ($item instanceof DropdownNavItem):
?>
					<?php /** @var DropdownNavItem $item */ ?>
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
<?php
					echo $item->getDropdownMenu();

				elseif ($item instanceof ContentNavItem):
?>
					<?php /** @var ContentNavItem $item */ ?>
					<a
						<?= $id; ?>
						href="#<?= $item->getId(); ?>"
						<?= ( $classes ? 'class="'.$classes.'"' : '' ); ?>
						data-toggle="tab"
						<?= $data; ?>
					>
						<?= $item->getText(); ?>
					</a>
<?php
				else:
?>
					<?php /** @var NavItemBase $item */ ?>
					<a
						<?= $id; ?>
						href="<?= $item->getUrl(); ?>"
						<?= ( $classes ? 'class="'.$classes.'"' : '' ); ?>
						<?= $data; ?>
					>
						<?= $item->getText(); ?>
					</a>
<?php
				endif;
?>
			</li>
<?php
		endforeach;
?>
	</ul>
<?php
echo $tab_content;

if ($_tabs->getContented()) echo '</div>';