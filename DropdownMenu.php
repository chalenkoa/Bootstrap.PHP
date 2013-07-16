<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;
use BootstrapPHP\Base\Attributes;

/**
 * Класс конструктор выпадающего меню Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#dropdowns
 * @see http://bootstrap-ru.com/components.php#dropdowns
 */
abstract class DropdownMenuBuilder extends Base\Base
{
	const DIVIDER 		= '---';

	const ALIGN_RIGHT	= 'pull-right';
	const ALIGN_DEFAULT	= '';

	/** @var DropdownMenuItemBase[] */
	protected $_items;

	/** @var DropdownMenuItemBase[] */
	protected $_items_always_down;

	/** @var string выравнивание */
	protected $_align;


	function __construct()
	{
		parent::__construct();

		$this->_requiredJs(BootstrapPHP::JS_DROPDOWN);
	}


	/**
	 * Добавление ссылки
	 * @param string $text текст ссылки
	 * @param string|bool $url
	 * @param string|IconBuilder|bool $icon иконка, используй константы класса Icon TYPE_, или объект Icon
	 * @param bool $disable true блокирует ссылку
	 * @param bool $flag_always_down true приклеивает ссыклу вниз меню, если у нескольких элементов будет этот флаг,
	 * 								 ниже будет тат кто был добавлен позже
	 * @param Attributes $attributes
	 * @return $this
	 */
	public function addLink(
		$text, $url = false, $icon = false, $disable = false, $flag_always_down = false, Attributes $attributes = null
	)
	{
		$item = new LinkDropdownMenuItem($this, $text, $url, $attributes);

		if ($icon)
		{
			$item->setIcon($icon);
		}
		if ($disable)
		{
			$item->disabled();
		}

		$this->_addItem($item, $flag_always_down);

		return $this;
	}


	/**
	 * Добавление подзаголовка
	 * @param string $text текст подзаголовка
	 * @param bool $flag_always_down true приклеивает заголовок вниз меню
	 * @return $this
	 */
	public function addHeader($text, $flag_always_down = false)
	{
		$item = new HeaderDropdownMenuItem($text);

		$this->_addItem($item, $flag_always_down);

		return $this;
	}


	/**
	 * Добавление разделителя
	 * @param bool $flag_always_down true приклеивает разделитель вниз меню
	 * @return $this
	 */
	public function addDivider( $flag_always_down = false)
	{
		$this->addLink(self::DIVIDER, false, false, false, $flag_always_down);

		return $this;
	}


	/**
	 * Задание выравнивания выпадающего списка относительно родительского элемента
	 * @param string $align выравнивание, используй константы этого класса ALIGN_
	 * @return $this
	 */
	public function setAlign($align = self::ALIGN_DEFAULT)
	{
		$this->_align = $align;

		return $this;
	}


	/**
	 * Указываем на то что дальше в цепочке вызовов будут элементы подменю
	 * @param $text текст элемента списка, при наведении на который будет показываться подменю
	 * @param bool $flag_always_down true приклеивает подменю вниз меню
	 * @param Attributes $attributes
	 * @return DropdownSubmenu
	 */
	public function startSubmenu($text, $flag_always_down = false, Attributes $attributes = null)
	{
		$dropdown_submenu = new DropdownSubmenu($this);

		$this->_addItem(new SubmenuDropdownMenuItem($text, $dropdown_submenu, $attributes), $flag_always_down);

		return $dropdown_submenu;
	}


	/**
	 * Метод для IDE, исправляет тип возвращаемого объекта с $this на имя конретного класса
	 * Использование $this необходимо, так как одни и те же методы возвращают разные объекты в зависимости от
	 * того находятся они под или после метода начинаюго подменю
	 * @return DropdownMenuBuilder
	 */
	public function end()
	{
		return $this;
	}

	/**
	 * @param DropdownMenuItemBase $item
	 * @param bool $flag_always_down
	 */
	private function _addItem($item, $flag_always_down = false)
	{
		if ($flag_always_down)
		{
			$this->_items_always_down[]	= $item;

		} else
		{
			$this->_items[] 			= $item;
		}
	}


	public function __toString()
	{
		/** @var \view_dropdown_menu */
		return View::render('DropdownMenu', array('dropdown_menu' => $this));
	}
}


class DropdownMenu extends DropdownMenuBuilder
{
	/**
	 * Создание объекта выпадающего меню
	 * @return DropdownMenuBuilder
	 */
	public static function create()
	{
		$class = __CLASS__;
		return new $class();
	}


	/**
	 * @return DropdownMenuItemBase[]
	 */
	public function getItems()
	{
		return array_merge
		(
			(array) $this->_items,
			(array) $this->_items_always_down
		);
	}

	public function getAlign()
	{
		return $this->_align;
	}
}


class DropdownSubmenu extends DropdownMenu
{
	/** @var DropdownMenu|DropdownMenuBuilder */
	private $_parent;


	/**
	 * @param DropdownMenu|DropdownMenuBuilder $parent выпадающий список родитель
	 */
	function __construct($parent)
	{
		parent::__construct();

		$this->_parent = $parent;
	}


	/**
	 * Указатель конца подменю
	 * @return DropdownMenuBuilder
	 */
	public function endSubmenu()
	{
		return $this->_parent;
	}
}


abstract class DropdownMenuItemBase
{
	private $_text;
	private $_icon;
	private $_disabled;
	private $_attributes;


	public function __construct($text, Attributes $attributes = null)
	{
		$this->_text 		= $text;
		$this->_attributes	= $attributes;
	}


	public function setIcon($icon)
	{
		$this->_icon = $icon;

		return $this;
	}


	public function disabled()
	{
		$this->_disabled = true;

		return $this;
	}


	public function isDisabled()
	{
		return $this->_disabled;
	}

	public function getIcon()
	{
		return $this->_icon;
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

class HeaderDropdownMenuItem extends DropdownMenuItemBase
{
	public function __construct($text, Attributes $attributes = null)
	{
		parent::__construct($text, $attributes);
	}
}

class LinkDropdownMenuItem extends DropdownMenuItemBase
{
	private $_url;


	public function __construct($parent, $text, $url, Attributes $attributes = null)
	{
		parent::__construct($text, $attributes);

		$this->_url	= $url;
	}


	public function getUrl()
	{
		return $this->_url;
	}
}


class SubmenuDropdownMenuItem extends DropdownMenuItemBase
{
	private $_dropdown_submenu;


	public function __construct($text, DropdownSubmenu $dropdown_submenu, Attributes $attributes = null)
	{
		parent::__construct($text, $attributes);

		$this->_dropdown_submenu = $dropdown_submenu;
	}


	public function getDropdownSubmenu()
	{
		return $this->_dropdown_submenu;
	}
}