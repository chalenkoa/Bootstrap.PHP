<?php
namespace BootstrapPHP\Base;

class Autoload
{
	const NAMESPACE_SEPARATOR = '\\';

	/** @var Корневой путь приложения */
	private static $_include_path;
	/** @var Флаг регистрации функции автозагрузки */
	private static $_flag_register;
	/** @var Корневое пространство имен */
	private static $_root_ns;


	/** Регистрация функции автозагрузки */
	public static function register()
	{
		if (self::$_flag_register) return;

		self::$_root_ns 		= strstr(__NAMESPACE__, self::NAMESPACE_SEPARATOR, true);
		self::$_include_path 	= dirname(dirname(__DIR__));

		spl_autoload_register(array(__CLASS__, 'autoload'), false, true);

		self::$_flag_register = true;
	}


	/** Удаление следов регистрации функции автозагрузки */
	public static function unregister()
	{
		if (self::$_flag_register !== true) return;

		self::$_root_ns			= null;
		self::$_include_path 	= null;

		spl_autoload_unregister(array(__CLASS__, 'autoload'));

		self::$_flag_register = false;
	}


	/**
	 * Функция автозагрузки, вызываыется после регистрации каждый раз когда обнаруживается неизвестный класс
	 * @param $class_name
	 */
	public static function autoload($class_name)
	{
		// Защита от запуска не для нашего пространства имен
		if (strstr($class_name, self::NAMESPACE_SEPARATOR, true) !== self::$_root_ns) return;

		$path =
			self::$_include_path.\DIRECTORY_SEPARATOR.
			str_replace(self::NAMESPACE_SEPARATOR, \DIRECTORY_SEPARATOR, $class_name).
			'.php';

		if (file_exists($path))
		{
			include $path;
		}
	}
}