<?php
namespace BootstrapPHP\Base;

use BootstrapPHP\BootstrapPHP;
use BootstrapPHP\DropdownMenu;
use BootstrapPHP\Helpers\View;

abstract class NavTabsBase extends NavBase
{
	private $_stacked;

	/** @var bool флаг указывающий на необходимость затухания вкладок с контентом при переключении */
	private $_faded;

	/** @var bool флаг указывающий на наличие элементов с контентом в навигации */
	private $_contented;

	/** @var DropdownNavItem */
	private $_dropdown;


	/**
	 * Делает вертикальным стеком
	 * @return NavTabsBase
	 */
	public function makeStacked()
	{
		$this->_stacked = true;

		return $this;
	}

	/**
	 * Добавляет анимация плавного появляения содержания
	 * @return NavTabsBase
	 */
	public function makeFaded()
	{
		$this->_faded = true;

		return $this;
	}


	/**
	 * Добавление элемент
	 * @param string $text текст на элементе
	 * @param string $url url ссылки
	 * @param bool $disabled true блокирует элемент
	 * @param bool $active true делает элемент активным текущим
	 * @param Attributes $attributes
	 * @return NavTabsBase
	 */
	public function addItem($text, $url = '#', $disabled = false, $active = false, Attributes $attributes = null)
	{
		if (count((array) $this->getItems()) > 0 && $this->getContented() === true)
		{
			trigger_error('Нельзя смешивать элементы обычные и содержащие контент', E_USER_ERROR);
		}

		parent::_addItem($text, $url, $disabled, $active, $attributes);

		return $this;
	}


	/**
	 * Добавляем элемент с содержанием
	 * @param string $text текст на элементе
	 * @param string $id уникальный id содрежания
	 * @param string $content содержание показываемое по клику, можно использовать html
	 * @param bool $disabled true блокирует элемент
	 * @param bool $active true делает элемент активным текущим
	 * @param Attributes $attributes
	 * @return NavTabsBase
	 */
	public function addContentItem(
		$text, $id, $content, $disabled = false, $active = false, Attributes $attributes = null
	)
	{
		if (count((array) $this->getItems()) > 0 && $this->getContented() !== true)
		{
			trigger_error('Нельзя смешивать элементы обычные и содержащие контент', E_USER_ERROR);
		}

		$this->_contented = true;

		$this->_requiredJs(BootstrapPHP::JS_TAB);

		$item = new ContentNavItem($text, '#', $disabled, $active, $attributes);
		$item->setId($id);
		$item->setContent($content);

		$this->_pushItem($item);

		return $this;
	}


	/**
	 * Метка начала выпадающего меню, последующие добавляемые элементы будут добавлены в это меню
	 * @param string $text тект, по клику на которой появляется выпадающее меню
	 * @param bool $disabled true блокирует элемент
	 * @param bool $active true делает элемент активным текущим
	 * @return NavTabsBase
	 */
	public function startDropdown($text, $disabled = false, $active = false)
	{
		if ($this->_dropdown)
		{
			trigger_error('Прежде чем начинать новый выпадающий список, нужно завершить предыдущий', E_USER_WARNING);

			$this->endDropdown();
		}

		$dropdown = new DropdownNavItem($text, $disabled, $active);

		// Не менять местами, порядок важен
		$this->_pushItem($dropdown);
		$this->_dropdown = $dropdown;

		return $this;
	}

	/**
	 * Метка конца выпадающего меню
	 * @return NavTabsBase
	 */
	public function endDropdown()
	{
		$this->_dropdown = null;

		return $this;
	}


	/**
	 * Добавление разделителя внутри выпадающего меню
	 * @return NavTabsBase
	 */
	public function addDivider()
	{
		if ( ! $this->_dropdown)
		{
			trigger_error('Добавлять разделитель можно только внутри выпадающего списка', E_USER_ERROR);
		}

		if ($this->getContented())
		{
			$this->addContentItem(DropdownMenu::DIVIDER, '', '');

		} else
		{
			$this->addItem(DropdownMenu::DIVIDER);
		}

		return $this;
	}


	protected function _pushItem(NavItemBase $item)
	{
		if ($this->_dropdown)
		{
			$this->_dropdown->addItem($item);

		} else
		{
			parent::_pushItem($item);
		}
	}


	function __toString()
	{
		/** @var \view_tabs */
		return View::render('Tabs', array('tabs' => $this));
	}


	public function getContentItems()
	{
		$items = array();
		foreach($this->getItems() as $item)
		{
			if ($item instanceof DropdownNavItem)
			{
				/** @var DropdownNavItem $item */
				$items = array_merge(
					(array) $items,
					(array) $item->getItems()
				);

			} else
			{
				$items[] = $item;
			}

		}

		return $items;
	}

	public function getStacked()
	{
		return $this->_stacked;
	}

	public function getFaded()
	{
		return $this->_faded;
	}

	public function getContented()
	{
		return $this->_contented;
	}
}


class ContentNavItem extends NavItemBase
{
	private $_id;
	private $_content;


	public function setId($id)
	{
		$this->_id = $id;
	}

	public function setContent($content)
	{
		$this->_content = $content;
	}


	public function getId()
	{
		return $this->_id;
	}

	public function getContent()
	{
		return $this->_content;
	}
}


class DropdownNavItem extends NavItemBase
{
	/** @var ContentNavItem[]|NavItemBase[] */
	private $_items;


	function __construct($text, $disabled = false, $active = false)
	{
		$this->_text		= $text;
		$this->_disabled	= $disabled;
		$this->_active		= $active;
	}

	public function addItem(NavItemBase $item)
	{
		$this->_items[] = $item;
	}


	/**
	 * @return ContentNavItem[]|NavItemBase[]
	 */
	public function getItems()
	{
		return $this->_items;
	}


	public function getDropdownMenu()
	{
		/** @var DropdownMenu $dropdown_menu */
		$dropdown_menu = DropdownMenu::create();

		foreach($this->getItems() as $item)
		{
			if ($item->getText() === DropdownMenu::DIVIDER)
			{
				$dropdown_menu->addDivider();

			} else
			{
				$url =
				(
					( $item instanceof ContentNavItem )
					? '#'.$item->getId()
					: $item->getUrl()
				);

				$attributes = $item->getAttributes();

				if ($item instanceof ContentNavItem)
				{
					if ( ! ($attributes instanceof Attributes))
					{
						$attributes = Attributes::create();
					}

					$attributes->addData('toggle', 'tab');
				}

				$dropdown_menu->addLink( $item->getText(), $url, false, $item->getDisabled(), false, $attributes );
			}
		}

		return $dropdown_menu;
	}
}