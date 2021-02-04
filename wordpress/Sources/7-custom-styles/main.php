<?php
/*
* Plugin Name: استایل سفارشی
* Plugin URI: http://ccm.com
* Author: Unco
* Author URI: http://ccm.com
* Version: 1.0.0
* License: GPLv2
* Description: 	لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
*/

defined('ABSPATH') || die('Error');
define('ccm_plugin_dir', plugin_dir_path( __FILE__));


add_action( 'admin_menu', 'addMenuPage' );
function addMenuPage()
{
  $hook = add_menu_page( 'تنظیمات استایل سفارشی', 'استایل سفارشی', 'administrator', 'ccm_customstyle', 'echoFunctionStyle',
    plugins_url( 'images/icon.png', __FILE__ ) , '50.25' );
  function echoFunctionStyle()
  {
    include ccm_plugin_dir . '/admin/views/style_options.php' ;
  }
  // add_action('load-'. $hook, 'test_die');
  // function test_die(){
  //   wp_die( 'messagee', 'title' );
  // }


  $hook2 = add_submenu_page( 'ccm_customstyle', 'تنظیمات پیشرفته', 'پیشرفته', 'administrator', 'advanced_options',
    'echo_advanced_options' );
  function echo_advanced_options()
  {
    include ccm_plugin_dir . '/admin/views/advenced_style_options.php' ;
  }
  // add_action('load-'. $hook2, 'test_die2');
  // function test_die2(){
  //   wp_die( 'messagee', 'title' );
  // }

  add_media_page( 'زیر شاخه آپلود' , 'زیر شاخه آپلود', 'administrator', 'under_upload', 'echo_under_upload' );
  function echo_under_upload()
  {
    global $pagenow;
    echo $pagenow;
    print_r($_GET);
  }

  //remove_menu_page( 'edit.php?post_type=page' );
}

add_filter( 'plugin_action_links_'. plugin_basename( __FILE__ ), 'ccm_addLinks' );
function ccm_addLinks($links){
  $links[]='<a href="'.admin_url('admin.php?page=ccm_customstyle').'">تنظیمات</a>';
  return $links;
}

add_action('admin_bar_menu', 'ccm_add_custom_menu', 100);
function ccm_add_custom_menu(){

  global $wp_admin_bar;
  $menuArgs = array(
    //'parent'=> 'top-secondary',
    'parent'=> 'root-default',
    'id'=> 'my_menu',
    'title'=> '<img src="'.plugins_url('images', __FILE__).'/icon.png " width="24" height="24"> تنظیمات استایل',
    'href'=> admin_url('admin.php?page=ccm_customstyle'),
    'meta'=> array(
      'target'=> '_blank'
    )
  );

  $wp_admin_bar->add_menu($menuArgs);
  $wp_admin_bar->add_menu(array(
    'parent'=> 'my_menu',
    'id'=> 'submenu1',
    'title'=> 'زیر منو',
    'href'=> '#',
  ));
}


add_action('wp_head', 'echo_custom_style');
function echo_custom_style(){
  $style = get_option( 'ccm_style_key' );
  echo '<style type="text/css">' .PHP_EOL;
  echo $style ? $style : '';
  echo '</style>' .PHP_EOL;
}
add_action('wp_footer', 'echo_custom_script');
function echo_custom_script(){
  $script = str_replace('\\', '', get_option( 'ccm_script_key' ));
  echo '<script type="text/javascript">' .PHP_EOL;
  echo $script ? $script : '';
  echo '</script>' .PHP_EOL;
}

