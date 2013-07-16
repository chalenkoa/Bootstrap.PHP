<?php
namespace BootstrapPHP;

class BootstrapPHP
{
	const JS_MODAL 		= 'bootstrap-modal.js';
	const JS_DROPDOWN	= 'bootstrap-dropdown.js';
	const JS_TAB		= 'bootstrap-tab.js';
	const JS_ALERT		= 'bootstrap-alert.js';
	const JS_BUTTON		= 'bootstrap-button.js';

	private static $_register_path;
	private static $_register_autoload;
	private static $_required_js;


	/**
	 * Регистрация функции автозагрузки
	 */
	public static function register_autoload()
	{
		// Защита от повторной регистрации
		if (self::$_register_path !== true)
		{
			$include_paths = explode(\PATH_SEPARATOR, get_include_path());
			// Среди зарегситрированных путей нет нужного?
			if (array_search(self::_getRootPath(), (array) $include_paths) === false)
			{
				// Идем путь текущий каталог (.)
				$offset = array_search('.', $include_paths, true);
				// Если такой путь найден
				if ($offset !== false && is_numeric($offset))
				{
					// Добавляем нужный нам путь перед этим путем
					array_splice( $include_paths, $offset, 1, array(self::_getRootPath(), '.') );

				} else
				{
					// Иначе добавляем нужный нам путь в конец
					$include_paths[] = self::_getRootPath();
				}

				set_include_path(implode(\PATH_SEPARATOR, $include_paths));

				self::$_register_path = true;
			}
		}

		if (
				(self::$_register_autoload !== true)
			&&	(array_search('spl_autoload', (array) spl_autoload_functions()) === false)
		)
		{
			spl_autoload_register('spl_autoload', false, true);

			self::$_register_autoload = true;
		}
	}

	/**
	 * Удаление следов регистрации функции автозагрузки
	 * Если ни чего не регистрировалось, то ничего и не будет удаляться
	 */
	public static function unregister_autoload()
	{
		if (self::$_register_path === true)
		{
			$include_paths = explode(\PATH_SEPARATOR, get_include_path());
			// Поиск зарегистрированого нами пути
			$result = array_search(self::_getRootPath(), $include_paths);
			if ($result !== false)
			{
				// Удаление его из массива
				unset($include_paths[$result]);
			}
			set_include_path(implode(\PATH_SEPARATOR, $include_paths));

			self::$_register_path = false;
		}

		if (self::$_register_autoload === true)
		{
			spl_autoload_unregister('spl_autoload');

			self::$_register_autoload = false;
		}
	}


	public static function addRequiredJs($js)
	{
		self::$_required_js[$js] = $js;
	}

	/**
	 * Получение массива всех имен js файлов для коректной работы использованых компонентов
	 * @return array
	 */
	public static function getRequiredJs()
	{
		return array_values((array) self::$_required_js);
	}


	private static function _getRootPath()
	{
		return dirname(__DIR__);
	}
}