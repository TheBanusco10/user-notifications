<?php

namespace UserNotifications\Classes;

use Carbon_Fields\Carbon_Fields;

class UserNotifications
{

	public static function init()
	{
		add_action("init", function () {
			NotificationCPT::init();
			NotificationShortcodes::init();
			BladeLoader::init();
		});

		// TODO render "No permissions" text when user does not have permissions to see the Notification post
		add_filter('the_content', fn ($content) => NotificationCPT::showNotificationContent($content));

		// Template styles
		add_action("wp_enqueue_scripts", function () {
			NotificationTemplates::init();
		});

		// Carbon Fields
		add_action('after_setup_theme', function () {
			Carbon_Fields::boot();
		});
		add_action('carbon_fields_register_fields', function () {
			NotificationCPT::registerNotificationsFields();
			NotificationAdmin::init();
		});
	}
}
