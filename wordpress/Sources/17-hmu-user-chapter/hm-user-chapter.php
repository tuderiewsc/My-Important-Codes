<?php

/*
 * Plugin Name: فصل کاربران
 */

register_activation_hook(__FILE__, function(){
add_role(
        'hm_customer',
        'مشتری فروشگاه',
        array('read')
    );

    $role = get_role('administrator');
    
    if ( !empty($role) ) {
        $role->add_cap('hm_buy_product');
    }


});

register_deactivation_hook(__FILE__, function(){
    $users = get_users(array('role' => 'hm_customer', 'number' => 1));
    if( empty($users) ){
        remove_role('hm_customer');
    }
    
    $role = get_role('administrator');
    
    if ( !empty($role) ) {
        $role->remove_cap('hm_buy_product');
    }
});

add_action('wp_footer', function() {
    echo '<div style="overflow: scroll;direction: ltr; text-align: left;position: fixed;top: 20%;left: 20%;z-index: 9999999999999999999; background: #FFF;width: 60%;color: black;height: 60%;box-shadow: 5px 5px 36px;">';
//    if( is_user_logged_in() ){
//        echo 'User';
//    }else{
//        echo 'Guest';
//    }
//    $args = array(
//        'fields'    => array('user_email')
//    );
//    $users = get_users('include=1,2,3&number=2');
//    foreach ($users as $user){
//        echo get_avatar($user->user_email, 96);
//    }
//    echo '<pre>';
//    print_r($users);
//    echo '</pre>';
//    require_once(ABSPATH.'wp-admin/includes/user.php' );
//    if(wp_delete_user(12, 1)){
//        echo 'Success';
//    }
//    $userData = get_userdata(1);
//    if( !empty($userData) ) {
//        echo $userData->user_login;
//    }
    //echo '<pre>';
    //echo update_user_meta(2, 'city', 'Birjand');
    //echo get_user_meta(2, 'city', true);
    //echo delete_user_meta(2, 'city');
    //echo '</pre>';
    
    if(current_user_can('hm_buy_product') ){
        echo "ok";
    }else {
        echo 'no';
    }
    
    
    echo '</div>';
});



add_filter('map_meta_cap', function( $caps, $cap, $user, $args){
    if( $cap == 'edit_post' || $cap == 'delete_post'){
        $post = get_post( $args[0] );
        if(author_can($post, 'manage_options') ){
            $caps[] = 'manage_options';
        }
    }
    return $caps;
}, 10, 4);


