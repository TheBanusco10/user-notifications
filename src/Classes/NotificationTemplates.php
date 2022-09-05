<?php

namespace UserNotifications\Classes;

class NotificationTemplates {

	const BASIC_TEMPLATE = "basic_template";
	const FLEX_TEMPLATE = "flex_template";

	public static function init() {
		self::userNotifications_registerTemplateStyles();
	}

	function userNotifications_registerTemplateStyles() {
		$templateSelected = carbon_get_theme_option( "un_select_template" );

		switch ( $templateSelected ) {
			case self::BASIC_TEMPLATE:
				wp_enqueue_style( "basic-template", PLUGIN_URL . 'Assets/css/templates/basic-template.css' );
				break;
			case self::FLEX_TEMPLATE:
				wp_enqueue_style( "flex-template", PLUGIN_URL . 'Assets/css/templates/flex-template.css' );
				break;
		}
	}
}