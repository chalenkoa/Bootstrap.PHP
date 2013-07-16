<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;

/**
 * Класс конструктор модального окна Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/javascript.html#modals
 * @see http://bootstrap-ru.com/javascript.php#modals
 */
abstract class ModalBuilder extends Base\Base
{
	/** Задний фон затемнен, по клику окно закрывается */
	const BACKDROP_ON 		= 'true';
	/** Задний фон затемнен, по клику окно НЕ закрывается */
	const BACKDROP_STATIC 	= 'static';
	/** Задний фон НЕ затемнен, по клику окно НЕ закрывается */
	const BACKDROP_OFF 		= 'false';
	const BACKDROP_DEFAULT	= self::BACKDROP_ON;

	protected $_header;
	protected $_body;
	protected $_body_url;
	/**	@var Button[] */
	protected $_buttons;
	/** @var bool флаг указывающий на необходимость плавного появления и исчезания */
	protected $_faded;
	protected $_backdrop = self::BACKDROP_DEFAULT;
	protected $_keyboard = true;


	/**
	 * @param string|bool $header текст заголовка, можно html
	 * @param string|bool $body текст в теле окна, можно html
	 */
	function __construct($header = false, $body = false)
	{
		parent::__construct();

		$this->_requiredJs(BootstrapPHP::JS_MODAL);

		if ($header) $this->setHeader($header);
		if ($body) 	 $this->setBody($body);
	}


	/**
	 * Добавляем окну анимации при появлении/исчезновении
	 * @return ModalBuilder
	 */
	public function makeFaded()
	{
		$this->_faded = true;

		return $this;
	}


	/**
	 * Задание заголовка окна
	 * @param $header заголовок окна, можно html
	 * @return ModalBuilder
	 */
	public function setHeader($header)
	{
		$this->_header = $header;

		return $this;
	}


	/**
	 * Задаем текст в теле окна
	 * @param $body текст в теле, можно html
	 * @return ModalBuilder
	 */
	public function setBody($body)
	{
		if ($this->_body_url)
		{
			trigger_error('Уже задано тело окна методом setBodyUrl' , E_USER_WARNING);
		}

		$this->_body = $body;

		return $this;
	}

	/**
	 * Задем url по которому будет получено содержание тела окна
	 * @param string $body_url url для получение тела окна
	 * @return ModalBuilder
	 */
	public function setBodyUrl($body_url)
	{
		if ($this->_body)
		{
			trigger_error('Уже задано тело окна методом setBody' , E_USER_WARNING);
		}

		$this->_body_url = $body_url;

		return $this;
	}


	/**
	 * Добавление кнопки закрывающей окно
	 * @param string $text надпись на кнопке
	 * @param bool $left true выравнивает кнопку левее, тех что добавлены без этого параметра
	 * @return ModalBuilder
	 */
	public function addButtonClose($text = 'Закрыть', $left = false)
	{
		/**	@var Button $button */
		$button = Button::create($text);

		$this->addButtonToFooter($button, true, $left);

		return $this;
	}

	/**
	 * Добавление кнопки в подвал окна
	 * @param Button|ButtonBuilder $button
	 * @param bool $close true делает кнопку закрывающей окно
	 * @param bool $left true выравнивает кнопку левее, тех что добавлены без этого параметра
	 * @return ModalBuilder
	 */
	public function addButtonToFooter(Button $button, $close = false, $left = false)
	{
		if ($close)
		{
			$this->_makeButtonClosing($button);
		}

		if ($left)
		{
			array_unshift($this->_buttons, $button);

		} else
		{
			$this->_buttons[] = $button;
		}

		return $this;
	}

	private function _makeButtonClosing(Button $button)
	{
		$button->attributes->addData('dismiss', 'modal');
	}


	/**
	 * Задание типа заднего фона
	 * @param $backdrop тип заднего фона, используй константы этого класса BACKDROP_
	 * @return ModalBuilder
	 */
	public function setBackdrop($backdrop)
	{
		$this->_backdrop = $backdrop;

		return $this;
	}


	/**
	 * Задание типа реакции на закрытие с клавиатуры
	 * @param bool $value true окно закрывается по нажатия ESC, false не закрывается
	 * @return $this
	 */
	public function setKeyboard($value)
	{
		$this->_keyboard = (bool) $value;

		return $this;
	}


	function __toString()
	{
		/** @var \view_modal */
		return View::render('Modal', array('modal' => $this));
	}
}


class Modal extends ModalBuilder
{
	/**
	 * Создание объекта окна
	 * @param string|bool $header текст заголовка, можно html
	 * @param string|bool $body текст в теле окна, можно html
	 * @return ModalBuilder
	 */
	public static function create($header = false, $body = false)
	{
		$class = __CLASS__;
		return new $class($header, $body);
	}


	public function getHeader()
	{
		return $this->_header;
	}

	public function getBody()
	{
		return $this->_body;
	}

	public function getFooter()
	{
		$footer = '';
		foreach((array) $this->_buttons as $button)
		{
			$footer .= (string) $button;
		}

		return $footer;
	}

	public function getFaded()
	{
		return $this->_faded;
	}

	public function getBodyUrl()
	{
		return $this->_body_url;
	}

	public function getBackdrop()
	{
		return $this->_backdrop;
	}

	public function getKeyboard()
	{
		return $this->_keyboard;
	}
}