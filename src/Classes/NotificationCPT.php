<?php

namespace UserNotifications\Classes;

class NotificationCPT {

	const POST_TYPE = 'un_notification';

	public static function init() {
		self::userNotifications_registerNotificationCPT();
	}

	private function userNotifications_registerNotificationCPT() {
		register_post_type( self::POST_TYPE, [
			'label'       => 'Notifications',
			'description' => 'Send notifications to users'
		] );
	}

}