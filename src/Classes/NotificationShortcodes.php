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

		$notificationTemplate = carbon_get_theme_option( "un_select_template" );

		ob_start();

//		include ViewsController::userNotifications_notificationsTemplate( $notificationTemplate );
//		echo TwigLoader::$twig->render( 'test.html.twig', [
//			'notifications' => $notifications->posts
//		] );
		echo BladeLoader::$blade->render( 'test2', [
			'notifications' => $notifications
		] );

		return ob_get_clean();
	}

}