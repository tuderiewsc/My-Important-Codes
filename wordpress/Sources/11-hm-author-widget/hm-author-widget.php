<?php
/*
 * Plugin Name: ابزارک نویسنده ها
 * Author: حامد مودی
 * Version: 1.0.0
 * Description: این افزونه جهت ازائه اطلاعات مفید درباره نویسندگاه است
 * Licence: GPLv2
 */

defined('ABSPATH') || exit;

define('HMTA_CSS_URL' ,plugins_url('css/', __FILE__));

class HMAW_TopAuthor extends WP_Widget{

    function __construct() {
        parent::__construct(
            'hmaw_author_widget',
            'نویسندگان برتر',
            array(
                'description'   => 'نمایش نویسندگان برتر از نظر تعدا مطلب، سابقه،...',
                'classname'     => 'hmaw_form_class'
            )
        );

        if (is_active_widget(false, false, $this->id_base)) {

            add_action('wp_enqueue_scripts', array(&$this, 'script'));

            add_action('admin_enqueue_scripts', array(&$this, 'upload_sctipt'));

        }

    }

    function upload_sctipt(){
        wp_enqueue_script('hmaw_upload_widget', plugins_url('js/upload.js', __FILE__), array('jquery', 'media-upload', 'thickbox'));
    }

    function script(){
        wp_enqueue_style('hmaw_widget_style', HMTA_CSS_URL . 'style.css');
        wp_enqueue_style('thickbox');
    }

    function form($instance){
        $title = (!isset($instance['title']) || $instance['title'] == '') ? 'نویسندگان با سابقه' : $instance['title'] ;
        $order_by = (!isset($instance['order_by']) || $instance['order_by'] == '') ? 'registered' : $instance['order_by'] ;
        $order = (!isset($instance['order']) || $instance['order'] == '') ? 'asc' : $instance['order'] ;
        $count = (!isset($instance['count']) || $instance['count'] == '') ? 10 : $instance['count'] ;
        $header = (!isset($instance['header']) || $instance['header'] == '') ? '' : $instance['header'] ;

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">نام</label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo esc_attr($title);?>" class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order_by');?>">مرتب سازی بر اساس</label>
            <select id="<?php echo $this->get_field_id('order_by');?>" value="<?php echo esc_attr($order_by);?>" name="<?php echo $this->get_field_name('order_by');?>">
                <option value="registered" <?php selected($order_by, 'registered');?>>تاریخ ثبت نام</option>
                <option value="post_count" <?php selected($order_by, 'post_count');?>>تعداد مطلب</option>
                <option value="display_name" <?php selected($order_by, 'display_name');?>>حروف الفبا</option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('order');?>_asc">صعودی</label>
            <input type="radio" name="<?php echo $this->get_field_name('order');?>" value="asc" id="<?php echo $this->get_field_id('order');?>_asc" <?php checked($order, 'asc');?> />
            <label for="<?php echo $this->get_field_id('order');?>_desc">نزولی</label>
            <input type="radio" name="<?php echo $this->get_field_name('order');?>" value="desc" id="<?php echo $this->get_field_id('order');?>_desc" <?php checked($order, 'desc');?> />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('count');?>">تعداد کاربران برای نمایش:</label>
            <input type="text" value="<?php echo esc_attr($count);?>" id="<?php echo $this->get_field_id('count');?>" name="<?php echo $this->get_field_name('count') ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'header' ); ?>">هدر:</label>
            <input name="<?php echo $this->get_field_name( 'header' ); ?>" id="<?php echo $this->get_field_id( 'header' ); ?>" class="widefat hmaw_image_url" type="text" size="36"  value="<?php echo esc_url( $header ); ?>" />
            <input class="upload_image_button button button-primary" type="button" value="آپلود هدر" />
        </p>
        <div id="hmaw_preview">
            <?php
            if($header != ''){
                echo '<img src="'.$header.'"/>';
            }
            ?>
        </div>
        <?php

    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance[ 'order_by' ] = in_array($new_instance[ 'order_by' ], array('registered', 'post_count', 'display_name')) ? $new_instance[ 'order_by' ] : 'regsitered';
        $instance[ 'order' ] = in_array($new_instance[ 'order' ], array('desc', 'asc')) ? $new_instance[ 'order' ] : 'desc';
        $instance[ 'count' ] = absint( $new_instance[ 'count' ] );
        $instance[ 'header' ] = esc_url_raw( $new_instance[ 'header' ] );
        return $instance;
    }

    function widget($args, $instance) {
        $title = (!isset($instance['title']) || $instance['title'] == '') ? 'نویسندگان با سابقه' : $instance['title'] ;
        $order_by = (!isset($instance['order_by']) || $instance['order_by'] == '') ? 'registered' : $instance['order_by'] ;
        $order = (!isset($instance['order']) || $instance['order'] == '') ? 'desc' : $instance['order'] ;
        $count= (!isset($instance['count']) || $instance['count'] == '') ? 10 : $instance['count'] ;
        $header= (!isset($instance['header']) || $instance['header'] == '') ? '' : $instance['header'] ;
        extract($args);
        echo $before_widget . $before_title . $title . $after_title;

        $users = new WP_User_Query(array(
            'order_by'     => $order_by,
            'order'        => $order,
            'fields'       => array('display_name', 'user_email', 'ID'),
            'number'       => $count
        ));

        if ($header != '') {
            echo '<div style="text-align: center">';
            echo '<img src="'.$header.'"/>';
            echo '</div>';
        }
        foreach( $users->get_results() as $user ){
            echo '<div class="hmaw-author-list">';
            echo '<img src="' . get_avatar_url($user->user_email, 32) . '"/>';
            echo '<a href="'.get_author_posts_url($user->ID).'">'. $user->display_name .'('. count_user_posts($user->ID) .')</a>';
            echo '</div>';
        }
        //echo '</div>';
        echo $after_widget;

    }

}

add_action('widgets_init', function(){
    register_widget('HMAW_TopAuthor');
});

/*
 * Dahsboard
 */

add_action('wp_dashboard_setup', function(){

    //global $wp_meta_boxes;
    //unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);

//    ob_start();
//    echo '<pre style="text-align: left; direction: ltr;">';
//    print_r($wp_meta_boxes);
//    echo '</pre>';
//    wp_die(ob_get_clean());


    if(current_user_can('activate_plugins')){
        wp_add_dashboard_widget(
            'hmaw_dashboard_widget',
            'اخبار ورزشی',
            'hmaw_dashboard_callback',
            'hmaw_dashboard_setting'
        );
    }

});

function hmaw_dashboard_setting(){
    echo 'echooooo';
}

function hmaw_dashboard_callback(){

    $rssUrl = 'http://www.varzesh3.com/rss/foreignFootball';
    $args = array(
        'url'           => $rssUrl,
        'items'         => 5,
        'show_summary'  => true
    );

    if ( false === ( $news = get_transient('hmaw_news') ) ) {
        //if transient does not exists or expired
        ob_start();
        wp_widget_rss_output($args);
        $news = ob_get_clean();

        set_transient(
            'hmaw_news',
            $news,
            10 * MINUTE_IN_SECONDS);

        //wp_die('get new transient');

    }
    //wp_die('old transient');
    echo $news;

    //delete_transient('special_query_results');

}

add_action('wp_footer', function(){
    if( isset($_GET['debug']) && current_user_can('manage_options') ){
        global $wpdb;
        echo '<pre>';
        print_r($wpdb->queries);
        echo '</pre>';
    }
});