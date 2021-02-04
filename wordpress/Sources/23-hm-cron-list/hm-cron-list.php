<?php
/*
 * Plugin Name: لیست برنامه های اجرایی
 */

defined('ABSPATH') || exit;

add_action('admin_menu', function(){
    add_options_page(
            'لیست وظایف',
            'لیست وظایف',
            'administrator',
            'hmcl_cron_list',
            function(){include(plugin_dir_path(__FILE__) . 'view/cron_list.php');}
        );
});


