<?php
namespace BootstrapPHP\Helpers;

class View 
{
	const PATH_VIEWS = '../Views/';

	private static $_path_view;


	public static function render($name, $vars = array())
	{
		ob_start();

		$__vars = $vars;
		$__name = $name;

		if (is_array($__vars))
		{
			extract($__vars);
		}

		$__path = self::_getPath($__name);

		require $__path;

		return ob_get_clean();
	}

	private static function _getPath($name)
	{
		if ( ! self::$_path_view)
		{
			self::$_path_view = realpath(__DIR__.\DIRECTORY_SEPARATOR.self::PATH_VIEWS).\DIRECTORY_SEPARATOR;

			if (self::$_path_view === \DIRECTORY_SEPARATOR)
			{
				trigger_error('Задан несуществующий путь до папки с шаблонами.', \E_USER_ERROR);
			}
		}

		return self::$_path_view.$name.'.php';
	}
}