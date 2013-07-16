<?php
namespace BootstrapPHP\Base;

use BootstrapPHP\BootstrapPHP;

abstract class Base
{
	public $attributes;

	function __construct()
	{
		$this->attributes = new Attributes($this);
	}


	/**
	 * Возвращает готовый html
	 * @return string
	 */
	public function toHtml()
	{
		return (string) $this;
	}

	protected function _requiredJs($js)
	{
		BootstrapPHP::addRequiredJs($js);
	}
}