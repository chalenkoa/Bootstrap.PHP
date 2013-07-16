<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;
use BootstrapPHP\Base\Attributes;

/**
 * Класс конструктор элемента Pager Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#pagination
 * @see http://bootstrap-ru.com//components/#pagination
 */
abstract class PagerBuilder extends Base\Base
{
	const ARROW_LEFT	= 'left';
	const ARROW_RIGHT	= 'right';

	/** @var PagerItem[] */
	protected $_items;
	protected $_arrows;

	/**
	 * Добавляем элемент Предыдущий
	 * @param string $text текст в блоке со стрелкой влево
	 * @param string $url
	 * @param bool $disabled true блокируют элемент
	 * @param Attributes $attributes
	 * @return PagerBuilder
	 */
	public function addItemPrevious($text, $url = '#', $disabled = false, Attributes $attributes = null)
	{
		return $this->addItem($text, $url, $disabled, $attributes, PagerItem::TYPE_PREVIOUS);
	}

	/**
	 * Добавление элемента Следующий
	 * @param string $text текст в блоке со стрелкой вправо
	 * @param string $url
	 * @param bool $disabled true блокируют элемент
	 * @param Attributes $attributes
	 * @return PagerBuilder
	 */
	public function addItemNext($text, $url = '#', $disabled = false, Attributes $attributes = null)
	{
		return $this->addItem($text, $url, $disabled, $attributes, PagerItem::TYPE_NEXT);
	}

	/**
	 * Добавление элемента
	 * @param string $text текст на элементе
	 * @param string $url
	 * @param bool $disabled true блокируют элемент
	 * @param Attributes $attributes
	 * @param string $type
	 * @return PagerBuilder
	 */
	public function addItem(
		$text, $url = '#', $disabled = false, Attributes $attributes = null, $type = PagerItem::TYPE_DEFAULT
	)
	{
		$index =
		(
			( $type == PagerItem::TYPE_DEFAULT )
			? count($this->_items) + 1
			: $type
		);

		$this->_items[$index] 				= new PagerItem();

		$this->_items[$index]->text			= $text;
		$this->_items[$index]->url			= $url;
		$this->_items[$index]->disabled		= $disabled;
		$this->_items[$index]->attributes	= $attributes;

		return $this;
	}


	/**
	 * Переопределение стрелки влево
	 * @param string $arrow стрелка, можно html
	 * @return PagerBuilder
	 */
	public function setArrowLeft($arrow)
	{
		return $this->_setArrow($arrow, self::ARROW_LEFT);
	}

	/**
	 * Переопределение стрелки вправо
	 * @param string $arrow стрелка, можно html
	 * @return PagerBuilder
	 */
	public function setArrowRight($arrow)
	{
		return $this->_setArrow($arrow, self::ARROW_RIGHT);
	}

	/**
	 * @param string $arrow вид стрелки
	 * @param string $direction
	 * @return PagerBuilder
	 */
	private function _setArrow($arrow, $direction)
	{
		$this->_arrows[$direction] = $arrow;

		return $this;
	}


	public function __toString()
	{
		/** @var \view_pager */
		return View::render('Pager', array('pager' => $this));
	}
}

class Pager extends PagerBuilder
{
	/**
	 * Создание объекта Pager
	 * @return PagerBuilder
	 */
	public static function create()
	{
		$class = __CLASS__;
		return new $class();
	}

	public function getItems()
	{
		return $this->_items;
	}

	public function getArrow($direction)
	{
		return $this->_arrows[$direction];
	}
}

class PagerItem
{
	const TYPE_PREVIOUS 	= 'previous';
	const TYPE_NEXT 		= 'next';
	const TYPE_DEFAULT 		= '';

	public $text;
	public $url;
	public $disabled;
	public $attributes;
}