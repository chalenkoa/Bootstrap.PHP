<?php
namespace BootstrapPHP;

use BootstrapPHP\Base\Attributes;
use BootstrapPHP\Helpers\View;

/**
 * Класс конструктор хлебных крошек Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#breadcrumbs
 * @see http://bootstrap-ru.com/components/#breadcrumbs
 */
abstract class BreadcrumbsBuilder extends Base\Base
{
	protected $_items;


	/**
	 * Добавление элемента в хлебные крошки
	 * @param string $text текст элемента, можно html
	 * @param string|bool $url ссылка, если не задана, будет просто текст
	 * @param Attributes $attributes
	 * @return BreadcrumbsBuilder
	 */
	public function addItems($text, $url = false, Attributes $attributes = null)
	{
		$this->_items[] = array($text, $url, $attributes);

		return $this;
	}


	function __toString()
	{
		/** @var \view_breadcrumbs */
		return View::render('Breadcrumbs', array('breadcrumbs' => $this));
	}
}

class Breadcrumbs extends BreadcrumbsBuilder
{
	/**
	 * Создание объекта хлебных крошек
	 * @return BreadcrumbsBuilder
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
}