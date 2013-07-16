<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;
use BootstrapPHP\Base\Attributes;

/**
 * Класс конструктор навигационой панели Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#navbar
 * @see http://bootstrap-ru.com/components.php#navbar
 */
abstract class NavbarBuilder extends Base\Base
{
	/** Фиксорованое расположение вверху страницы, остается виден всегда */
	const POSITION_FIXED_TOP 	= 'navbar-fixed-top';
	/** Фиксорованое расположение внизу страницы, остается виден всегда */
	const POSITION_FIXED_BOTTOM	= 'navbar-fixed-bottom';
	/** Статическое расположение вверху страницы, виден только когда вы вверху страницы */
	const POSITION_STATIC_TOP	= 'navbar-static-top';
	/** Расположен там где вставлен */
	const POSITION_DEFAULT		= '';

	CONST DIVIDER 				= '|';

	protected $_inverse;
	protected $_position;
	protected $_brand;
	protected $_collapsible;

	/** @var NavbarItemBase[] */
	protected $_items;


	/**
	 * Делает панель темной
	 * @return NavbarBuilder
	 */
	public function makeInverse()
	{
		$this->_inverse = true;

		return $this;
	}


	/**
	 * Делает панель схлопывающейся в одну кнопку при маленькой ширине окна
	 * @return NavbarBuilder
	 */
	public function makeCollapsible()
	{
		$this->_collapsible = true;

		return $this;
	}


	/**
	 * Позиционируем окно
	 * @param $position задание позици окна, используй константы этого класса POSITION_
	 * @return NavbarBuilder
	 */
	public function setPosition($position)
	{
		$this->_position = $position;

		return $this;
	}


	/**
	 * Добавляем название сайта на панель
	 * @param string $name название сайта
	 * @param string $url url главной страницы
	 * @return NavbarBuilder
	 */
	public function setBrand($name, $url)
	{
		$this->_brand = array($name, $url);

		return $this;
	}


	/**
	 * Добавление текстового элемента
	 * @param string $text текст
	 * @param bool $right true выравнивает элемент справа, правее будут те кто получил этот параметр раньше
	 * @param Attributes $attributes
	 * @return NavbarBuilder
	 */
	public function addTextItem($text, $right = false, Attributes $attributes = null)
	{
		$this->_addItem(new TextNavbarItem($text, $right, $attributes));

		return $this;
	}


	/**
	 * Добавление ссылки
	 * @param string $text текст ссылки
	 * @param string $url
	 * @param bool $active true делает ссылку текущей выбранной
	 * @param bool $right true выравнивает элемент справа, правее будут те кто получил этот параметр раньше
	 * @param Attributes $attributes
	 * @return NavbarBuilder
	 */
	public function addLinkItem($text, $url = '#', $right = false, $active = false, Attributes $attributes = null)
	{
		$this->_addItem(new LinkNavbarItem($text, $url, $right, $active, $attributes));

		return $this;
	}


	/**
	 * Добавление выпадающего списка
	 * @param $text тект по клику на который будет выпадать меню
	 * @param DropdownMenu|DropdownMenuBuilder $dropdown_menu
	 * @param bool $right true выравнивает элемент справа, правее будут те кто получил этот параметр раньше
	 * @param Attributes $attributes
	 * @return NavbarBuilder
	 */
	public function addDropdownItem($text, DropdownMenu $dropdown_menu, $right = false, Attributes $attributes = null)
	{
		$this->_addItem(new DropdownNavbarItem($text, $dropdown_menu, $right, $attributes));

		return $this;
	}


	/**
	 * Добавление формы
	 * @param string $form html формы
	 * @return NavbarBuilder
	 */
	public function addFormItem($form)
	{
		$this->_addItem(new FormNavbarItem($form));

		return $this;
	}


	/**
	 * Добавление разделителя
	 * @param bool $right true выравнивает элемент справа, правее будут те кто получил этот параметр раньше
	 * @return NavbarBuilder
	 */
	public function addDivider($right = false)
	{
		$this->_addItem(new TextNavbarItem(self::DIVIDER, $right));

		return $this;
	}


	private function _addItem(NavbarItemBase $item)
	{
		$this->_items[] = $item;
	}


	function __toString()
	{
		/** @var \view_navbar */
		return View::render('Navbar', array('navbar' => $this));
	}
}


class Navbar extends NavbarBuilder
{
	/**
	 * Создание объекта навигационной панели
	 * @return NavbarBuilder
	 */
	public static function create()
	{
		$class = __CLASS__;
		return new $class();
	}


	public function getInverse()
	{
		return $this->_inverse;
	}

	public function getPosition()
	{
		return $this->_position;
	}

	public function getBrand()
	{
		return $this->_brand;
	}

	public function getItems()
	{
		return $this->_items;
	}

	public function getCollapsible()
	{
		return $this->_collapsible;
	}
}


abstract class NavbarItemBase
{
	private $_text;
	private $_right = false;
	private $_attributes;


	function __construct($text, $right, Attributes $attributes = null)
	{
		$this->_text  = $text;
		$this->_right = $right;
		$this->_attributes = $attributes;
	}


	public function getRight()
	{
		return $this->_right;
	}


	public function getText()
	{
		return $this->_text;
	}

	public function getAttributes()
	{
		return $this->_attributes;
	}
}


class TextNavbarItem extends NavbarItemBase
{
	function __construct($text, $right = false, Attributes $attributes = null)
	{
		parent::__construct($text, $right, $attributes);
	}
}


class LinkNavbarItem extends NavbarItemBase
{
	private $_url;
	private $_active;


	/**
	 * @param $text
	 * @param $url
	 * @param bool $right
	 * @param bool $active
	 * @param Attributes $attributes
	 */
	function __construct($text, $url, $right = false, $active = false, Attributes $attributes = null)
	{
		parent::__construct($text, $right, $attributes);

		$this->_url 	= $url;
		$this->_active 	= $active;
	}

	public function getUrl()
	{
		return $this->_url;
	}

	public function getActive()
	{
		return $this->_active;
	}
}


class DropdownNavbarItem extends NavbarItemBase
{
	private $_dropdown_menu;


	function __construct($text, DropdownMenu $dropdown_menu, $right = false, Attributes $attributes = null)
	{
		parent::__construct($text, $right, $attributes);

		$this->_dropdown_menu = $dropdown_menu;
	}


	public function getDropdownMenu()
	{
		return $this->_dropdown_menu;
	}
}


class FormNavbarItem extends NavbarItemBase
{
	private $_form;


	function __construct($form)
	{
		$this->_form = $form;
	}


	public function getForm()
	{
		return $this->_form;
	}
}