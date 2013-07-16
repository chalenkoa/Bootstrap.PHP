<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;
use BootstrapPHP\Base\Attributes;

/**
 * Класс конструктор индикатора процесса c несколькими процессами Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#progress
 * @see http://bootstrap-ru.com/components.php#progress
 */
abstract class ProgressStackBuilder extends Base\ProgressBase
{
	const TYPE_INFO 	= 'bar-info';
	const TYPE_SUCCESS 	= 'bar-success';
	const TYPE_WARNING 	= 'bar-warning';
	const TYPE_DANGER 	= 'bar-danger';
	const TYPE_DEFAULT 	= '';


	/**
	 * Добавление внутреннего индикатора
	 * @param string $value значение в процентах
	 * @param string $type тип индикатора, используй константы этого класса TYPE_
	 * @param string $text текст на индикаторе
	 * @param Attributes $attributes
	 * @return ProgressStackBuilder
	 */
	public function addBar($value, $type = self::TYPE_DEFAULT, $text = '', Attributes $attributes = null)
	{
		$this->_bars[] = new ProgressStackBar($value, $type, $text, $attributes);

		return $this;
	}
}


class ProgressStack extends ProgressStackBuilder
{
	/**
	 * @return ProgressStackBuilder
	 */
	public static function create()
	{
		$class = __CLASS__;
		return new $class();
	}
}


class ProgressStackBar extends Base\ProgressBarBase
{
	private $_type;
	private $_attributes;


	function __construct($value, $type, $text, Attributes $attributes = null)
	{
		parent::__construct($value, $text);

		$this->_type 		= $type;
		$this->_attributes	= $attributes;
	}


	public function getType()
	{
		return $this->_type;
	}

	public function getAttributes()
	{
		return $this->_attributes;
	}
}