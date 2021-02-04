<?php
/*
Plugin Name: hm-rewrite
Version: 1.0.0
License: GPLv2
*/

add_action('template_redirect', function(){
//    global $wp_rewrite, $wp_query;
//    print_r( $wp_rewrite );
//    print_r( $wp_query );
//    
//    exit;
});

register_activation_hook(__FILE__, function(){
    hmr_add_rules();
    flush_rewrite_rules();
});

register_deactivation_hook(__FILE__, function(){
    flush_rewrite_rules();
});

add_action('init', 'hmr_add_rules');
function hmr_add_rules(){
    //add_rewrite_rule('writer/([^/]+)/?$', 'index.php?author_name=$matches[1]', 'top');
    //add_rewrite_rule('writer/([^/]+)/page/?([0-9]{1,})/?$', 'index.php?author_name=$matches[1]&paged=$matches[2]', 'top');
    
    add_rewrite_tag('%writer%', '([^/]+)');
    add_permastruct('writer', 'writer/%writer%');
    
    add_rewrite_endpoint('json',EP_PERMALINK + EP_AUTHORS );
    
    add_rewrite_tag('%premium%', '([^/]+)');
    
}

add_action('template_redirect', function(){
    
    //wp_die(get_query_var('my_writer')  . ' | page = ' . get_query_var('paged')  );
//    global $wp_rewrite;
//    wp_send_json( $wp_rewrite );
    
    //wp_die() );
    
    global $wp_query;
    
    if(!isset($wp_query->query['json'])) return;
    
    wp_send_json($wp_query->post);
    
});

add_filter('post_link', function($permalink, $post){
    
    if ( false === strpos($permalink, '%premium%') ) {
        return $permalink;
    }
    
    $premium = get_post_meta($post->ID, 'premium', true);
    
    $premium = empty($premium) ? 'free' : $premium;
    
    $premium = urldecode($premium);
    
    $permalink = str_replace('%premium%', $premium, $permalink);
    
    return $permalink;
    
}, 10, 2);

