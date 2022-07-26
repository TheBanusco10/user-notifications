<?php

namespace UserNotifications\Classes;

class ViewsController {
	public static function userNotifications_adminPageView() {
		include PLUGIN_PATH . "Views/dashboard.php";
	}

	public static function userNotifications_notificationsPageView() {
		include PLUGIN_PATH . "Views/notifications.php";
	}

	public static function userNotifications_registerAdminScripts() {
		$screen = get_current_screen();

		if ( $screen->id === UserNotifications::DASHBOARD_PAGE_ID ) {
			wp_enqueue_style( 'un-dashboard-css', PLUGIN_URL . 'Assets/css/dashboard.css' );

			wp_enqueue_script( 'un-dashboard-js', PLUGIN_URL . 'Assets/js/dashboard.js', [ 'jquery' ], '1.0.0', true );
			wp_enqueue_script( 'un-globals-js', PLUGIN_URL . 'Assets/js/globals.js', [ 'jquery' ], '1.0.0', true );
		}else if ( $screen->id === UserNotifications::NOTIFICATIONS_PAGE_ID ) {
			wp_enqueue_style( 'un-notifications-css', PLUGIN_URL . 'Assets/css/notifications.css' );
		}
	}
}