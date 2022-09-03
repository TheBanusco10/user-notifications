<?php

namespace UserNotifications\Classes;

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

class NotificationAdmin {
	public static function init() {
		self::userNotifications_registerAdminPage();
	}

	function userNotifications_registerAdminPage() {
		$container = Container::make( 'theme_options', __( 'Notifications Settings', DOMAIN ) );

		if ( IS_PREMIUM ) {
			$container->add_fields( [
				Field::make( 'select', 'un_select_template', __( 'Select a template for notifications', DOMAIN ) )
				     ->set_options( [
					     'basic'        => __( 'Basic template', DOMAIN ),
					     'premium_flex' => __( 'Premium Flex template', DOMAIN )
				     ] )
			] );
		}

	}
}