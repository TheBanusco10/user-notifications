<?php

namespace UserNotifications\Classes;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigLoader {

	private static $loader;
	public static $twig;

	public static function init() {
		self::$loader = new FilesystemLoader( PLUGIN_VIEWS_PATH . '/templates/' );
		self::$twig   = new Environment( self::$loader, [ 'debug' => true ] );

		self::$twig->addExtension( new \Twig\Extension\DebugExtension() );
	}

}