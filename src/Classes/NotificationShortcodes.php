<?php

namespace UserNotifications\Classes;

class NotificationShortcodes {

	public static function init() {
		add_shortcode( "un_notifications", [ self::class, 'userNotifications_showUserNotifications' ] );
	}

	function userNotifications_showUserNotifications( $atts ) {
		$user = wp_get_current_user();

		$notifications = new \WP_Query( [
			'post_type'  => 'un_notification',
			'meta_query' => [
				[
					'key'   => 'user_roles_select',
					'value' => $user->roles,
				]
			]
		] );

		ob_start();
		include ViewsController::userNotifications_displayNotificationsShortcode();

		return ob_get_clean();
	}

}