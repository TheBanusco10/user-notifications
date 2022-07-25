<?php

namespace UserNotifications\Ajax;

use UserNotifications\Classes\NotificationCPT;

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

//			$notifications = get_option(self::OPTION_ID);
//
//			$notifications[] = [
//				'notification' => $newNotification,
//				'users' => $users
//			];
//
//			update_option(self::OPTION_ID, $notifications);

			$postID = wp_insert_post( [
				'post_title'   => 'New notification',
				'post_content' => $newNotification,
				'post_status'  => 'publish',
				'post_type'    => NotificationCPT::POST_TYPE
			] );

			update_post_meta($postID, 'users', $users);


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