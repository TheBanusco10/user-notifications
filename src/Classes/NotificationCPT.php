<?php

namespace UserNotifications\Classes;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

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
}
