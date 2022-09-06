<?php

namespace UserNotifications\Classes;

class NotificationTemplates {

	public static function init() {
		self::userNotifications_registerTemplateStyles();
	}

	function userNotifications_registerTemplateStyles() {
		$templateSelected = carbon_get_theme_option( "un_select_template" );
		
		wp_enqueue_style( $templateSelected, PLUGIN_URL . "Assets/css/templates/$templateSelected.css" );
	}
}