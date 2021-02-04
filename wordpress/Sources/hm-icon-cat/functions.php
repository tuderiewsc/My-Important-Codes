<?php

//update_term_meta($term_id, $meta_key, $meta_value, $prev_value)

function hmic_update_term_meta( $term_id, $meta_key, $meta_value ){
    global $wp_version;
    if(version_compare($wp_version, '4.4', '>=') ) {
        return update_term_meta($term_id, $meta_key, $meta_value);
    }else{
        return update_option("taxonomy_{$term_id}_{$meta_key}", $meta_value);
    }
}

//get_term_meta($term_id, $key, $single)

function hmic_get_term_meta( $term_id, $key, $single ){
    global $wp_version;
    if (version_compare( $wp_version, '4.4', '>=') ) {
        return get_term_meta($term_id, $key, $single);
    }else{
        return get_option("taxonomy_{$term_id}_{$key}", '');
    }
}

//taxonomy_${term_id}_{$meta_key} = {$meta_value};

