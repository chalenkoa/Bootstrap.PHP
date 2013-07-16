<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;

/**
 * Класс конструктор навигационных вкладок Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#navs
 * @see http://bootstrap-ru.com/components.php#navs
 */
abstract class TabsBuilder extends Base\NavTabsBase
{
	const NAME = 'tabs';

	const DIRECTION_BELOW	= 'tabs-below';
	const DIRECTION_LEFT 	= 'tabs-left';
	const DIRECTION_RIGHT 	= 'tabs-right';
	const DIRECTION_DEFAULT	= '';

	protected $_direction = self::DIRECTION_DEFAULT;


	/**
	 * Задание положение вкладок относительно контента
	 * @param $direction положение вкладок, используй константы этого класса DIRECTION_
	 * @return TabsBuilder
	 */
	public function setDirection($direction)
	{
		$this->_direction = $direction;

		return $this;
	}
}


class Tabs extends TabsBuilder
{
	/**
	 * Создание объекта вкладок
	 * @return TabsBuilder
	 */
	public static function create()
	{
		$class = __CLASS__;
		return new $class();
	}


	public function getDirection()
	{
		return $this->_direction;
	}
}