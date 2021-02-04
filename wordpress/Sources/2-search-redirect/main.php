<?php
/*
* Plugin Name: دایرکت مستقیم جستجو
* Plugin URI: http://ccm.com
* Author: Unco
* Author URI: http://ccm.com
* Version: 1.0.0
* License: GPLv2
* Description: 	لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
*/


add_action('template_redirect', 'openPost');
function openPost()
{
  if (is_search()) {
    global $wp_query;
    if ($wp_query->post_count == 1 && $wp_query->max_num_pages == 1) {
      wp_redirect( get_permalink( $wp_query->posts[0]->ID ) );
      exit;
    }
  }
}