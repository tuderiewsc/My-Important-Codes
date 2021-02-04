<?php
/*
 * Plugin Name: اطلاعات کارمندان
 * Author: حامد مودی
 * Description: افزونه ای برای ثبت اطلاعات کارمندان شرکت
 * Version: 1.0.1
 * Licence: GPLv2 or later
 */

register_activation_hook( __FILE__, function(){
    
    global $wpdb;
    
    $table = $wpdb->prefix . 'employees_information'; 
    
    $query = "CREATE TABLE `{$table}` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `fname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
        `lname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
        `mission` int(11) NOT NULL,
        `weight` float NOT NULL,
        `birthday` datetime NOT NULL,
        PRIMARY KEY (`id`)
       ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='this is comment for employees table'";
    
    require_once ( ABSPATH . 'wp-admin/includes/upgrade.php' );
    
    dbDelta($query);
    
});

add_action('admin_menu', function(){
    add_menu_page(
            'اطلاعات کارمندان',
            'اطلاعات کارمندان',
            'manage_options',
            plugin_dir_path(__FILE__) . 'employees_inf.php'
        );
});