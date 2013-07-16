<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;

/**
 * Класс конструктор группы кнопок Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#buttonGroups
 * @see http://bootstrap-ru.com/components.php#buttonGroups
 */
abstract class ButtonGroupBuilder extends Base\Base
{
	const DIRECTION_VERTICAL	= 'btn-group-vertical';
	const DIRECTION_DEFAULT		= '';

	/** Каждая конопка в группе нажимается независимо от других */
	const TYPE_TOGGLE_CHECKBOX	= 'buttons-checkbox';
	/** Нажатие одной кнопки в группе приводит к отпусканию другой, может быть нажата только одна */
	const TYPE_TOGGLE_RADIO		= 'buttons-radio';

	const ALIGN_RIGHT			= 'pull-right';
	const ALIGN_DEFAULT			= '';

	protected $_direction;
	protected $_type_toggle;


	/** @var Button[] */
	protected $_items;

	/** @var string выравнивание группы в родительском блоке */
	protected $_align;


	/**
	 * @param string $direction направление расположения кнопопк в группе, используй константы этого класса DIRECTION_
	 */
	function __construct($direction = self::DIRECTION_DEFAULT)
	{
		parent::__construct();

		$this->setDirection($direction);
	}


	/**
	 * Задание направление расположения кнопок в группе
	 * @param $direction направление, используй константы этого класса DIRECTION_
	 * @return ButtonGroupBuilder
	 */
	public function setDirection($direction)
	{
		$this->_direction = $direction;

		return $this;
	}


	/**
	 * Добавление кнопки в группу
	 * @param Button|ButtonBuilder $button
	 * @return ButtonGroupBuilder
	 */
	public function addButton(Button $button)
	{
		$this->_items[] = $button;

		return $this;
	}


	/**
	 * Задание выравнивания группы в родительском блоке
	 * @param string $align выравнивание, используй константы этого класса ALIGN_
	 * @return ButtonGroupBuilder
	 */
	public function setAlign($align = self::ALIGN_DEFAULT)
	{
		$this->_align = $align;

		return $this;
	}


	/**
	 * Делаем группу кнопопк переключателем
	 * @param $type тип переключателя, используй констаныт этого класса TYPE_TOGGLE_
	 * @return ButtonGroupBuilder
	 */
	public function makeToggle($type)
	{
		$this->_requiredJs(BootstrapPHP::JS_BUTTON);

		$this->_type_toggle = $type;

		return $this;
	}


	function __toString()
	{
		/** @var \view_button_group */
		return View::render('ButtonGroup', array('button_group' => $this));
	}
}

class ButtonGroup extends ButtonGroupBuilder
{
	const DROP_UP				= 'dropup';
	const DROP_DEFAULT			= '';

	/** @var string указатель куда должен выпадать список выпадающего меню */
	private $_drop;

	/** @var string дополнительное содержание следующее за кнопками */
	private $_dropdown_menu;


	/**
	 * Создание объекта группы кнопок
	 * @param string $direction направление расположения кнопопк в группе, используй константы этого класса DIRECTION_
	 * @return ButtonGroupBuilder
	 */
	public static function create($direction = self::DIRECTION_DEFAULT)
	{
		$class = __CLASS__;
		return new $class($direction);
	}


	/**
	 * Добавление выпадающего списка
	 * @param DropdownMenu $dropdown_menu
	 * @return ButtonGroup
	 */
	public function addDropdownMenu($dropdown_menu)
	{
		$this->_dropdown_menu = $dropdown_menu;

		return $this;
	}


	/**
	 * Задание куда должен выпадать список выпадающего меню
	 * @param string $drop
	 * @return ButtonGroup
	 */
	public function setDrop($drop)
	{
		$this->_drop = $drop;

		return $this;
	}


	public function getDirection()
	{
		return $this->_direction;
	}

	public function getItems()
	{
		return $this->_items;
	}

	public function getTypeToggle()
	{
		return $this->_type_toggle;
	}

	public function getAlign()
	{
		return $this->_align;
	}

	public function getDrop()
	{
		return $this->_drop;
	}

	public function getDropdownMenu()
	{
		return $this->_dropdown_menu;
	}
}