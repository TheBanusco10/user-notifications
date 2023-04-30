<?php

namespace UserNotifications\Classes;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use UserNotifications\Helpers\NotificationsHelper;

class NotificationCPT
{

	private static $instance = false;

	const POST_TYPE = 'un_notification';

	public static function init()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}

		self::$instance->registerNotificationCPT();
	}

	private function registerNotificationCPT()
	{
		register_post_type(self::POST_TYPE, [
			'label'       => 'Notifications',
			'description' => 'Send notifications to users',
			'public'      => true,
			'supports'    => ['title', 'editor', 'excerpt', 'thumbnail'],
			'rewrite'     => [
				'slug' => 'notification'
			]
		]);
	}

	public static function registerNotificationsFields()
	{
		$roles       = wp_roles()->get_names();
		$rolesOption = [];
		foreach ($roles as $role) {
			$rolesOption[strtolower($role)] = $role;
		}


		Container::make('post_meta', 'Users')
			->where('post_type', '=', self::POST_TYPE)
			->add_fields([
				Field::make('multiselect', 'user_roles_select', __('Choose roles to send notifications', DOMAIN))
					->set_options($rolesOption)
					->set_required(true)
			]);
	}

	public static function showNotificationContent($content)
	{
		global $post;

		// If the user is not logged in, it redirects to the home page
		if (!is_user_logged_in() && $post->post_type === NotificationCPT::POST_TYPE) {
			wp_safe_redirect(home_url());
		}

		// If the user does not have permissions, it returns "no permissions" text
		$currentUserID = get_current_user_id();
		if (!NotificationsHelper::canUserSeeNotification($currentUserID, $post->ID)) {
			return __("You do not have permissions to see this notification", DOMAIN);
		}

		return $content;
	}
}
