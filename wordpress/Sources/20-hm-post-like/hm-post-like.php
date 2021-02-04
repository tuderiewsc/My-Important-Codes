<?php
/*
 * Plugin Name: پست لایک
 */

defined('ABSPATH') || exit;

define('HMPL_JS_URL', plugin_dir_url(__FILE__) . 'js/');
define('HMPL_CSS_URL', plugin_dir_url(__FILE__) . 'css/');
define('HMPL_IMAGES_URL', plugin_dir_url(__FILE__) . 'images/');

add_filter('the_content', function($content){
    
    if (!is_single()) return $content;
    
    $post_like = '<div id="hmpl_like" data-post-id="' . get_the_ID() . '">';
    $post_like.= '<span>0</span><img src="'.HMPL_IMAGES_URL.'love.png"/>';
    $post_like.= '</div>';
    return $post_like . $content;
    
});

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style('post-like', HMPL_CSS_URL . 'post-like.css');
    wp_enqueue_script('post-like', HMPL_JS_URL . 'post-like.js', array('jquery'));
    wp_localize_script('post-like', 'post_like_data', array(
        'ajax_url'  => admin_url('admin-ajax.php'),
        '_wpnonce'  => wp_create_nonce('post-like')
    ));
});

add_action('wp_ajax_hmpl_post_liked', 'hmpl_save_like');
add_action('wp_ajax_nopriv_hmpl_post_liked', 'hmpl_save_like');

function hmpl_save_like(){
    header('Content-Type: application/json');
    $nonce = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( $_POST['_wpnonce'] ) : 0;
    if ( !wp_verify_nonce( $nonce, 'post-like' ) ) {
        echo json_encode(array('result' => 'error', 'data' => 'Nonce in incorrect'));    
        exit;
    }
    $post_id = absint($_POST['post_id']);
    $post_like = get_post_meta( $post_id, 'hmpl_post_like', true);
    if( $post_like == '' ) $post_like = 0;
    $post_like++;
    update_post_meta($post_id, 'hmpl_post_like', $post_like);
    echo json_encode(array('result' => 'ok', 'data' => $post_like));
    exit;
}

add_filter('template_include', function($theme){
    wp_die();
    return $theme;
});