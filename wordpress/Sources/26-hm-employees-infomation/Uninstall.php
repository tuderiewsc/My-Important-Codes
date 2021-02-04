<?php

defined('WP_UNINSTALL_PLUGIN') || exit;

global $wpdb;

$hmei_table = $wpdb->prefix . 'employees_information';

$wpdb->query("DROP TABLE IF EXISTS {$hmei_table}");
