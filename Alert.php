<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;

/**
 * Класс конструктор сообщения Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#alerts
 * @see http://bootstrap-ru.com/components.php#alerts
 */
abstract class AlertBuilder extends Base\Base
{
	const TYPE_ERROR	= 'alert-error';
	const TYPE_SUCCESS	= 'alert-success';
	const TYPE_INFO		= 'alert-info';
	const TYPE_DEFAULT	= '';

	const SIZE_BLOCK	= 'alert-block';
	const SIZE_DEFAULT	= '';

	protected $_text;
	protected $_type;
	protected $_block;


	/**
	 * @param string $text текст сообщения, можно html
	 * @param string $type тип, используй константы этого класса TYPE_
	 * @param bool $block флаг делающий сообщение большим блоком
	 */
	function __construct($text, $type = self::TYPE_DEFAULT, $block = false)
	{
		parent::__construct();

		$this->_text 	= $text;
		$this->_type 	= $type;
		$this->_block 	= $block;

		$this->_requiredJs(BootstrapPHP::JS_ALERT);
	}


	function __toString()
	{
		/** @var \view_alert */
		return View::render('Alert', array('alert' => $this));
	}
}


class Alert extends AlertBuilder
{
	/**
	 * Сооздает объект сообщения
	 * @param string $text текст сообщения, можно html
	 * @param string $type тип, используй константы TYPE_
	 * @param bool $block флаг делающий сообщение большим блоком
	 * @return AlertBuilder
	 */
	public static function create($text, $type = self::TYPE_DEFAULT, $block = false)
	{
		$class = __CLASS__;
		return new $class($text, $type, $block);
	}


	public function getText()
	{
		return $this->_text;
	}

	public function getType()
	{
		return $this->_type;
	}

	public function getBlock()
	{
		return $this->_block;
	}
}