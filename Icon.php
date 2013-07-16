<?php
namespace BootstrapPHP;

use BootstrapPHP\Helpers\View;

/**
 * Класс конструктор иконки Bootstrap
 *
 * @see http://twitter.github.io/bootstrap/base-css.html#icons
 * @see http://bootstrap-ru.com/base_css.php#icons
 */
abstract class IconBuilder extends Base\Base
{
	const TYPE_GLASS =				'icon-glass';
	const TYPE_MUSIC =				'icon-music';
	const TYPE_SEARCH =				'icon-search';
	const TYPE_ENVELOPE =			'icon-envelope';
	const TYPE_HEART =				'icon-heart';
	const TYPE_STAR =				'icon-star';
	const TYPE_STAR_EMPTY =			'icon-star-empty';
	const TYPE_USER =				'icon-user';
	const TYPE_FILM =				'icon-film';
	const TYPE_TH_LARGE =			'icon-th-large';
	const TYPE_TH =					'icon-th';
	const TYPE_TH_LIST =			'icon-th-list';
	const TYPE_OK =					'icon-ok';
	const TYPE_REMOVE =				'icon-remove';
	const TYPE_ZOOM_IN =			'icon-zoom-in';
	const TYPE_ZOOM_OUT =			'icon-zoom-out';
	const TYPE_OFF =				'icon-off';
	const TYPE_SIGNAL =				'icon-signal';
	const TYPE_COG =				'icon-cog';
	const TYPE_TRASH =				'icon-trash';
	const TYPE_HOME =				'icon-home';
	const TYPE_FILE =				'icon-file';
	const TYPE_TIME =				'icon-time';
	const TYPE_ROAD =				'icon-road';
	const TYPE_DOWNLOAD_ALT =		'icon-download-alt';
	const TYPE_DOWNLOAD =			'icon-download';
	const TYPE_UPLOAD =				'icon-upload';
	const TYPE_INBOX =				'icon-inbox';
	const TYPE_PLAY_CIRCLE =		'icon-play-circle';
	const TYPE_REPEAT =				'icon-repeat';
	const TYPE_REFRESH =			'icon-refresh';
	const TYPE_LIST_ALT =			'icon-list-alt';
	const TYPE_LOCK =				'icon-lock';
	const TYPE_FLAG =				'icon-flag';
	const TYPE_HEADPHONES =			'icon-headphones';
	const TYPE_VOLUME_OFF =			'icon-volume-off';
	const TYPE_VOLUME_DOWN =		'icon-volume-down';
	const TYPE_VOLUME_UP =			'icon-volume-up';
	const TYPE_QRCODE =				'icon-qrcode';
	const TYPE_BARCODE =			'icon-barcode';
	const TYPE_TAG =				'icon-tag';
	const TYPE_TAGS =				'icon-tags';
	const TYPE_BOOK =				'icon-book';
	const TYPE_BOOKMARK =			'icon-bookmark';
	const TYPE_PRINT_ =				'icon-print';
	const TYPE_CAMERA =				'icon-camera';
	const TYPE_FONT =				'icon-font';
	const TYPE_BOLD =				'icon-bold';
	const TYPE_ITALIC =				'icon-italic';
	const TYPE_TEXT_HEIGHT =		'icon-text-height';
	const TYPE_TEXT_WIDTH =			'icon-text-width';
	const TYPE_ALIGN_LEFT =			'icon-align-left';
	const TYPE_ALIGN_CENTER =		'icon-align-center';
	const TYPE_ALIGN_RIGHT =		'icon-align-right';
	const TYPE_ALIGN_JUSTIFY =		'icon-align-justify';
	const TYPE_LIST_ =				'icon-list';
	const TYPE_INDENT_LEFT =		'icon-indent-left';
	const TYPE_INDENT_RIGHT =		'icon-indent-right';
	const TYPE_FACETIME_VIDEO =		'icon-facetime-video';
	const TYPE_PICTURE =			'icon-picture';
	const TYPE_PENCIL =				'icon-pencil';
	const TYPE_MAP_MARKER =			'icon-map-marker';
	const TYPE_ADJUST =				'icon-adjust';
	const TYPE_TINT =				'icon-tint';
	const TYPE_EDIT =				'icon-edit';
	const TYPE_SHARE =				'icon-share';
	const TYPE_CHECK =				'icon-check';
	const TYPE_MOVE =				'icon-move';
	const TYPE_STEP_BACKWARD =		'icon-step-backward';
	const TYPE_FAST_BACKWARD =		'icon-fast-backward';
	const TYPE_BACKWARD =			'icon-backward';
	const TYPE_PLAY =				'icon-play';
	const TYPE_PAUSE =				'icon-pause';
	const TYPE_STOP =				'icon-stop';
	const TYPE_FORWARD =			'icon-forward';
	const TYPE_FAST_FORWARD =		'icon-fast-forward';
	const TYPE_STEP_FORWARD =		'icon-step-forward';
	const TYPE_EJECT =				'icon-eject';
	const TYPE_CHEVRON_LEFT =		'icon-chevron-left';
	const TYPE_CHEVRON_RIGHT =		'icon-chevron-right';
	const TYPE_PLUS_SIGN =			'icon-plus-sign';
	const TYPE_MINUS_SIGN =			'icon-minus-sign';
	const TYPE_REMOVE_SIGN =		'icon-remove-sign';
	const TYPE_OK_SIGN =			'icon-ok-sign';
	const TYPE_QUESTION_SIGN =		'icon-question-sign';
	const TYPE_INFO_SIGN =			'icon-info-sign';
	const TYPE_SCREENSHOT =			'icon-screenshot';
	const TYPE_REMOVE_CIRCLE =		'icon-remove-circle';
	const TYPE_OK_CIRCLE =			'icon-ok-circle';
	const TYPE_BAN_CIRCLE =			'icon-ban-circle';
	const TYPE_ARROW_LEFT =			'icon-arrow-left';
	const TYPE_ARROW_RIGHT =		'icon-arrow-right';
	const TYPE_ARROW_UP =			'icon-arrow-up';
	const TYPE_ARROW_DOWN =			'icon-arrow-down';
	const TYPE_SHARE_ALT =			'icon-share-alt';
	const TYPE_RESIZE_FULL =		'icon-resize-full';
	const TYPE_RESIZE_SMALL =		'icon-resize-small';
	const TYPE_PLUS =				'icon-plus';
	const TYPE_MINUS =				'icon-minus';
	const TYPE_ASTERISK =			'icon-asterisk';
	const TYPE_EXCLAMATION_SIGN =	'icon-exclamation-sign';
	const TYPE_GIFT =				'icon-gift';
	const TYPE_LEAF =				'icon-leaf';
	const TYPE_FIRE =				'icon-fire';
	const TYPE_EYE_OPEN =			'icon-eye-open';
	const TYPE_EYE_CLOSE =			'icon-eye-close';
	const TYPE_WARNING_SIGN =		'icon-warning-sign';
	const TYPE_PLANE =				'icon-plane';
	const TYPE_CALENDAR =			'icon-calendar';
	const TYPE_RANDOM =				'icon-random';
	const TYPE_COMMENT =			'icon-comment';
	const TYPE_MAGNET =				'icon-magnet';
	const TYPE_CHEVRON_UP =			'icon-chevron-up';
	const TYPE_CHEVRON_DOWN =		'icon-chevron-down';
	const TYPE_RETWEET =			'icon-retweet';
	const TYPE_SHOPPING_CART =		'icon-shopping-cart';
	const TYPE_FOLDER_CLOSE =		'icon-folder-close';
	const TYPE_FOLDER_OPEN =		'icon-folder-open';
	const TYPE_RESIZE_VERTICAL =	'icon-resize-vertical';
	const TYPE_RESIZE_HORIZONTAL =	'icon-resize-horizontal';
	const TYPE_HDD =				'icon-hdd';
	const TYPE_BULLHORN =			'icon-bullhorn';
	const TYPE_BELL =				'icon-bell';
	const TYPE_CERTIFICATE =		'icon-certificate';
	const TYPE_THUMBS_UP =			'icon-thumbs-up';
	const TYPE_THUMBS_DOWN =		'icon-thumbs-down';
	const TYPE_HAND_RIGHT =			'icon-hand-right';
	const TYPE_HAND_LEFT =			'icon-hand-left';
	const TYPE_HAND_UP =			'icon-hand-up';
	const TYPE_HAND_DOWN =			'icon-hand-down';
	const TYPE_CIRCLE_ARROW_RIGHT =	'icon-circle-arrow-right';
	const TYPE_CIRCLE_ARROW_LEFT =	'icon-circle-arrow-left';
	const TYPE_CIRCLE_ARROW_UP =	'icon-circle-arrow-up';
	const TYPE_CIRCLE_ARROW_DOWN =	'icon-circle-arrow-down';
	const TYPE_GLOBE =				'icon-globe';
	const TYPE_WRENCH =				'icon-wrench';
	const TYPE_TASKS =				'icon-tasks';
	const TYPE_FILTER =				'icon-filter';
	const TYPE_BRIEFCASE =			'icon-briefcase';
	const TYPE_FULLSCREEN =			'icon-fullscreen';

	protected $_type;
	protected $_white;


	/**
	 * @param string $type тип, используй константы этого класса TYPE_
	 * @param bool $white true делает иконку белой
	 */
	function __construct($type, $white = false)
	{
		parent::__construct();

		$this->_type	= $type;
		$this->_white	= $white;
	}


	function __toString()
	{
		/** @var \view_icon */
		return View::render('Icon', array('icon' => $this));
	}
}


class Icon extends IconBuilder
{
	/**
	 * Создает объект иконки
	 * @param string $type тип, используй константы этого класса TYPE_
	 * @param bool $white true делает иконку белой
	 * @return IconBuilder
	 */
	public static function create($type, $white = false)
	{
		$class = __CLASS__;
		return new $class($type, $white);
	}

	public function getType()
	{
		return $this->_type;
	}

	public function getWhite()
	{
		return $this->_white;
	}
}