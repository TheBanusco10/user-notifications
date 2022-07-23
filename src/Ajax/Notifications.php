<?php

namespace UserNotifications\Ajax;

class Notifications {

	const OPTION_ID = 'un_notifications';

	public static function userNotifications_registerAjaxScripts() {
		wp_enqueue_script( 'dashboard-ajax', PLUGIN_URL . 'Assets/js/dashboard-requests.js', [ 'jquery' ], false, true );

		wp_localize_script( 'dashboard-ajax', 'ajax_wordpress', [
			'url'    => admin_url( 'admin-ajax.php' ),
			'action' => 'userNotifications_sendNotification'
		] );
	}

	private function userNotifications_sendNotification() {
		$newNotification = $_POST['notification'] ?? null;
		$users =  $_POST['users'] ?? null;

		if ($newNotification && $users) {

			$notifications = get_option(self::OPTION_ID);

			$notifications[] = [
				'notification' => $newNotification,
				'users' => $users
			];

			update_option(self::OPTION_ID, $notifications);

			wp_send_json( [
				'result' => 'Notification sent'
			], 200 );
		}

		wp_send_json( [
			'result' => 'Something was wrong'
		], 500 );

	}

	public static function userNotifications_actionAjaxEvents() {
		add_action( 'wp_ajax_nopriv_userNotifications_sendNotification', function () {
			self::userNotifications_sendNotification();
		} );
		add_action( 'wp_ajax_userNotifications_sendNotification', function () {
			self::userNotifications_sendNotification();
		} );
	}

}