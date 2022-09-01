<?php

namespace UserNotifications\Classes;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

class NotificationCPT {

	const POST_TYPE = 'un_notification';

	public static function init() {
		self::userNotifications_registerNotificationCPT();
	}

	private function userNotifications_registerNotificationCPT() {
		register_post_type( self::POST_TYPE, [
			'label'       => 'Notifications',
			'description' => 'Send notifications to users',
			'public' => true
		] );
	}

	public static function userNotifications_registerNotificationsFields() {
		Container::make( 'post_meta', 'Users' )
			->where( 'post_type', '=', self::POST_TYPE )
			->add_fields( [
				Field::make( 'multiselect', 'user_roles_select', __( 'Choose roles to send notifications', 'un' ) )
					->set_options( wp_roles()->get_names() )
			] );
	}

}