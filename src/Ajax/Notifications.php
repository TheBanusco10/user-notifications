<?php

namespace UserNotifications\Ajax;

use UserNotifications\Classes\NotificationCPT;

class Notifications {

	public static function userNotifications_registerAjaxScripts() {
		wp_enqueue_script( 'dashboard-ajax', PLUGIN_URL . 'Assets/js/dashboard-requests.js', [ 'jquery' ], false, true );

		wp_localize_script( 'dashboard-ajax', 'ajax_wordpress', [
			'url'    => admin_url( 'admin-ajax.php' ),
			'action' => 'userNotifications_sendNotification'
		] );
	}

	private function userNotifications_sendNotification() {
		header('Content-type: application/json');

		$newNotification = $_POST['notification'] ?? null;
		$users =  $_POST['users'] ?? null;

		if ($newNotification && $users) {

			$postID = wp_insert_post( [
				'post_title'   => sanitize_text_field($newNotification['title']),
				'post_content' => sanitize_text_field($newNotification['description']),
				'post_status'  => 'publish',
				'post_type'    => NotificationCPT::POST_TYPE
			] );

			update_post_meta($postID, 'users', $users);

			wp_send_json( [
				'result' => __('Notification sent successfully', 'un')
			], 200 );
		}

		wp_send_json( [
			'result' => __('Something was wrong', 'un')
		], 400 );

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