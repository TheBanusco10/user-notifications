<?php

namespace UserNotifications\Classes;

use Carbon_Fields\Carbon_Fields;

class UserNotifications {

	public static function init() {
		add_action( "init", function () {
			NotificationCPT::init();
			NotificationShortcodes::init();
			BladeLoader::init();
		} );
		add_action( 'admin_menu', function () {
			NotificationAdmin::registerMainAdminPage();
		} );
		// If user is not logged in, return to home page
//		add_action( "wp", function () {
//			global $post;
//
//			$user = wp_get_current_user();
//
//			if ( $user->ID === 0 && has_shortcode( $post->post_content, NotificationShortcodes::SHORTCODE_ID ) ) {
//				wp_redirect( get_home_url() );
//			}
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