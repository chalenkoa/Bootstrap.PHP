<?php
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Button;
use BootstrapPHP\ButtonGroup;
use BootstrapPHP\DropdownMenu;

if (false) {class view_button_dropdown{}};

/** @var \BootstrapPHP\Button $button */

$_button = clone $button;

// Получение и удалени из кнопки выпадающего меню во избежании зацикливания
$dropdown_menu = $_button->getDropdownMenu();
$_button->resetDropdownMenu();

$_dropdown_menu = clone $dropdown_menu;

$button_group = ButtonGroup::create();

// Копирование атрибутов кнопки группе кнопок, после чего сброс атрибутов кнопки
if ($_button->attributes->getId())
{
	$button_group->attributes->setId( 	$_button->attributes->getId() );
}
if ($_button->attributes->getClasses())
{
	$button_group->attributes->addClass($_button->attributes->getClasses() );
}
if ($_button->attributes->getData())
{
	$button_group->attributes->addData(	$_button->attributes->getData() );
};
$_button->attributes->reset();

// Переключаемся на тег ссылка если задана ссылка
if ($_button->getUrl() and $_button->getTag() !== $_button::TAG_A)
{
	$_button->setTag($_button::TAG_A);
}

// Если кнопка вызова выпадающего меню отделная ...
if ($_button->getDropdownMenuSplitButton())
{
	// ... тогда создаем ее и наследование свойств родительской кнопки
	$button_caret = Button::create('')
		->setSize($_button->getSize())
		->setType($_button->getType())
		->setEnable($_button->isEnable());

	$_button->setWidth($_button::WIDTH_DEFAULT);

} else
{
	// ... иначе исполуем существующую
	$button_caret = clone $_button;
}

/** @var Button $button_caret */
$button_caret
	->setText($button_caret->getText().' <span class="caret"></span>')
	->attributes->addData('toggle', 'dropdown')
	->attributes->addClass('dropdown-toggle');

if ($_button->getDropdownMenuAlignRight())
{
	$_dropdown_menu->setAlign(DropdownMenu::ALIGN_RIGHT);
}

/** @var ButtonGroup $button_group */
if ($_button->getDropdownMenuDropUp())
{
	$button_group->setDrop(ButtonGroup::DROP_UP);
}

if ($_button->getDropdownMenuSplitButton())
{
	$button_group->addButton($_button);
}

$button_group
	->addDropdownMenu($_dropdown_menu)
	->addButton($button_caret);

echo $button_group;