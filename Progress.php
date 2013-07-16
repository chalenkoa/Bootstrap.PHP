<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;

/**
 * Класс конструктор индикатора процесса Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#progress
 * @see http://bootstrap-ru.com/components.php#progress
 */
abstract class ProgressBuilder extends Base\ProgressBase
{
	const TYPE_INFO 	= 'progress-info';
	const TYPE_SUCCESS 	= 'progress-success';
	const TYPE_WARNING 	= 'progress-warning';
	const TYPE_DANGER 	= 'progress-danger';
	const TYPE_DEFAULT 	= '';

	protected $_type;
	protected $_striped;
	protected $_animated;


	/**
	 * @param number $value значение в процентах
	 * @param string $type тип индикатора, используй константы этого класса TYPE_
	 * @param string $text текст на индикаторе
	 */
	function __construct($value, $type = self::TYPE_DEFAULT, $text = '')
	{
		parent::__construct();

		$this->_bars[0] = new ProgressBar($value, $text);
		$this->_type 	= $type;
	}


	/**
	 * Делает индикатор полосатый
	 * @param bool $animated true анимирует полосы
	 * @return ProgressBuilder
	 */
	public function makeStriped($animated = false)
	{
		$this->_striped		= true;
		$this->_animated	= $animated;

		return $this;
	}
}


class Progress extends ProgressBuilder
{
	/**
	 * Создание объекта индикатора
	 * @param number $value значение в процентах
	 * @param string $type тип индикатора, используй константы этого класса TYPE_
	 * @param string $text текст на индикаторе
	 * @return ProgressBuilder
	 */
	public static function create($value, $type = self::TYPE_DEFAULT, $text = '')
	{
		$class = __CLASS__;
		return new $class($value, $type, $text);
	}


	public function getType()
	{
		return $this->_type;
	}

	public function getStriped()
	{
		return $this->_striped;
	}

	public function getAnimated()
	{
		return $this->_animated;
	}
}

class ProgressBar extends Base\ProgressBarBase {}