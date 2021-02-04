<?php
/*
Plugin Name: hm-book-shop
License: GPLv2
*/

defined('ABSPATH') || exit;

/*
 * Functions
 */
function hmbs_set_404(){
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 );
    exit;
}

register_activation_hook(__FILE__, 'hmbs_activation_function');
register_activation_hook(__FILE__, 'hmbs_deactivation_function');

function hmbs_activation_function(){
    hmbs_add_rules();
    flush_rewrite_rules();
}

function hmbs_deactivation_function(){
    flush_rewrite_rules();
}

add_action('init', 'hmbs_add_rules');
function hmbs_add_rules(){
    add_rewrite_rule(
            'book/search/([^/]+)/?$',
            'index.php?pagename=book_search&s=$matches[1]',
            'top'
        );
    
    add_rewrite_rule(
            'book/([0-9]{1,}+)/?$',
            'index.php?pagename=book_detail&book_id=$matches[1]',
            'top'
        );
}

add_action('template_redirect', function(){
    $pageName = get_query_var('pagename');
    
    if ( $pageName == 'book_search' ) {
        $search = get_query_var('s');
        include(plugin_dir_path(__FILE__) . 'view/books.php');
        exit;
    }else if ( $pageName == 'book_detail') {
        $book_id = get_query_var('book_id');
        include(plugin_dir_path(__FILE__) . 'view/book.php');
        exit;
    }
    
});

add_filter('query_vars', function($vars){
    $vars[] = 'book_id';
    return $vars;
});
