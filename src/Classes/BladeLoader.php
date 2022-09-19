<?php

namespace UserNotifications\Classes;

use Jenssegers\Blade\Blade;

class BladeLoader {

	public static $blade;

	public static function init() {
		self::$blade = new Blade( PLUGIN_VIEWS_PATH . '/templates/', PLUGIN_VIEWS_PATH . '/cache/' );
	}

}