<?php

function hmum_active_function () {

	global $wpdb;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $table = $wpdb->prefix . 'user_message';

	$createTableQuery = "CREATE TABLE `{$table}` (
		 `id` int(11) NOT NULL AUTO_INCREMENT,
		 `from_user` int(11) NOT NULL,
		 `to_user` int(11) NOT NULL,
		 `subject` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
		 `message` text COLLATE utf8_unicode_ci NOT NULL,
		 `type` int(1) NOT NULL,
		 `is_read` int(1) NOT NULL DEFAULT '0',
		 `parent_message` int(11) NOT NULL,
		 `sent_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		 PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

	dbDelta($createTableQuery);

}

function hmum_deactive_function () {
	//No operation is here ...
}