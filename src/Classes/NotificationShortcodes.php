<?php

namespace UserNotifications\Classes;

class NotificationShortcodes {

	const SHORTCODE_ID = 'un_notifications';

	public static function init() {
		add_shortcode( self::SHORTCODE_ID, [ self::class, 'userNotifications_showUserNotifications' ] );
	}

	function userNotifications_showUserNotifications( $atts ) {
		$user = wp_get_current_user();

		$hasRedirectPage = carbon_get_theme_option( 'un_has_redirect_page' );

		if ( ! is_user_logged_in() ) {
			if ( $hasRedirectPage ) {
				$redirectPage = (object) carbon_get_theme_option( 'un_redirect_page' )[0];
				wp_redirect( get_the_permalink( $redirectPage->id ) );
			} else {
				$text = carbon_get_theme_option( 'un_user_not_logged_text' );

				if ( empty( $text ) ) {
					$text = __( 'Please, log in to see your notifications', DOMAIN );
				}

				ob_start();

				echo "<p class='un-user__not-logged-in'>$text</p>";

				return ob_get_clean();
			}
		}

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

		echo BladeLoader::$blade->render( $notificationTemplate, [
			'notifications' => $notifications
		] );


		return ob_get_clean();
	}

}