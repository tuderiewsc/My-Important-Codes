<?php

add_action( 'add_meta_boxes', 'hmpi_add_product_metabox');
function hmpi_add_product_metabox() {
	add_meta_box(
                'hmpi_product_metabox',
                'مشخصات فنی محصول',
                function($post){require(HMPI_ADMIN_VIEW_DIR . 'metabox_product.php');},
                'post',
                'advanced',
                'high'		
            );
}

add_action('admin_print_scripts-post.php', 'hmpi_metabox_add_script');
add_action('admin_print_scripts-post-new.php', 'hmpi_metabox_add_script');
function hmpi_metabox_add_script(){
    wp_enqueue_script('hmpi-metabox', HMPI_ADMIN_JS_URL . '/metabox.js', array('jquery', 'jquery-ui-tabs', 'media-upload', 'thickbox'));
}

add_action( 'admin_print_styles-post.php', 'hmpi_metabox_add_style');
add_action( 'admin_print_styles-post-new.php', 'hmpi_metabox_add_style');
function hmpi_metabox_add_style(){
	wp_enqueue_style( 'hmpi-metabox', HMPI_ADMIN_CSS_URL . '/metabox.css' );
	wp_enqueue_style('jquery-ui-core', 'https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css');
}

add_action('save_post', 'hmpi_metabox_save_data');
add_action('edit_post', 'hmpi_metabox_save_data');

function hmpi_metabox_save_data($post_id){
    if( ! isset( $_POST['hmpi_product_sizes'] ) ) return;

	update_post_meta( $post_id, '_hmpi_product_sizes', sanitize_text_field( $_POST['hmpi_product_sizes'] ) );
	update_post_meta( $post_id, '_hmpi_product_weight', sanitize_text_field( $_POST['hmpi_product_weight'] ) );
	update_post_meta( $post_id, '_hmpi_product_cpu_manufucture', sanitize_text_field( $_POST['hmpi_product_cpu_manufucture'] ) );
	update_post_meta( $post_id, '_hmpi_product_cpu_serie', sanitize_text_field( $_POST['hmpi_product_cpu_serie'] ) );
	update_post_meta( $post_id, '_hmpi_product_cpu_model', sanitize_text_field( $_POST['hmpi_product_cpu_model'] ) );
	update_post_meta( $post_id, '_hmpi_product_frequence', sanitize_text_field( $_POST['hmpi_product_frequence'] ) );
	//update_post_meta( $post_id, '_hmpi_product_cpu_cache', sanitize_text_field( $_POST['hmpi_product_cpu_cache'] ) );
	update_post_meta( $post_id, '_hmpi_product_gpu_manufucture', sanitize_text_field( $_POST['hmpi_product_gpu_manufucture'] ) );
	update_post_meta( $post_id, '_hmpi_product_gpu_model', sanitize_text_field( $_POST['hmpi_product_gpu_model'] ) );
	update_post_meta( $post_id, '_hmpi_product_gpu_specific_memory', sanitize_text_field( $_POST['hmpi_product_gpu_specific_memory'] ) );
	update_post_meta( $post_id, '_hmpi_product_gpu_total_memory', sanitize_text_field( $_POST['hmpi_product_gpu_total_memory'] ) );
	update_post_meta( $post_id, '_hmpi_product_discussion',  $_POST['hmpi_product_discussion'] );

	$images = array();
	foreach($_POST['hmpi_product_gallery_image'] as $image){
		if ( $image != null && $image != '' ) $images[] = $image;
	}

	update_post_meta( $post_id, '_hmpi_product_gallery_image', $images );
}