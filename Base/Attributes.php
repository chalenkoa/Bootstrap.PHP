<?php
namespace BootstrapPHP\Base;

class Attributes
{
	private $_that;
	private $_id;
	private $_classes;
	private $_data;


	/**
	 * @param object|null $that объект возвращаемый при использовании цепочки вызовов, по-умолчанию самого себя
	 */
	function __construct($that = null)
	{
		$this->_that = ( $that ? $that : $this );
	}


	/**
	 * Создание объекта атрибутов
	 * @return Attributes
	 */
	public static function create()
	{
		return new Attributes();
	}


	/**
	 * Сброс всех заданных атрибутов
	 * @return Base|Attributes
	 */
	public function reset()
	{
		unset($this->_id);
		unset($this->_classes);
		unset($this->_data);

		return $this->_that;
	}


	/**
	 * Здание уникального id html элемента
	 * @param $id
	 * @return Base|Attributes
	 */
	public function setId($id)
	{
		$this->_id = $id;

		return $this->_that;
	}

	/**
	 * Добавление класса html элементу
	 * @param string|array $class класс или массив классов
	 * @return Base|Attributes
	 */
	public function addClass($class)
	{
		$classes = (array) $class;
		foreach($classes as $class)
		{
			$this->_classes[$class] = $class;
		}

		return $this->_that;
	}

	/**
	 * Добавление data атрибутов html элементу
	 * @param string|array $name имя атрибута, либо массив вида array('name_1'='value1', 'name_n'='value_n')
	 * @param string $value значение атрибута
	 * @return Base|Attributes
	 */
	public function addData($name, $value = '')
	{
		$data =
		(
			( is_array($name) )
			? $name
			: array($name => $value)
		);

		foreach($data as $name => $value)
		{
			$this->_data[$name] = $value;
		}

		return $this->_that;
	}



	public function getId()
	{
		return $this->_id;
	}

	public function getClasses()
	{
		return $this->_classes;
	}

	public function getData()
	{
		return $this->_data;
	}
}