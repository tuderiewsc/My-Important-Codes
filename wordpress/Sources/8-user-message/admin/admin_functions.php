<?php

add_action( 'admin_menu', 'hmum_create_admin_menus');

function hmum_create_admin_menus () {

	global $hmum_settings;

	if ( $hmum_settings['activation'] == 'inactive' && ! current_user_can( 'administrator' ) ) {
		return;
	}

	/**Check for has new Unread Message***/
	global $wpdb;

	$table = $wpdb->prefix . 'user_message';

	$current_user_id = get_current_user_id();

	$query = "SELECT COUNT(*) FROM {$table} WHERE to_user = {$current_user_id} AND is_read = 0";

	$number_message = $wpdb->get_var( $query );
	/**End Cehck for has new Unread Message***/

	$hmum_main_menu_title = $number_message > 0 ? 'پیام کاربران <span class="awaiting-mod count-' . $number_message . '"><span class="pending-count">' . $number_message . '</span></span>' : 'پیام کاربران';

	$hmum_inbox_page_hook = add_menu_page (
			'پیام کاربران',//Page <title>{$title}</title>
			$hmum_main_menu_title,//Page Menu title
			'read',//capability; this is capability for any user or subscriber
			'hmum_user_message_inbox',//This is menu slug
			function(){ include ( HMUM_ADMIN_VIEW_DIR . 'inbox.php' ); },//This view render inbox page in admin
			HMUM_ADMIN_IMAGES_URL . 'email_icon.png',//Menu icon by 16px x 16px
			'18.69'
		);


	$hmum_sent_page_hook = add_submenu_page (
			'hmum_user_message_inbox',//Page <title>{$title}</title>
			'پیام های ارسال شده',//Page Menu title
			'پیام های ارسال شده',//capability; this is capability for any user or subscriber
			'read',//This is menu slug
			'hmum_user_message_sent',
			function(){ include ( HMUM_ADMIN_VIEW_DIR . 'inbox.php' ); }//This view render inbox page in admin
		);

	$hmum_new_page_hook = add_submenu_page (
			'hmum_user_message_inbox',//Page <title>{$title}</title>
			'پیام جدید',//Page Menu title
			'پیام جدید',//capability; this is capability for any user or subscriber
			'read',//This is menu slug
			'hmum_user_message_new',
			function(){ include ( HMUM_ADMIN_VIEW_DIR . 'new.php' ); }//This view render inbox page in admin
		);

	$hmum_setting_page_hook = add_submenu_page (
                    'hmum_user_message_inbox',//Page <title>{$title}</title>
                    'تنظیمات',//Page Menu title
                    'تنظیمات',//capability; this is capability for any user or subscriber
                    'read',//This is menu slug
                    'hmum_user_message_setting',
                    function(){ include ( HMUM_ADMIN_VIEW_DIR . 'setting.php' ); }//This view render inbox page in admin
                  );

	add_action("load-{$hmum_new_page_hook}", 'hmum_new_page_styles');
	add_action("load-{$hmum_sent_page_hook}", 'hmum_new_page_styles');
	add_action("load-{$hmum_inbox_page_hook}", 'hmum_new_page_styles');
	add_action("load-{$hmum_setting_page_hook}", 'hmum_new_page_styles');

}

function hmum_new_page_styles() {

	add_action ('admin_enqueue_scripts', function(){

		wp_enqueue_style ( 'admin-new-message', HMUM_ADMIN_CSS_URL . 'new.css' );

		//Enqueue Color Picker
		 // Add the color picker css file
		wp_enqueue_style( 'wp-color-picker' );

        // Include our custom jQuery file with WordPress Color Picker dependency
		wp_enqueue_script( 'color-picker-script',HMUM_ADMIN_JS_URL . 'color-picker-script.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-core', 'jquery-ui-slider' ), false, true );


        //Using jquery-ui slider
        //wp_enqueue_script('jquery');
		//wp_enqueue_script('jquery-ui-core');
		//wp_enqueue_script('jquery-ui-slider');

		//wp_register_style('my_jq_ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery.ui.all.css', __FILE__, false);

		//wp_enqueue_style('my_jq_ui');

	});

	add_action ('admin_print_styles', function(){

		$mainBackground = HMUM_ADMIN_IMAGES_URL . 'communication.png';
		echo "
		<style type='text/css'>
		.wrap.hmum_new {
			background: url({$mainBackground}) no-repeat left bottom;
		}
		</style>
		";

	});

}



add_action('hmum_before_sendmessage_form', function(){

	echo <<<HTMLHELP
	<p>
	مدیر سایت : admin|
	نویسنده ارشد: editor | مدیر سایت : admin |
	نویسنده ارشد: editor | مدیر سایت : admin |
	نویسنده ارشد: editor | مدیر سایت : admin |
	نویسنده ارشد: editor | مدیر سایت : admin |
	نویسنده ارشد: editor | مدیر سایت : admin |
	نویسنده ارشد: editor
	</p>
	HTMLHELP;

});