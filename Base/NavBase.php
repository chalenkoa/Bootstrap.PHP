<?php
namespace BootstrapPHP\Base;

use BootstrapPHP\Helpers\View;

abstract class NavBase extends Base
{
	/** @var NavItemBase[] */
	protected $_items;


	protected function _addItem($text, $url = '#', $disabled = false, $active = false, Attributes $attributes = null)
	{
		$this->_pushItem(new NavItemBase($text, $url, $disabled, $active, $attributes));

		return $this;
	}

	protected function _pushItem(NavItemBase $item)
	{
		$this->_items[] = $item;
	}


	public function getItems()
	{
		return $this->_items;
	}
}

class NavItemBase
{
	protected $_text;
	protected $_url;
	protected $_disabled;
	protected $_active;
	protected $_attributes;


	function __construct($text, $url = '#', $disabled = false, $active = false, Attributes $attributes = null)
	{
		$this->_text		= $text;
		$this->_url			= $url;
		$this->_disabled	= $disabled;
		$this->_active		= $active;
		$this->_attributes	= $attributes;
	}


	public function getText()
	{
		return $this->_text;
	}

	public function getUrl()
	{
		return $this->_url;
	}

	public function getDisabled()
	{
		return $this->_disabled;
	}

	public function getActive()
	{
		return $this->_active;
	}

	public function getAttributes()
	{
		return $this->_attributes;
	}
}