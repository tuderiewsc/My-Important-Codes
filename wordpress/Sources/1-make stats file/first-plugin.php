<?php
/*
* Plugin Name: firstPlugin
* Plugin URI: http://ccm.com
* Author: Unco
* Author URI: http://ccm.com
* Version: 1.0.0
* License: GPLv2
* Text Domain: my-plugin
* Domain Path: /lang
* License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
* Description: 	لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.

*/
defined('ABSPATH') || exit;

define('my_plugin_dir', plugin_dir_path(__FILE__));

register_activation_hook(__FILE__, function () {
	register_uninstall_hook(__FILE__, 'my_plugin_uninstall');

	date_default_timezone_set('Asia/Tehran');
	$file = fopen(my_plugin_dir . 'stats.txt', 'a');
	fwrite($file, date('Y,M,d H:i:s') . '  ' . 'plugin activated...' . PHP_EOL);
	fclose($file);

	add_option('my_plugin_author_name', 'unco');
	add_option('my_plugin_author_email', 'unco@yahoo.com');
});

register_deactivation_hook(__FILE__, function () {
	date_default_timezone_set('Asia/Tehran');
	$file = fopen(my_plugin_dir . 'stats.txt', 'a');
	fwrite($file, date('Y,M,d H:i:s') . '  ' . 'plugin deactivated...' . PHP_EOL);
	fclose($file);   
    
    
	delete_option('my_plugin_author_name');
    
    
});


function my_plugin_uninstall()
{
	delete_option('my_plugin_author_email');
}


add_action('comment_form', 'extraComment');
function extraComment($post_id)
{
	echo 'this is a comment with id= ' . $post_id;
}

add_action('wp_head', 'testfunc', 999);
function testfunc()
{
	echo "<style>
.class{
   direction:rtl;
 }
</style>";

}

do_action_ref_array( $tag, $args);