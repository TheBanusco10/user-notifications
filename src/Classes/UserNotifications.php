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
			NotificationShortcodes::init();
			BladeLoader::init();
		} );
		add_action( "wp", function () {
			global $post;
			global $wp_query;

			$user         = wp_get_current_user();
			$rolesAllowed = carbon_get_post_meta( $post->ID, 'user_roles_select' );

			if ( ! in_array( 'administrator', $user->roles ) && $wp_query->query['post_type'] === NotificationCPT::POST_TYPE && ! $wp_query->is_admin && empty( array_intersect( $user->roles, $rolesAllowed ) ) ) {
				wp_redirect( get_home_url() );
			}
		} );
//		add_action( "admin_enqueue_scripts", function () {
//			ViewsController::userNotifications_registerAdminScripts();
//			Notifications::userNotifications_registerAjaxScripts();
//		} );
		// Template styles
		add_action( "wp_enqueue_scripts", function () {
			NotificationTemplates::init();
		} );

		// Carbon Fields
		add_action( 'after_setup_theme', function () {
			Carbon_Fields::boot();
		} );
		add_action( 'carbon_fields_register_fields', function () {
			NotificationCPT::userNotifications_registerNotificationsFields();
			NotificationAdmin::init();
		} );
	}
}