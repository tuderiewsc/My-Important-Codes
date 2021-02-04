<?php
/*
  Plugin Name: hm-icon-cat
  License: GPLv2
 */

defined('ABSPATH') || exit;

define( 'HMIC_NO_ICON_URL', plugin_dir_url(__FILE__) . 'no-icon.png' );

add_action('init', 'hmic_register_taxonomy');
function hmic_register_taxonomy(){
    
    $args = array(
        'show_ui' => true,
        'public'  => true,
        'rewrite' => array('slug' => 'mysoft'),
        'labels'  => array(
            'name'              => 'نرم افزار',
            'singular_name'     => 'نرم افزار',
            'search_items'      => 'جستجوی نرم افزار',
            'all_items'         => 'تمام نرم افزار ها',
            'edit_item'         => 'ویرایش نرم افزار',
            'update_item'       => 'بروزرسانی نرم افزار',
            'add_new_item'      => 'افزودن نرم افزار جدید',
            'new_item_name'     => 'نام نرم افزار جدید',
            'menu_name'         => 'نرم افزار',
        ),
        'meta_box_cb'   => 'hmic_software_meta_box'
    );
    
    register_taxonomy('software', array('post', 'book'), $args);
    
}

include(plugin_dir_path(__FILE__) . 'functions.php');

if(is_admin()) {
    require(plugin_dir_path(__FILE__) . 'taxonomy.php');
}

add_filter('the_content', function($content){
    $term_ids = wp_get_object_terms(get_the_ID(), 'software', array('fields' => 'ids'));
    $term_id = isset($term_ids[0]) ? $term_ids[0] : 0;
    if($term_id) {
        $term = get_term($term_id);
        $icon_url = hmic_get_term_meta($term_id, 'software_icon', true);
        return $content . '<hr><img title="'. $term->name .'|'.$term->description.'" width="32" height="32" src="' . esc_url($icon_url) . '"/>';
    }else{
        return $content;
    }
});