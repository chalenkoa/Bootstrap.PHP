<?php
namespace BootstrapPHP;

use BootstrapPHP\Base\NavItemBase;
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Base\Attributes;

/**
 * Класс конструктор навигации Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#navs
 * @see http://bootstrap-ru.com/components.php#navs
 */
abstract class NavBuilder extends Base\NavBase
{
	const NAME 		= 'list';
	const DIVIDER 	= '---';


	/**
	 * Добавление ссылки в навигацию
	 * @param string $text текст ссылки
	 * @param string $url
	 * @param string|IconBuilder|bool $icon иконка, используй константы класса Icon или объект Icon
	 * @param bool $disabled true блокирует ссылку
	 * @param bool $active true делает ссылку активной
	 * @param Attributes $attributes
	 * @return NavBuilder
	 */
	public function addItem(
		$text, $url, $icon = false, $disabled = false, $active = false, Attributes $attributes = null
	)
	{
		$item = new NavItem($text, $url, $disabled, $active, $attributes);
		if ($icon)
		{
			$item->setIcon($icon);
		}

		$this->_pushItem($item);

		return $this;
	}


	/**
	 * Дабавление поднавигации
	 * @param Nav|NavBuilder $nav
	 * @return NavBuilder
	 */
	public function addSubNav(Nav $nav)
	{
		/** @var NavItem $last_item  */
		$last_item = array_pop($this->_items);

		$last_item->addSubNav($nav);

		$this->_pushItem($last_item);

		return $this;
	}


	/**
	 * Добавление подзаголовка
	 * @param $text текст подзаголовка
	 * @return NavBuilder
	 */
	public function addHeader($text)
	{
		$this->_pushItem(new HeaderNavItem($text));

		return $this;
	}


	/**
	 * Добавление разделителя
	 * @return NavBuilder
	 */
	public function addDivider()
	{
		$this->addItem(self::DIVIDER, '');

		return $this;
	}


	function __toString()
	{
		/** @var \view_nav */
		return View::render('Nav', array('nav' => $this));
	}
}


class Nav extends NavBuilder
{
	/**
	 * Создание объекта навигации
	 * @return NavBuilder
	 */
	public static function create()
	{
		$class = __CLASS__;
		return new $class();
	}
}

class NavItem extends NavItemBase
{
	private $_sub_nav;
	private $_icon;


	public function addSubNav($nav)
	{
		$this->_sub_nav = $nav;
	}

	public function setIcon($icon)
	{
		$this->_icon = $icon;
	}


	public function getSubNav()
	{
		return $this->_sub_nav;
	}

	public function getIcon()
	{
		return $this->_icon;
	}
}


class HeaderNavItem extends NavItemBase {}