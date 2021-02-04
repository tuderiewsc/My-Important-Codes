<?php
/*
 * Plugin Name: Script And Style
 */

add_action('enqueue_embed_scripts', function( $hook_suffix){
    //global $typenow;
    //wp_die($hook_suffix . ' => ' . $typenow );
    //if ( !($hook_suffix == 'edit.php' && $typenow == 'post'  ) ) return;
    
    //if (!is_search() ) return ;
    
    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'http://code.jquery.com/jquery-2.1.4.js', false, '2.4.1');
    
    wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
    
    wp_enqueue_script(
            'hm-myscript',
            plugin_dir_url(__FILE__) . 'myscript.js',
            array('jquery', 'bootstrap'),
            '1.1',
            false
            );
    
            wp_register_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css');
    
            wp_enqueue_style('mystyle',
                    plugin_dir_url(__FILE__) . 'mystyle.css', array('thickbox', 'bootstrap'), '2.3.3.3', 'all');
    
});