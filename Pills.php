<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;

/**
 * Класс конструктор навигационных кнопок Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#navs
 * @see http://bootstrap-ru.com/components.php#navs
 */
abstract class PillsBuilder extends Base\NavTabsBase
{
	const NAME = 'pills';
}


class Pills extends PillsBuilder
{
	/**
	 * Создание объекта навигационных кнопок
	 * @return PillsBuilder
	 */
	public static function create()
	{
		$class = __CLASS__;
		return new $class();
	}
}