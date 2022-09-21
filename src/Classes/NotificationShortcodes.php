<?php

namespace UserNotifications\Classes;

class NotificationShortcodes {

	const SHORTCODE_ID = 'un_notifications';

	public static function init() {
		add_shortcode( self::SHORTCODE_ID, [ self::class, 'userNotifications_showUserNotifications' ] );
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

		if ( is_user_logged_in() ) {
			echo BladeLoader::$blade->render( $notificationTemplate, [
				'notifications' => $notifications
			] );
		} else {
			_e( 'Please, log in to see your notifications', DOMAIN );
		}

		return ob_get_clean();
	}

}