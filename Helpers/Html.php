<?php
namespace BootstrapPHP\Helpers;

use BootstrapPHP\Base\Attributes;
use BootstrapPHP\Icon;

class Html
{
	public static function getId(Attributes $obj)
	{
		return( $obj->getId() ? 'id="'.$obj->getId().'" ' : '' );
	}


	public static function getClasses(Attributes $obj)
	{
		return( $obj->getClasses() ? implode(' ', $obj->getClasses()) : '' );
	}


	public static function getData(Attributes $obj)
	{
		$data = '';
		foreach((array) $obj->getData() as $name => $value)
		{
			$data = $data.'data-'.$name.'="'.htmlspecialchars($value, \ENT_QUOTES, 'UTF-8').'" ';
		}

		return $data;
	}


	/**
	 * @param Icon|string $icon
	 * @param bool $white присвоит это значение цвету иконки, если иконка заданна в виде класса
	 * @return string
	 */
	public static function getIcon($icon, $white = false)
	{
		$icon =
		(
			( is_string($icon) )
			? Icon::create($icon, $white)
			: $icon
		);

		if ($icon instanceof Icon)
		{
			return (string) $icon;

		} else
		{
			trigger_error('Ожидалось, что иконка будет объектом.', E_USER_WARNING);
		}
	}
}