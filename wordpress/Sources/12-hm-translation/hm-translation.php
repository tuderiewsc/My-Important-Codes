<?php
/*
 * Plugin Name: Translation
 * Plugin URI: http://example.com/plugins/translations
 * Author: HamedMoodi
 * Author URI: http://example.com/author/hamedmoodi
 * Description: this is my translation plugin description in this chapter
 * Version: 1.0.0
 * Text Domain: hm-translation
 * Domain Path: /languages
 */

add_action('plugins_loaded', function(){
    load_plugin_textdomain('hm-translation', false, basename(plugin_dir_path(__FILE__)) . '/languages/');
});

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_script('translation', plugin_dir_url(__FILE__) . 'script.js', array('jquery'));
    wp_localize_script('translation', 'data', array('name'=>__('hamed', 'hm-translation'), 'family' => __('moodi',' hm-translation')));
});

add_action('wp_footer', function(){
    //echo '<div style="position: fixed;top: 20%;left: 20%;z-index: 9999999999999999999; background: #FFF;width: 60%;color: black;height: 60%;box-shadow: 5px 5px 36px;">';
    
    //_e('This is simple text.', 'hm-translation');
    
    //$city = 'تهران';
    //$country = 'ایران';
    //printf(__('I live in %1$s in %2$s', 'hm-translation'),$city, $country);
    
    //$input = '<input type="text" placeholder="' . esc_attr__('Please fill text', 'hm-translation') . '"/>';
    
    //echo $input;
    
   //_ex('post', 'verb', 'hm-translation');
   //echo '<br>';
   //_ex('post', 'none', 'hm-translation');
   
   //echo _nx('One Post', 'More one', 'postcount', 2);
    
    
    
   //echo '</div>';
});