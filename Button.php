<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;

/**
 * Класс конструктор кнопки Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/base-css.html#buttons
 * @see http://bootstrap-ru.com/base-css/#buttons
 */
abstract class ButtonBuilder extends Base\Base
{
	// Классы меняющие цвет кнопок
	const TYPE_PRIMARY 	= 'btn-primary';
	const TYPE_INFO 	= 'btn-info';
	const TYPE_SUCCESS 	= 'btn-success';
	const TYPE_WARNING 	= 'btn-warning';
	const TYPE_DANGER 	= 'btn-danger';
	const TYPE_INVERSE 	= 'btn-inverse';
	const TYPE_LINK 	= 'btn-link';
	const TYPE_DEFAULT	= '';

	// Классы меняющие внутрение отступы кнопки
	const SIZE_LARGE	= 'btn-large';
	const SIZE_SMALL	= 'btn-small';
	const SIZE_MINI		= 'btn-mini';
	const SIZE_DEFAULT	= '';

	/** Ширина кнопки определяется доступной шириной блока */
	const WIDTH_BLOCK 	= 'btn-block';
	/** Ширина кнопки определяется длинной текста на кнопке */
	const WIDTH_DEFAULT = '';

	// Используемый для кнопки html тэг
	const TAG_A			= 'a';
	const TAG_BUTTON	= 'button';
	const TAG_INPUT		= 'input';
	const TAG_DEFAULT	= self::TAG_A;

	protected $_text;
	protected $_url;
	protected $_icon;
	protected $_tag 	= self::TAG_DEFAULT;
	protected $_toggle;
	protected $_text_loading;

	// Относятся к выпадающему меню
	protected $_dropdown_menu;
	protected $_dropdown_menu_split_button;
	protected $_dropdown_menu_align_right;
	protected $_dropdown_menu_drop_up;

	/**
	 * @var string Тип кнопки определяющий ее цвет. Используй конатранты TYPE_
	 * @see http://bootstrap-ru.com/base_css.php#buttons
	 */
	protected $_type 		= self::TYPE_DEFAULT;

	/** @var string Рарзмер книпки влиящие на внутрение отступы. Используй конатранты SIZE_ */
	protected $_size 		= self::SIZE_DEFAULT;

	/** @var string Ширина кнопки. Используй конатранты WIDTH_ */
	protected $_width 		= self::WIDTH_DEFAULT;

	/** @var bool Флаг делающий кнопку влк/выкл */
	protected $_enable 		= true;


	/**
	 * @param string $text текст на кнопке
	 * @param string|bool $url ссылка для перехода по нажатию на кнопку
	 * @param string|IconBuilder|bool $icon класс иконки для кнопки, используй константу класса Icon, либо объект Icon
	 * @see http://bootstrap-ru.com/base_css.php#icons
	 */
	function __construct($text, $url = false, $icon = false)
	{
		parent::__construct();

		$this->setText($text);
		$this->setUrl($url);

		$this->_icon = $icon;
	}

	/**
	 * Переопределение текста на кнопке
	 * @param $text текст, можно html
	 * @return ButtonBuilder
	 */
	public function setText($text)
	{
		$this->_text = $text;

		return $this;
	}

	/**
	 * Переопределение ссылки кнопки
	 * @param $url
	 * @return ButtonBuilder
	 */
	public function setUrl($url)
	{
		$this->_url = $url;

		return $this;
	}

	/**
	 * Задание типа кнопки
	 * @param $type тип, используй константы этого класса TYPE_
	 * @return ButtonBuilder
	 */
	public function setType($type)
	{
		$this->_type = $type;

		return $this;
	}

	/**
	 * Задание рамера кнопки
	 * @param $size размер, используй константы этого класса SIZE_
	 * @return ButtonBuilder
	 */
	public function setSize($size)
	{
		$this->_size = $size;

		return $this;
	}

	/**
	 * Задание способо определение ширины кнопки
	 * @param $width способ определение ширины, используй константы этого класса  WIDTH_
	 * @return ButtonBuilder
	 */
	public function setWidth($width)
	{
		$this->_width = $width;

		return $this;
	}

	/**
	 * Вкл/выкл кнопки
	 * @param bool $enable true вкл, false выкл
	 * @return ButtonBuilder
	 */
	public function setEnable($enable)
	{
		$this->_enable = $enable;

		return $this;
	}


	/**
	 * Задание текста который будет написан на кнопке в то время когда она будет находиться в состоянии loading
	 * @param string $text
	 * @return ButtonBuilder
	 */
	public function setLoadingText($text)
	{
		$this->_requiredJs(BootstrapPHP::JS_BUTTON);

		$this->_text_loading = $text;

		return $this;
	}


	/**
	 * Делает кнопку переключателем
	 * @return ButtonBuilder
	 */
	public function makeToggle()
	{
		$this->_requiredJs(BootstrapPHP::JS_BUTTON);

		$this->_toggle = true;

		return $this;
	}


	/**
	 * Задание тэга на основе которого будет созадана кнопка
	 * @param $tag тэг, используй конатранты этого класса TAG_
	 * @return  ButtonBuilder
	 */
	public function setTag($tag)
	{
		$this->_tag = $tag;

		return $this;
	}


	/**
	 * Добавление выпадающего меню
	 * @param DropdownMenu|DropdownMenuBuilder $dropdown_menu
	 * @param bool $split_button флаг разделить кнопку на кнопку + кнопку открывающую выпадающий списко
	 * @param bool $align_right флаг выравнивающий выпадающий список по правому краю кнопку
	 * @param bool $drop_up флаг делающий список выпадающим вверх
	 * @return ButtonBuilder
	 */
	public function addDropdownMenu
	(
		DropdownMenu $dropdown_menu,
		$split_button 	= false,
		$align_right 	= false,
		$drop_up 		= false
	)
	{
		$this->_requiredJs(BootstrapPHP::JS_BUTTON);

		$this->_dropdown_menu 				= $dropdown_menu;
		$this->_dropdown_menu_split_button 	= $split_button;
		$this->_dropdown_menu_align_right 	= $align_right;
		$this->_dropdown_menu_drop_up 		= $drop_up;

		return $this;
	}

	/**
	 * Удаление выпадающего меню у кнопки
	 * @return ButtonBuilder
	 */
	public function resetDropdownMenu()
	{
		unset($this->_dropdown_menu);

		return $this;
	}


	function __toString()
	{
		if ($this->_dropdown_menu)
		{
			/** @var \view_button_dropdown */
			return View::render('ButtonDropdown', array('button' => $this));

		} else
		{
			/** @var \view_button */
			return View::render('Button', array('button' => $this));
		}
	}
}

class Button extends ButtonBuilder
{
	/**
	 * Создает объект кнопки
	 * @param string $text текст на кнопке
	 * @param string|bool $url ссылка для перехода по нажатию на кнопку
	 * @param string|IconBuilder|bool $icon класс иконки для кнопки, используй константу класса Icon, либо объект Icon
	 * @return ButtonBuilder
	 */
	public static function create($text, $url = false, $icon = false)
	{
		$class = __CLASS__;
		return new $class($text,  $url, $icon);
	}


	public function getType()
	{
		return $this->_type;
	}

	public function getSize()
	{
		return $this->_size;
	}

	public function getWidth()
	{
		return $this->_width;
	}

	public function isEnable()
	{
		return $this->_enable;
	}

	public function getTag()
	{
		if ( ($this->_tag === self::TAG_INPUT) && ($this->getIcon()) )
		{
			trigger_error('С тегом input иконка не отображается', E_USER_WARNING);
		}

		return $this->_tag;
	}

	public function getTextLoading()
	{
		return $this->_text_loading;
	}

	public function getText()
	{
		return $this->_text;
	}

	public function getToggle()
	{
		return $this->_toggle;
	}

	public function getIcon()
	{
		return $this->_icon;
	}

	public function getUrl()
	{
		if ($this->getToggle() && $this->_url)
		{
			trigger_error('Для кнопок переключателей нельзя присваивать ссылку. Ссылка удалена', E_USER_NOTICE);
			$this->setUrl('');
		}

		return $this->_url;
	}


	/**
	 * @return DropdownMenu
	 */
	public function getDropdownMenu()
	{
		return $this->_dropdown_menu;
	}

	public function getDropdownMenuSplitButton()
	{
		return $this->_dropdown_menu_split_button;
	}

	public function getDropdownMenuAlignRight()
	{
		return $this->_dropdown_menu_align_right;
	}

	public function getDropdownMenuDropUp()
	{
		return $this->_dropdown_menu_drop_up;
	}
}