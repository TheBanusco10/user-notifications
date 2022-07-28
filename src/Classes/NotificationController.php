<?php

namespace UserNotifications\Classes;

class NotificationController {

	public static function init() {
		self::userNotifications_checkUserNotifications();
	}

	private function userNotifications_checkUserNotifications() {
		global $menu;

		$hasNotification = boolval( get_user_meta( get_current_user_id(), 'un_hasNotification', true ) );

		$menu_item = wp_list_filter(
			$menu,
			array( 5 => UserNotifications::NOTIFICATIONS_PAGE_ID )
		);

		$menuPosition = key( $menu_item );

		if ( $hasNotification && ! empty( $menu_item ) ) {
			$menu[$menuPosition][0] .= "<span class='awaiting-mod'>!</span>";
		} else {
			$menu[$menuPosition][0] .= "";
		}

	}

	public static function userNotifications_removeUserNotification() {
		update_user_meta( get_current_user_id(), 'un_hasNotification', false );
	}


}