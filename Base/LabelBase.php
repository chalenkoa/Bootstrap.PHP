<?php
namespace BootstrapPHP\Base;

use BootstrapPHP\Helpers\View;

/**
 * Базовый класс конструктор метки Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/components.html#labels-badges
 * @see http://bootstrap-ru.com/components.php#labels-badges
 */
abstract class LabelBase extends Base
{
	CONST TYPE_SUCCESS 		= 'success';
	const TYPE_WARNING 		= 'warning';
	const TYPE_IMPORTANT 	= 'important';
	const TYPE_INFO			= 'info';
	const TYPE_INVERSE		= 'inverse';
	const TYPE_DEFAULT		= '';

	protected $_text;
	protected $_type;


	/**
	 * @param string $text текст на метке, можно html
	 * @param string $type тип, используй контстанты этого класса TYPE_
	 */
	function __construct($text, $type = self::TYPE_DEFAULT)
	{
		parent::__construct();

		$this->_text = $text;
		$this->_type = $type;
	}


	/**
	 * Создает объект метки
	 * @param string $text текст на метке, можно html
	 * @param string $type тип, используй контстанты этого класса TYPE_
	 * @return LabelBase
	 */
	public static function create($text, $type = self::TYPE_DEFAULT)
	{
		$class = get_called_class();
		return new $class($text, $type);
	}


	function __toString()
	{
		/** @var \view_label */
		return View::render('Label', array('label' => $this));
	}


	public function getText()
	{
		return $this->_text;
	}

	public function getType()
	{
		return $this->_type;
	}
}