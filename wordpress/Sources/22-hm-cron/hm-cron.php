<?php
/*
 * Plugin Name: زمان بندی
 */

register_activation_hook(__FILE__, function(){
    if( !wp_next_scheduled('hm_cron_hook') ) {
        wp_schedule_event(time(), 'ever10sec', 'hm_cron_hook');
    }
});

register_deactivation_hook(__FILE__, function(){
    
    //wp_clear_scheduled_hook('hm_cron_hook');
    $timeStamp = wp_next_scheduled('hm_cron_hook');
    wp_unschedule_event($timeStamp, 'hm_cron_hook');
    
});

add_action('hm_cron_hook', function(){
    sendMessage();
});

add_filter('cron_schedules', function( $schedules ){
    $schedules['ever10sec'] = array(
        'interval'  => 10,
        'display'   => 'هر 10 ثانیه'
    );
    return $schedules;
});

function sendMessage(){
    
    $params = array(
            'api_token'  => "140fbb2e56b076e7b130b48e07637c92",
            'msg'        => date('Y-m-d H:i:s') . ' | ' . date('H:i:s', wp_next_scheduled('hm_cron_hook'))
        );
    
    $args = array(
        body => $params
    );
    
    wp_remote_post('https://tg-notifcaster.rhcloud.com/api/v1/selfMessage', $args);
}

