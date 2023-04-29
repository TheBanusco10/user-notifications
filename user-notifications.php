<?php

/*
Plugin Name: User Notifications
Plugin URI: https://github.com/TheBanusco10/user-notifications
Description: Send notifications to the website's users in an easy way.
Version: 1.0.0
Author: David Jimenez
Author URI: https://djvdev.com
License: GPLv3
*/

use UserNotifications\Classes\UserNotifications;

defined("ABSPATH") or die();

require_once "vendor/autoload.php";

define('PLUGIN_URL', plugin_dir_url(__FILE__) . 'src/');
define('PLUGIN_PATH', plugin_dir_path(__FILE__) . 'src/');
define('PLUGIN_VIEWS_PATH', plugin_dir_path(__FILE__) . 'src/Views/');
define('DOMAIN', 'un');

UserNotifications::init();
