<?php

namespace UserNotifications\Classes;

use Carbon_Fields\Carbon_Fields;
use UserNotifications\Ajax\Notifications;

class UserNotifications {

	const DASHBOARD_PAGE_ID = 'toplevel_page_dashboard-user-notifications';
	const NOTIFICATIONS_PAGE_ID = 'toplevel_page_notifications-user-notifications';

	public static function init() {
		add_action( "init", function () {
			NotificationCPT::init();
			Notifications::userNotifications_actionAjaxEvents();
		} );
		add_action( "admin_menu", function () {
			self::userNotifications_registerAdminPage();
			self::userNotifications_registerNotificationsPage();
			NotificationController::init();
		} );
		add_action( "admin_enqueue_scripts", function () {
			ViewsController::userNotifications_registerAdminScripts();
			Notifications::userNotifications_registerAjaxScripts();
		} );
		// Carbon Fields
		add_action( 'after_setup_theme', function () {
			Carbon_Fields::boot();
		} );
		add_action( 'carbon_fields_register_fields', function () {
			NotificationCPT::userNotifications_registerNotificationsFields();
		} );
	}

	private function userNotifications_registerAdminPage() {
		add_menu_page(
			"Dashboard - User Notifications",
			"Dashboard - User Notifications",
			"manage_options",
			"dashboard-user-notifications",
			function () {
				ViewsController::userNotifications_adminPageView();
			},
			"dashicons-dashboard"
		);
	}

	private function userNotifications_registerNotificationsPage() {
		add_menu_page(
			"Notifications",
			"Notifications",
			"read",
			"notifications-user-notifications",
			function () {
				ViewsController::userNotifications_notificationsPageView();
			},
			"dashicons-bell"
		);
	}
}