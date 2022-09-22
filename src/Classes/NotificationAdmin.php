<?php

namespace UserNotifications\Classes;

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

class NotificationAdmin {
	private static $instance = false;

	public static function init() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		self::$instance->userNotifications_registerOptionsAdminPage();
	}

	function userNotifications_registerOptionsAdminPage() {
		Container::make( 'theme_options', __( 'Options', DOMAIN ) )
		         ->set_page_parent( 'user-notifications' )
		         ->add_tab( __( 'Pages', DOMAIN ), [
			         Field::make( 'select', 'un_select_template', __( 'Select a template for notifications', DOMAIN ) )
			              ->set_options( [
				              'basic_template' => __( 'Basic template', DOMAIN ),
				              'flex_template'  => __( 'Flex template', DOMAIN )
			              ] ),
			         Field::make( 'checkbox', 'un_has_redirect_page', __( 'Redirect user to page', DOMAIN ) ),
			         Field::make( 'association', 'un_redirect_page', __( 'Select a page to be redirected if user is not logged in', DOMAIN ) )
			              ->set_conditional_logic( [
				              [
					              'field' => 'un_has_redirect_page',
					              'value' => true
				              ]
			              ] )
			              ->set_types( [
				              [
					              'type'      => 'post',
					              'post_type' => 'page'
				              ]
			              ] )
			              ->set_max( 1 ),
			         Field::make( 'text', 'un_user_not_logged_text', __( 'Text when user is not logged in', DOMAIN ) )
			              ->set_conditional_logic( [
				              [
					              'field' => 'un_has_redirect_page',
					              'value' => false
				              ]
			              ] ),
		         ] )
		         ->add_tab( __( 'Messages', DOMAIN ), [
			         Field::make( 'text', 'un_no_notifications', __( 'Text when there is no notifications', DOMAIN ) )
		         ] );
	}

	static function registerMainAdminPage() {
		add_menu_page( 'User Notifications', 'User Notifications', 'manage_options', 'user-notifications', function () {
			echo BladeLoader::$blade->render( 'about' );
		}, 'dashicons-bell' );
	}
}