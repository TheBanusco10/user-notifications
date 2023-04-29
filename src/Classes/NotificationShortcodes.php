<?php

namespace UserNotifications\Classes;

class NotificationShortcodes
{

	const SHORTCODE_ID = 'un_notifications';

	public static function init()
	{
		$obj = new self();

		add_shortcode(self::SHORTCODE_ID, [$obj, 'showUserNotifications']);
	}

	function showUserNotifications($atts)
	{
		$user = wp_get_current_user();

		$notifications = new \WP_Query([
			'post_type'  => 'un_notification',
			'meta_query' => [
				[
					'key'   => 'user_roles_select',
					'value' => $user->roles,
				]
			]
		]);

		$notificationTemplate = carbon_get_theme_option("un_select_template");

		ob_start();

		if (!is_user_logged_in()) {
			_e('You must be logged in order to see notifications', DOMAIN);
		} else {
			echo BladeLoader::$blade->render($notificationTemplate, [
				'notifications' => $notifications,
			]);
		}

		return ob_get_clean();
	}
}
