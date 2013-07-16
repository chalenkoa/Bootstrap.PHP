<?php
namespace BootstrapPHP\Base;

use BootstrapPHP\Helpers\View;

/**
 * Базовый класс конструктор индикатора процесса Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#progress
 * @see http://bootstrap-ru.com/components.php#progress
 */
abstract class ProgressBase extends Base
{
	/** @var ProgressBarBase[] */
	protected $_bars;


	function __toString()
	{
		/** @var \view_progress */
		return View::render('Progress', array('progress' => $this));
	}


	public function getBars()
	{
		return $this->_bars;
	}
}

abstract class ProgressBarBase
{
	private $_value;
	private $_text;

	function __construct($value, $text)
	{
		$this->_value = $value;
		$this->_text = $text;
	}


	public function getValue()
	{
		return $this->_value;
	}

	public function getText()
	{
		return $this->_text;
	}
}