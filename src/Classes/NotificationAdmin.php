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

		self::$instance->userNotifications_registerAdminPage();
	}

	function userNotifications_registerAdminPage() {
		$container = Container::make( 'theme_options', __( 'Notifications Settings', DOMAIN ) );

		$container->add_fields( [
			Field::make( 'select', 'un_select_template', __( 'Select a template for notifications', DOMAIN ) )
			     ->set_options( [
				     'basic_template' => __( 'Basic template', DOMAIN ),
				     'flex_template'  => __( 'Flex template', DOMAIN )
			     ] )
		] );

	}
}