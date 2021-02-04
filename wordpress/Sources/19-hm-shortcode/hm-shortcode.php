<?php
/*
 * Plugin Name: کد کوتاه
 */

add_action('init', function(){
    add_shortcode('recent-posts', 'hmsh_recent_post');
    add_shortcode('r', 'hmsh_red');
    add_shortcode('user', 'hmsh_just_user');
});

function hmsh_just_user($attrs, $content = null) {
    if (is_user_logged_in() ){
        return $content;
    }else {
        return 'You Mus Login <a href="' . wp_login_url(get_the_permalink()) . '">Login</a>';
    }
}

function hmsh_red($attrs, $content){
    return '<span style="color:red">' . $content . '</span>';
}

//[user]This is user content[/user]
//[recent-posts] count=8 show_date=false][r]RecentPost[/r][/recent-posts]
//[video count=8 show_date=false]http://example.com/video.mp4[/video]

function hmsh_recent_post($attr, $content = null){

    $content = $content == null ? 'Recent Post' : $content;

    extract(shortcode_atts( array(
        'count'     => 5,
        'show_date' => true
    ), $attr));

    ob_start();
    echo '<h3>' . $content . '</h3>';
    echo '<ul>';
    $the_query = new WP_Query('posts_per_page=' . $count);
    if ( $the_query->have_posts() ) {
        while( $the_query->have_posts() ) {
            $the_query->the_post();

            echo '<li><a href="'. get_the_permalink() .'">';
            echo get_the_title();
            if( $show_date == 'true') {
                echo '(' . get_the_date('d F Y') . ')';
            }
            echo '</a></li>';

        }
    }
    echo '</ul>';
    wp_reset_query();
    return do_shortcode(ob_get_clean());
}

add_action('admin_menu', function(){
    add_menu_page('Test ShortCode', 'Test ShortCode', 'administrator', 'test_shortcode', 'test_shortcode_func');
});

function test_shortcode_func(){
    echo do_shortcode('[r]Test Text[/r]');
}

////////////////////////////////////////////////////////


add_action('admin_head', function(){

    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }


    if( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter('mce_buttons_3', 'hmsh_add_new_button');
        add_filter('mce_external_plugins', 'hmsh_add_new_button_plugin');
    }


    echo '<style type="text/css">';
    echo 'i.mce-i-hmsh_recent_post{background: url('. plugin_dir_url(__FILE__) . 'js/small_icon.png' .') no-repeat center}';
    echo '</style>';

});

function hmsh_add_new_button($buttons){
    array_unshift($buttons, 'hmsh_recent_post');
    return $buttons;
}

function hmsh_add_new_button_plugin($plugins_array){
    $plugins_array['hmsh_recent_post'] = plugin_dir_url(__FILE__) . 'js/my_button.js';
    return $plugins_array;
}
////////////////////////////////////////////////////////////////
add_filter('mce_external_plugins', function($plugins){
    $plugins['hmsh_advanced_plugin'] = plugin_dir_url(__FILE__) . 'js/advanced_plugin.js';
    return $plugins;
});

add_filter('mce_buttons_3', function($buttons){
    array_unshift($buttons, 'hmsh_advanced_plugin');
    return $buttons;
});


