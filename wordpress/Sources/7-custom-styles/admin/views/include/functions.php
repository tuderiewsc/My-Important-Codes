<?php

add_action( 'admin_menu', 'addMenuPage' );
function addMenuPage()
{
  add_menu_page( 'تنظیمات استایل سفارشی', 'استایل سفارشی', 'administrator', 'ccm_customstyle', 'echoFunctionStyle',
  plugins_url( 'images/icon.png', __FILE__ ) , 50 );

  function echoFunctionStyle()
  {
    include ccm_plugin_dir . '/admin/views/style_options.php' ;
  }

  add_submenu_page( 'ccm_customstyle', 'تنظیمات پیشرفته', 'پیشرفته', 'administrator', 'advanced_options',
  'echo_advanced_options' );
  function echo_advanced_options()
  {
    include ccm_plugin_dir . '/admin/views/advenced_style_options.php' ;
  }
}