<?php
/*
 * Plugin Name: صفحه ورود سفارشی
 * Author: حامد مودی
 * Text Domain: hm-custom-login
 * Domain Path: /languages
 * Version: 1.0.0
 * Description: A plugin for customize login page
 */

defined('ABSPATH') || exit;

add_action('admin_menu', function(){
    add_theme_page(
        'صفحه ورود',
        'صفحه ورود',
        'manage_options',
        'hmcl_settings_page',
        function(){require(plugin_dir_path(__FILE__) . 'view/settings.php');}
    );
});

add_action('admin_init', function(){

    add_settings_section(
        'hmcl_settings_section_text',
        'تنظیمات صفحه ورود سفارشی',
        'hmcl_custom_section_text_callback',
        'hmcl_settings_text'
    );

    add_settings_section(
        'hmcl_settings_section_image',
        'تنظیمات صفحه ورود سفارشی',
        'hmcl_custom_section_image_callback',
        'hmcl_settings_image'
    );

    add_settings_section(
        'hmcl_settings_section_color',
        'تنظیمات صفحه ورود سفارشی',
        'hmcl_custom_section_color_callback',
        'hmcl_settings_color'
    );

    add_settings_field(
        'hmcl_custom_url',
        'آدرس اینترنتی سفارشی',
        'hmcl_custom_url_callback',
        'hmcl_settings_text',
        'hmcl_settings_section_text',
        array(
            'با کلیک روی لوگو به این آدرس می رویم'
        )
    );

    add_settings_field(
        'hmcl_custom_title',
        'عنوان سفارشی',
        'hmcl_custom_title_callback',
        'hmcl_settings_text',
        'hmcl_settings_section_text',
        array(
            'با نگه داشتن ماوس روی لوگو این متن ظاهر می شود',
        )
    );

    add_settings_field(
        'hmcl_custom_logo',
        'لوگو',
        'hmcl_custom_logo_callback',
        'hmcl_settings_image',
        'hmcl_settings_section_image',
        array(
            'لوگوی صفحه ورود',
        )
    );

    add_settings_field(
        'hmcl_custom_bg',
        'پس زمینه',
        'hmcl_custom_bg_callback',
        'hmcl_settings_image',
        'hmcl_settings_section_image',
        array(
            'انتخاب پس زمینه برای صفحه ورد',
        )
    );

    add_settings_field(
        'hmcl_custom_text_color',
        'رنگ متن',
        'hmcl_custom_text_color_callback',
        'hmcl_settings_color',
        'hmcl_settings_section_color',
        array(
            'رنگ متن برای فرم',
        )
    );

    add_settings_field(
        'hmcl_custom_form_color',
        'رنگ پس زمینه فرم',
        'hmcl_custom_form_color_callback',
        'hmcl_settings_color',
        'hmcl_settings_section_color',
        array(
            'انتخاب رنگ پس زمینه فرم ورود',
        )
    );

    register_setting(
        'hmcl_settings_text',
        'hmcl_custom_url',
        'esc_url_raw'
    );

    register_setting(
        'hmcl_settings_text',
        'hmcl_custom_title',
        'sanitize_text_field'
    );

    register_setting(
        'hmcl_settings_image',
        'hmcl_custom_logo',
        'esc_url_raw'
    );

    register_setting(
        'hmcl_settings_image',
        'hmcl_custom_bg',
        'esc_url_raw'
    );

    register_setting(
        'hmcl_settings_color',
        'hmcl_custom_text_color'
    );

    register_setting(
        'hmcl_settings_color',
        'hmcl_custom_form_color'
    );

});

function hmcl_custom_section_text_callback(){
    echo '<p>شما میتوانی از اینجا صفحه ورود خود را سفارشی کنید</p>';
}

function hmcl_custom_section_image_callback(){
    echo '<p>شما میتوانی از اینجا صفحه ورود خود را سفارشی کنید</p>';
}

function hmcl_custom_section_color_callback(){
    echo '<p>شما میتوانی از اینجا صفحه ورود خود را سفارشی کنید</p>';
}

function hmcl_custom_url_callback($args){
    echo '<input type="text" class="ltr regular-text" name="hmcl_custom_url" id="hmcl_custom_url" value="' . get_option('hmcl_custom_url', home_url()) .'"/>';
    echo '<p class="description">'. $args[0] .'</p>';
}

function hmcl_custom_title_callback($args){
    echo '<input class="regular-text" type="text" name="hmcl_custom_title" id="hmcl_custom_title" value="' . get_option('hmcl_custom_title', '') . '"/>';
    echo '<p class="description">' . $args[0] . '</p>';
}

function hmcl_custom_logo_callback($args){
    echo '<input class="regular-text ltr" type="text" name="hmcl_custom_logo" id="hmcl_custom_logo" value="' . get_option('hmcl_custom_logo', '') . '"/>';
    echo '<input class="button-secondary" type="button" id="hmcl_upload_logo" value="Upload"/>';
    echo '<p class="description">' . $args[0] . '</p>';
}

function hmcl_custom_bg_callback($args){
    echo '<input class="regular-text ltr" type="text" name="hmcl_custom_bg" id="hmcl_custom_bg" value="' . get_option('hmcl_custom_bg', '') . '"/>';
    echo '<input class="button-secondary" type="button" id="hmcl_upload_bg" value="Upload"/>';
    echo '<p class="description">' . $args[0] . '</p>';
}

function hmcl_custom_text_color_callback($args){
    echo '<input type="text" name="hmcl_custom_text_color" id="hmcl_custom_text_color" data-default-color="#000000"  value="' . get_option('hmcl_custom_text_color', '') . '"/>';
    echo '<p class="description">' . $args[0] . '</p>';
}

function hmcl_custom_form_color_callback($args){
    echo '<input type="text" name="hmcl_custom_form_color" id="hmcl_custom_form_color" data-default-color="#FFFFFF"  value="' . get_option('hmcl_custom_form_color', '') . '"/>';
    echo '<p class="description">' . $args[0] . '</p>';
}

add_action('admin_enqueue_scripts', function(){
    global $pagenow;
    if( $pagenow == 'themes.php' && ( isset($_GET['page']) && $_GET['page'] == 'hmcl_settings_page' )) {
        wp_enqueue_script('hmcl-upload', plugins_url('js/upload.js', __FILE__), array('jquery','media-upload', 'thickbox','wp-color-picker'));
        wp_enqueue_style('thickbox');
        wp_enqueue_style('wp-color-picker');
    }
});

/*
 *
 */
add_filter('login_headerurl', function(){
    return get_option('hmcl_custom_url', home_url());
});

add_action('login_enqueue_scripts', function(){
    ?>
    <style type="text/css">
        .login h1 a{
            background-image: url(<?php echo get_option('hmcl_custom_logo', admin_url('images/wordpress-logo.svg?ver=20131107'));?>);
        }
        body{
            background: url(<?php echo get_option( 'hmcl_custom_bg', '');?>) no-repeat center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        a,
        label{
            color: <?php echo get_option('hmcl_custom_text_color', '#000000');?> !important;
        }
        .login form{
            background:<?php echo hex2rgba(get_option('hmcl_custom_form_color', '#FFFFFF'), .5);?>
        }
    </style>
    <?php
});

/*
 * Functions
 */
function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
      return $default;

	//Sanitize $color if "#" is provided
  if ($color[0] == '#' ) {
   $color = substr( $color, 1 );
}

        //Check if color has 6 or 3 characters and get values
if (strlen($color) == 6) {
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
} elseif ( strlen( $color ) == 3 ) {
    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
} else {
    return $default;
}

        //Convert hexadec to rgb
$rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
if($opacity){
   if(abs($opacity) > 1)
      $opacity = 1.0;
  $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
} else {
   $output = 'rgb('.implode(",",$rgb).')';
}

        //Return rgb(a) color string
return $output;
}
