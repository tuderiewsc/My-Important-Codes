<?php
/*
 * Plugin Name: چند سایتی
 */

add_action('wp_head', function(){
    if( !is_multisite() ) return;
    echo PHP_EOL . PHP_EOL;
//    $newBlog = wpmu_create_blog('localhost', '/ali', 'علی', 9);
//    if( $newBlog ){
//        echo 'new blog id is ' . $newBlog . PHP_EOL;
//        print_r(get_blog_details($newBlog) );
//    }else{
//        echo 'error in creating blog';
//    }
    
    //update_blog_status( 8, 'deleted', 0);
    //update_blog_option(3, 'bloginfo', 'this is blog 3 info');
    //echo get_blog_option(3, 'bloginfo', 'noInfo');
    
    //add_user_to_blog(3, 9, 'author');
    
    //print_r(get_blogs_of_user(9));
    //require ABSPATH . '/wp-admin/includes/ms.php';
    //grant_super_admin(16);
    //print_r(get_super_admins());
    //echo is_super_admin(16) ? 'Ok' : 'No';
    echo PHP_EOL . PHP_EOL;
    
});
