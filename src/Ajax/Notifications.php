<?php

namespace UserNotifications\Ajax;

use UserNotifications\Classes\NotificationCPT;

class Notifications {

	public static function userNotifications_registerAjaxScripts() {
		wp_enqueue_script( 'dashboard-ajax', PLUGIN_URL . 'Assets/js/dashboard-requests.js', [ 'jquery' ], false, true );

		wp_localize_script( 'dashboard-ajax', 'ajax_wordpress', [
			'url'                       => admin_url( 'admin-ajax.php' ),
			'action'                    => 'userNotifications_sendNotification',
			'action_removeNotification' => 'userNotifications_removeNotification'
		] );
	}

	public static function userNotifications_actionAjaxEvents() {
		add_action( 'wp_ajax_nopriv_userNotifications_sendNotification', function () {
			self::userNotifications_sendNotification();
		} );
		add_action( 'wp_ajax_userNotifications_sendNotification', function () {
			self::userNotifications_sendNotification();
		} );

		add_action( 'wp_ajax_nopriv_userNotifications_removeNotification', function () {
			self::userNotifications_removeNotification();
		} );
		add_action( 'wp_ajax_userNotifications_removeNotification', function () {
			self::userNotifications_removeNotification();
		} );
	}

	private function userNotifications_sendNotification() {
		header( 'Content-type: application/json' );

		$newNotification = $_POST['notification'] ?? null;
		$users           = $_POST['users'] ?? null;

		if ( $newNotification && $users ) {

			$postID = wp_insert_post( [
				'post_title'   => sanitize_text_field( $newNotification['title'] ),
				'post_content' => sanitize_text_field( $newNotification['description'] ),
				'post_status'  => 'publish',
				'post_type'    => NotificationCPT::POST_TYPE
			] );

			update_post_meta( $postID, 'users', $users );

			foreach ( $users as $user ) {
				update_user_meta( intval( $user ), 'un_hasNotification', true );
			}

			wp_send_json( [
				'result' => __( 'Notification sent successfully', DOMAIN )
			], 200 );
		}

		wp_send_json( [
			'result' => __( 'Something was wrong', DOMAIN )
		], 400 );

	}

	private function userNotifications_removeNotification() {
		$notification_id = $_POST['notification_id'] ?? null;

		if ( $notification_id ) {
			wp_delete_post( $notification_id, true );

			wp_send_json( [
				'result' => __( 'Notification removed', DOMAIN )
			], 200 );
		} else {
			wp_send_json( [
				'result' => __( 'Something was wrong', DOMAIN )
			], 400 );
		}

	}
}