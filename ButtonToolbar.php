<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;

/**
 * Класс конструктор тулбара кнопок Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#buttonGroups
 * @see http://bootstrap-ru.com/components.php#buttonGroups
 */
abstract class ButtonToolbarBuilder extends Base\Base
{
	/** @var ButtonGroup[] */
	protected $_items;


	function __construct()
	{
		parent::__construct();
	}


	/**
	 * Добавление групы кнопок в тулбар
	 * @param ButtonGroup|ButtonGroupBuilder $button_group
	 * @return ButtonToolbarBuilder
	 */
	public function addButtonGroup(ButtonGroup $button_group)
	{
		$this->_items[] = $button_group;

		return $this;
	}


	function __toString()
	{
		/** @var \view_button_toolbar */
		return View::render('ButtonToolbar', array('button_toolbar' => $this));
	}
}


class ButtonToolbar extends ButtonToolbarBuilder
{
	/**
	 * Создание объекта тулбара кнопок
	 * @return ButtonToolbarBuilder
	 */
	public static function create()
	{
		$class = __CLASS__;
		return new $class();
	}


	public function getItems()
	{
		return (array) $this->_items;
	}
}