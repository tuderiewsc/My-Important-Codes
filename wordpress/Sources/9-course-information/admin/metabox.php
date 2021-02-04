<?php

add_action('add_meta_boxes', 'hmci_add_course_metabox', 10, 2);
function hmci_add_course_metabox($post_type,$post){
    
    add_meta_box(
            'hmci_course_information',
            'اطلاعات دوره',
            function($post){include(HMCI_ADMIN_VIEW_DIR . 'metabox_echo.php');},
            'post',
            'advanced',
            'low'
        );
}

add_action('save_post', 'hmci_course_information_save');
add_action('save_edit', 'hmci_course_information_save');
function hmci_course_information_save( $post_id ){

    if ( !isset( $_POST['hmci_metabox_course_logo'] ) ) return;
    
    update_post_meta($post_id, '_hmci_course_logo', esc_url_raw( $_POST['hmci_metabox_course_logo'] ));
    update_post_meta( $post_id, '_hmci_course_teacher', sanitize_text_field( $_POST['hmci_metabox_teacher'] ) );
    update_post_meta( $post_id, '_hmci_course_teacher', sanitize_text_field( $_POST['hmci_metabox_teacher'] ) );
    update_post_meta( $post_id, '_hmci_course_parts', sanitize_text_field( $_POST['hmci_metabox_part'] ) );
    update_post_meta( $post_id, '_hmci_course_time', sanitize_text_field( $_POST['hmci_metabox_time'] ) );
    update_post_meta( $post_id, '_hmci_course_lang', sanitize_text_field( $_POST['hmci_metabox_lang'] ) );
    update_post_meta( $post_id, '_hmci_course_level', sanitize_text_field( $_POST['hmci_metabox_level'] ) );
    update_post_meta( $post_id, '_hmci_course_free', sanitize_text_field( $_POST['hmci_metabox_free'] ) );
    
}

add_action('admin_enqueue_scripts', function($hook){
    
    //if ( $hook == 'edit.php' || $hook == 'post-new.php' ){
        wp_enqueue_style('thickbox');
    
        wp_enqueue_script('hmci-upload-image', HMCI_ADMIN_JS_URL . 'upload.js', array('jquery','media-upload', 'thickbox'));
        
    //}
});