<?php

namespace UserNotifications\Classes;

class UserNotifications {

	const DASHBOARD_PAGE_ID = 'toplevel_page_dashboard-user-notifications';

	public static function init() {
		add_action("admin_menu", function () {
			self::userNotifications_registerAdminPage();
		});
		add_action("admin_enqueue_scripts", function () {
			ViewsController::userNotifications_registerAdminScripts();
		});
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
}