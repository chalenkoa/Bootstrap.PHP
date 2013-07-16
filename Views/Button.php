<?php
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Button;

if (false) {class view_button{}};

/** @var \BootstrapPHP\Button $button */

$_button = clone $button;

$icon_white =
(
	( $_button->getType() === Button::TYPE_DEFAULT || $_button->getType() === Button::TYPE_LINK )
	? false
	: true
);
$_icon = ( ($_button->getIcon()) ? Html::getIcon($_button->getIcon(), $icon_white).'&nbsp;' : '' );
$_text = $_button->getText();

// Формирование строки атрибутов кнопки
$_attribute = "
	".Html::getId($_button->attributes)."
	class='
		btn
		{$_button->getType()}
		{$_button->getSize()}
		{$_button->getWidth()}
		".( ($_button->isEnable() === false) ? 'disabled' : '' )."
		".Html::getClasses($_button->attributes)."
	'
	".( ( ($_button->isEnable() === false) && ($_button->getTag() === $_button::TAG_BUTTON) ) ? 'disabled' : '' )."
	".( ( $_button->getToggle() ) ? 'data-toggle="button"' : '' )."
	".(
			( $_button->getTextLoading() )
			? 'data-loading-text="'.htmlspecialchars($_button->getTextLoading(), \ENT_QUOTES).'"'
			: ''
	).' '.
	Html::getData($_button->attributes);

// Оборачиваем текст кнопки в выбранный тэг
switch ($_button->getTag())
{
	case $_button::TAG_BUTTON:
		$_buffer =
			'<button type="submit" '.$_attribute.'>'.
				$_icon.$_text.
			'</button>';
		break;

	case $_button::TAG_A:
		$_buffer =
			'<a '.( ($_button->getUrl()) ? 'href="'.$_button->getUrl().'" ' : '' ).$_attribute.'>'.
				$_icon.$_text.
			'</a>';
		break;

	case $_button::TAG_INPUT:
		$_buffer = '<input type="submit" value="'.$_text.'" '.$_attribute.'></input>';
		break;
}

// Если нужно оборачиваем кнопку в тэг формы
if (
		( $_button->getUrl() )
	and ( ($_button->getTag() === $_button::TAG_BUTTON) or ($_button->getTag() === $_button::TAG_INPUT) )
)
{
	$_buffer =
		'<form action="'.$_button->getUrl().'" method="get">'.
			$_buffer.
		'</form>';
}

echo $_buffer;