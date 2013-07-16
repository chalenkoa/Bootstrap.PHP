<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;
use BootstrapPHP\Base\Attributes;

/**
 * Класс конструктор навигации по страницам Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#pagination
 * @see http://bootstrap-ru.com/components.php#pagination
 */
abstract class PaginationBuilder extends Base\Base
{
	const SIZE_LARGE 	= 'pagination-large';
	const SIZE_SMALL 	= 'pagination-small';
	const SIZE_MINI 	= 'pagination-mini';
	const SIZE_DEFAULT 	= '';

	const ALIGN_CENTER	= 'pagination-centered';
	const ALIGN_RIGHT	= 'pagination-right';
	CONST ALIGN_DEFAULT	= '';

	protected $_size	= self::SIZE_DEFAULT;
	protected $_align	= self::ALIGN_DEFAULT;

	/**	@var PagerItem[] $_items */
	protected $_items;


	function __construct()
	{
		parent::__construct();
	}


	/**
	 * Задание выравнивания блока
	 * @param string $align выравнивание, используй константы этого класса ALIGN_
	 * @return PaginationBuilder
	 */
	public function setAlign($align)
	{
		$this->_align = $align;

		return $this;
	}


	/**
	 * Задание размера блока
	 * @param string $size размер, используй константы этого класса SIZE_
	 * @return PaginationBuilder
	 */
	public function setSize($size)
	{
		$this->_size = $size;

		return $this;
	}


	/**
	 * Добавление элемента в навигацию по страницам
	 * @param string $text текст, можно использовать html
	 * @param string $url
	 * @param bool $active true делает активной текущей
	 * @param bool $disabled true блокирует элемент
	 * @param Attributes $attributes
	 * @return PaginationBuilder
	 */
	public function addItem($text, $url, $active = false, $disabled = false, Attributes $attributes = null)
	{
		$item = new PaginationItem();
		$item->text 		= $text;
		$item->url 			= $url;
		$item->active 		= $active;
		$item->disabled		= $disabled;
		$item->attributes	= $attributes;

		$this->_items[] = $item;

		return $this;
	}


	function __toString()
	{
		/** @var \view_pagination */
		return View::render('Pagination', array('pagination' => $this));
	}
}


class Pagination extends PaginationBuilder
{
	/**
	 * Создание объекта навигации по страницам
	 * @return PaginationBuilder
	 */
	public static function create()
	{
		$class = __CLASS__;
		return new $class();
	}


	public function getSize()
	{
		return $this->_size;
	}

	public function getAlign()
	{
		return $this->_align;
	}

	public function getItems()
	{
		return $this->_items;
	}
}


class PaginationItem
{
	public $text;
	public $url;
	public $disabled;
	public $active;
	public $attributes;
}