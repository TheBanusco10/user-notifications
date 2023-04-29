<?php

namespace UserNotifications\Classes;

class NotificationTemplates
{

	private static $instance = false;

	public static function init()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}

		self::$instance->registerTemplateStyles();
	}

	function registerTemplateStyles()
	{
		$templateSelected = carbon_get_theme_option("un_select_template");

		wp_enqueue_style($templateSelected, PLUGIN_URL . "Assets/css/templates/$templateSelected.css");
	}
}
