<?php

/*
Plugin Name: User Notifications
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: david
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

use UserNotifications\Classes\UserNotifications;

defined( "ABSPATH" ) or die();

require_once "vendor/autoload.php";

define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) . 'src/' );
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) . 'src/' );
define( 'PLUGIN_VIEWS_PATH', plugin_dir_path( __FILE__ ) . 'src/Views/' );
const DOMAIN = 'un';

const IS_PREMIUM = true;

UserNotifications::init();