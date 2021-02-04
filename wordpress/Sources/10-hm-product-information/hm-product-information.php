<?php
/*
Plugin Name: اطلاعات محصولات
Author: حامد مودی
License: GPLv2
*/

defined( 'ABSPATH' ) || exit;

//Define dir path
define( 'HMPI_BASE', plugin_dir_path( __FILE__ ));
define( 'HMPI_BASE_VIEW', plugin_dir_path( __FILE__ ) . 'view/');
define( 'HMPI_ADMIN_DIR', plugin_dir_path( __FILE__ ) . 'admin/');
define( 'HMPI_ADMIN_VIEW_DIR', plugin_dir_path( __FILE__ ) . 'admin/view/');

//Define Urls
define( 'HMPI_CSS_URL', plugins_url( 'css/', __FILE__ ));
define( 'HMPI_JS_URL', plugins_url( 'js/', __FILE__ ));
define( 'HMPI_ADMIN_JS_URL', plugins_url( 'admin/js/', __FILE__ ));
define( 'HMPI_ADMIN_CSS_URL', plugins_url( 'admin/css/', __FILE__ ));
define( 'HMPI_ADMIN_IMAGES_URL', plugins_url( 'admin/images/', __FILE__ ));

register_activation_hook( __FILE__, function(){

});

register_deactivation_hook( __FILE__, function(){

});

if ( is_admin() ) {
    
    require( HMPI_ADMIN_DIR . 'metabox.php' );

}

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_script( 'hmpi-products-tab', HMPI_JS_URL . 'product-tab.js' , array('jquery', 'jquery-ui-tabs'), false, true );
    wp_enqueue_script( 'hmpi-products-viewbox', HMPI_JS_URL . 'jquery.viewbox.min.js' , array('jquery'), false, true );
    wp_enqueue_style('hmpi-tab-css', HMPI_CSS_URL . 'product-tab.css');
    wp_enqueue_style( 'hmpi-products-lightbox', HMPI_CSS_URL . 'viewbox.css'  );
});

add_filter('the_content', function($content){
	ob_start();
	include(HMPI_BASE_VIEW . 'public_product_view.php');
	$content.=ob_get_clean();

	return $content;
}, 1);