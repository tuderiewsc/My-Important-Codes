<?php

function hmic_software_meta_box( $post, $box){
    $taxonomy = 'software';
    $tax = get_taxonomy($taxonomy);
    $term_ids = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
    $term_id = isset($term_ids[0]) ? $term_ids[0] : 0;
    ?>
<div id="taxonomy-<?php echo $taxonomy;?>">
    <?php if(current_user_can($tax->cap->edit_terms) ):?>
        <?php foreach( get_terms($taxonomy, array('hide_empty' => 0)) as $term ):?>
        <label for="hmic_software_<?php echo $term->slug;?>">
            <img data-term-slug="<?php echo $term->slug;?>" title="<?php echo esc_attr( $term->name );?> | <?php echo esc_attr($term->description);?>" id="hmic_software_<?php echo $term->slug;?>" src="<?php echo hmic_get_term_meta($term->term_id, 'software_icon', true); ?>" class="<?php if( $term->term_id == $term_id ) echo 'selected';?>" width="32" height="32"/>
        </label>
        <?php endforeach;?>
        <input type="hidden" id="hmic_software_select_input" name="tax_input[<?php echo esc_attr($taxonomy);?>]" value="<?php echo esc_attr($term->slug); ?>"/>
    <?php endif;?>
</div>
    <?php
}

///Add fields
add_action('software_add_form_fields', function($taxonomy){
    ?>
    
    <div class="form-field">
        <label for="hmic_software_icon">آیکون نرم افزار</label>
        <p class="description">یک آیکون برای نرم افزار انتخاب کنید.</p>
        <input type="hidden" name="hmic_software_icon" id="hmic_software_icon" value="<?php echo HMCI_NO_ICON_URL;?>">
        <img class="hmic_software_icon_img" width="64" height="64" src="<?php echo HMIC_NO_ICON_URL;?>"/>
        <input type="button" value="انتخاب آیکون" id="hmic_select_software_icon" class="button button-secondary"/>
    </div>
    
    <?php
});

add_action('software_edit_form_fields', function( $term ){
    ?>

    <tr class="form-field">
        <th scope="row"><label for="hmic_software_icon">آیکون</label></th>
        <td>
            <input type="hidden" name="hmic_software_icon" id="hmic_software_icon" value="<?php echo esc_url(hmic_get_term_meta($term->term_id, 'software_icon', true));?>"/>
            <img class="hmic_software_icon_img" width="64" height="64" src="<?php echo esc_url(hmic_get_term_meta($term->term_id, 'software_icon', true));?>"/>
            <input type="button" value="انتخاب آیکون" id="hmic_select_software_icon" class="button button-secondary"/>
        </td>
    </tr>
    
    <?php
});

//save tax
add_action('create_software', 'hmic_save_software');
add_action('edited_software', 'hmic_save_software');

function hmic_save_software( $term_id ){
    if( isset($_POST['hmic_software_icon']) ){
        $icon_url = esc_url_raw($_POST['hmic_software_icon']);
        hmic_update_term_meta($term_id, 'software_icon', $icon_url);
    }
}

//add column
add_filter('manage_edit-software_columns', function( $columns ){
    $columns['software_icon'] = 'آیکون نرم افزار';
    return $columns;
});

//add column data
add_filter('manage_software_custom_column', function( $out, $column_name, $term_id ){
    
    if($column_name == 'software_icon') {
        $icon_url = hmic_get_term_meta($term_id, 'software_icon', true);
        $out = '<img src="'. esc_url($icon_url).'" width="48" height="48"/>';
    }
    return $out;
}, 10, 3);

add_filter('manage_post_posts_columns', function($columns){
    $columns['software_icon'] = 'نرم افزار';
    return $columns;
});

add_filter('manage_post_posts_custom_column', function($column_name, $post_id){
    if( $column_name == 'software_icon' ){
        $term_ids = wp_get_object_terms($post_id, 'software', array('fields' => 'ids'));
        $term_id = isset($term_ids[0]) ? $term_ids[0] : 0;
        if($term_id) {
            $term = get_term($term_id);
            $icon_url = hmic_get_term_meta($term_id, 'software_icon', true);
            echo '<img title="'. $term->name .'|'.$term->description.'" width="32" height="32" src="' . esc_url($icon_url) . '"/>';
        }else{
            echo '<img width="32" height="32" src="' . HMIC_NO_ICON_URL . '"/>';
        }
    }
}, 10, 2);

add_action('admin_enqueue_scripts', function($hook){
    if( $hook == 'edit-tags.php' && $_GET['taxonomy'] == 'software' ){
        wp_enqueue_script('hmic-select-icon', plugin_dir_url(__FILE__) . 'js/select_icon.js', array('jquery', 'media-upload', 'thickbox'));
        wp_enqueue_style('thickbox');
    }
    if( $hook == 'post.php' || $hook == 'post-new.php' ){
        wp_enqueue_style('hmic-select-icon-post', plugin_dir_url(__FILE__) . 'css/select_icon.css');
        wp_enqueue_script('hmic-select-icon-post', plugin_dir_url(__FILE__) . 'js/select_icon.js');
    }
//wp_die($hook);
});

