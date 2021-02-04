<?php
/*
Plugin Name: پیام کاربران
Plugin URI: http://example.com/pluginpage
Author: حامد مودی
Author URI: http://ircodex.ir/?author=1
Version: 1.0.0
Description: این افزونه برای ایجاد ارتباط پیام متنی در بین کاربران می شباید.
Licence: GPLv2 or later
*/

defined ( 'ABSPATH' ) || exit;

Define('HMUM_ADMIN_DIR', plugin_dir_path( __FILE__ ) . 'admin/' );
Define('HMUM_ADMIN_INC_DIR', plugin_dir_path( __FILE__ ) . 'admin/includes/' );
Define('HMUM_ADMIN_VIEW_DIR', plugin_dir_path( __FILE__ ) . 'admin/view/' );
Define('HMUM_ADMIN_IMAGES_URL', plugins_url( 'admin/images/',__FILE__ ) );
Define('HMUM_ADMIN_JS_URL', plugins_url( 'admin/js/',__FILE__ ) );
Define('HMUM_ADMIN_CSS_URL', plugins_url( 'admin/css/',__FILE__ ) );
Define('HMUM_DIR', plugin_dir_path( __FILE__ ) );

//This file include activation, Deactivation and Uninstall hooks functions
require ( HMUM_DIR . 'base_functions.php' );
register_activation_hook( __FILE__, 'hmum_active_function');
register_deactivation_hook( __FILE__, 'hmum_deactive_function');

//Initialize settings
global $hmum_settings;


//if Options not set use this options as default option in plugin
$hmum_settings_key = 'hmum_settings';
$hmum_settings_default = array(
	'welcome_text' 				=> 'با سلام. به سایت ما خوش آمدید. امیدوارم لحظات خوبی را در این سایت داشته باشید.',
	'inbox_header_background_color'	=> '#D0D0D0',
	'inbox_header_border_color'		=> '#E8EAE7',
	'inbox_header_text_color'		=> '#000000',
	'inbox_header_content'			=> 'شما در جعبه پیام خود مجموعا {hmum-total} پیام و همچنین تعداد {hmum-unread} پیام خوانده نشده دارید.',
	'activation'				=> 'inactive'
);

if ( ! get_option( $hmum_settings_key, false ) ) {

	add_option( $hmum_settings_key, $hmum_settings_default );

}

//get all options in global variable
$hmum_settings = get_option( $hmum_settings_key );

//This part of code render Admin part of plugin and just include in admin part (Back-End)
if ( is_admin() ) {

	require ( HMUM_ADMIN_DIR . '/admin_functions.php' );

}

add_action('admin_bar_menu', 'hmum_add_admin_menu_bar', 999);
function hmum_add_admin_menu_bar($admin_menu_bar) {

	/**Cehck for has new Unread Message***/
	global $wpdb;

	$table = $wpdb->prefix . 'user_message';

	$current_user_id = get_current_user_id();

	$query = "SELECT COUNT(*) FROM {$table} WHERE to_user = {$current_user_id} AND is_read = 0";

	$number_message = $wpdb->get_var( $query );
	/**End Cehck for has new Unread Message***/

	$hmum_admin_bar_menu_title = $number_message > 0 ? '<span style="color: red">' . $number_message . ' پیام جدید</span>' : 'پیام کاربران';

	$admin_menu_bar->add_menu(array(
			'id' => 'hmum-user-message',
			'title' => $hmum_admin_bar_menu_title,
			'href' => admin_url('admin.php?page=hmum_user_message_inbox'),
		));

}

add_action('user_register', 'hmum_send_welcome_message_to_new_user');
function hmum_send_welcome_message_to_new_user ($user_id) {

	global $hmum_settings;

	require ( HMUM_ADMIN_INC_DIR . 'functions.php' );

	hmum_send_message ( 1, $user_id, 'خوش آمدید', 1, $hmum_settings['welcome_text']);

}