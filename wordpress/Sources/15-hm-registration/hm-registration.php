<?php
/*
Plugin Name: hm-registration
License: GPLv2
*/

//Rgsitstration widget
class HMU_REGISTER_WIDGET extends WP_Widget {

    function __construct() {
        parent::__construct(
                // base ID of the widget
                'hmu_custom_registration',
                // name of the widget
                'فرم ثبت نام',
                // widget options
                array(
            'description' => 'فرمی ثبت نام با تمام اطلاعات'
                )
        );
    }

    function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : 'فرم ثبت نام';
 
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">نام</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
        </p>

        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function widget($args, $instance) {
        $title = isset($instance['title']) ? $instance['title'] : 'فرم ثبت نام';
        extract($args);
        echo $before_widget;
        echo $before_title . $title . $after_title;
        include(plugin_dir_path(__FILE__) . 'view/registeration_form.php');
        echo $after_widget;
    }

}

add_action('widgets_init', function(){
    register_widget('HMU_REGISTER_WIDGET');
});

//proccess registration
add_action('init', function(){
    
    global $hmu_err;
    if (get_option('users_can_register') != '1' )
        return;
    
    $hmu_err = array();
    if (isset($_POST["hmu_user_login"]) && wp_verify_nonce($_POST['hmu_register_nonce'], 'hmu-register-nonce')) {
        
        $user_login = $_POST["hmu_user_login"];
        $user_email = $_POST["hmu_user_email"];
        $user_first = $_POST["hmu_user_first"];
        $user_last = $_POST["hmu_user_last"];
        $user_pass = $_POST["hmu_user_pass"];
        $pass_confirm = $_POST["hmu_user_pass_confirm"];
        
        if (username_exists($user_login)) {
            $hmu_err[] = 'نام کاربری شما موجود است.';
        }
        
        if (!validate_username($user_login)) {
            $hmu_err[] = 'نام کاربری شما صحیح نیست.';
        }
        
        if ($user_login == '') {
            $hmu_err[] = 'لطفا نام کاربری وارد نمایید.';
        }
        
        if (!is_email($user_email)) {
            $hmu_err[] = 'ایمیل شما صحیح نمی باشد.';
        }
        
        if (email_exists($user_email)) {
            $hmu_err[] = 'ایمیل شما قبلا ثبت شده است.';
        }
        
        if ($user_pass == '') {
            $hmu_err[] = 'گذرواژه را وارد کنید.';
        }
        
        if ($user_pass != $pass_confirm) {
            $hmu_err[] = 'گذرواژه ها با هم مطابقت ندارند.';
        }
        
        if (empty($hmu_err)) {
            $new_user_id = wp_insert_user(array(
                'user_login' => $user_login,
                'user_pass' => $user_pass,
                'user_email' => $user_email,
                'first_name' => $user_first,
                'last_name' => $user_last,
                'user_registered' => date('Y-m-d H:i:s'),
                'role' => 'subscriber'
                    )
            );
            
            if ($new_user_id) {
                // send an email to the admin alerting them of the registration
                wp_new_user_notification($new_user_id);

                wp_clear_auth_cookie();
                wp_set_current_user ( $new_user_id );
                wp_set_auth_cookie  ( $new_user_id );

                wp_safe_redirect(home_url() );
                exit();
                
            }
            
        }
        
    }
});