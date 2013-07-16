<?php
namespace BootstrapPHP;

use BootstrapPHP\Base\Autoload;

include_once 'Base/Autoload.php';

class BootstrapPHP
{
	const JS_MODAL 		= 'bootstrap-modal.js';
	const JS_DROPDOWN	= 'bootstrap-dropdown.js';
	const JS_TAB		= 'bootstrap-tab.js';
	const JS_ALERT		= 'bootstrap-alert.js';
	const JS_BUTTON		= 'bootstrap-button.js';

	private static $_required_js;


	/**
	 * Регистрация функции автозагрузки
	 */
	public static function register_autoload()
	{
		Autoload::register();
	}

	/**
	 * Удаление следов регистрации функции автозагрузки
	 * Если ни чего не регистрировалось, то ничего и не будет удаляться
	 */
	public static function unregister_autoload()
	{
		Autoload::unregister();
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
}