<?php
/*
 * Plugin Name: اطلاعات اضافی دوره
 * Author: حامد مودی
 * Description: برای ثبت اطلاعات اضافی به کار می رود
 * Version: 1.0.5
 * Licence: GPLv2 or later
 */

defined('ABSPATH') || exit;

define('HMCI_VIEW', plugin_dir_path(__FILE__) . 'view/');
define('HMCI_ADMIN_DIR', plugin_dir_path(__FILE__) . 'admin/');
define('HMCI_ADMIN_VIEW_DIR', plugin_dir_path(__FILE__) . 'admin/view/');
define('HMCI_ADMIN_JS_URL', plugins_url('admin/js/', __FILE__));
define('HMCI_CSS_URL', plugins_url('css/', __FILE__));
define('HMCI_IMAGE_URL', plugins_url('image/', __FILE__));

if ( is_admin() ) {
    require (HMCI_ADMIN_DIR . 'metabox.php');
}

add_filter('the_content', 'hmci_echo_course');
add_filter('the_excerpt', 'hmci_echo_course');

function hmci_echo_course( $content ){
    
    ob_start();
    require(HMCI_VIEW . 'course_information.php');
    $endResult = ob_get_clean();
    //$content =  . $content;
    
    return $endResult . $content;
}

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style('hmci-course-information', HMCI_CSS_URL . 'style.css');
});
