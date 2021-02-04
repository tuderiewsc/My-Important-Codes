<?php
/*
Plugin Name: hm-post-type
License: GPLv2
*/

add_action('wp_head', function(){
    //echo PHP_EOL . print_r(get_post_types()) . PHP_EOL;
    //global $wp_query;
    //print_r($wp_query);
    //print_r(get_taxonomies());
},9999);

add_action('init', function(){
    
    $args = array(
        'show_ui'   => true,
        'public'    => true,
//        'show_in_nav_menus' => false,
//        'show_in_menu' => false,
        //'description'   => 'digital download ebook file...',
        'labels'    => array(
            'name'              => 'کتاب ها',
            'singular_name'     => 'کتاب',
            'name_admin_bar'    => 'کتاب ج',
            'add_new'           => 'کتاب جدید',
            'not_found'         => 'کتابی یافت نشد',
            'search'            => 'جستجوی کتاب',
            'add_new_item'      => 'افزودن کتاب جدید',
            'featured_image'    => 'کاور کتاب',
            'set_featured_image'=> 'مشخص کردن جلد',
            'remove_featured_image' => 'حذف کاور',
            'use_featured_image'    => 'استفاده از کاور',
            //'view_item'         => 'نمایش کتاب'
            'edit_item' => 'ویرایش کتاب'
            
        ),
        //'show_in_admin_bar' => false,
        'menu_position'     => 5,
//        'exclude_from_search'   => true,
//        'hierarchical'      => true,
        'query_var'     => 'hmbook',
        'taxonomies'    => array(),
        'supports' => array('thumbnail', 'title', 'comments', 'editor', 'page-attributes'),
        'menu_icon' => plugin_dir_url(__FILE__) . 'images/random_message_icon.png',
        'register_meta_box_cb' => 'hm_add_metabox',
        'rewrite' => array(
            'slug' => 'hmebook'
        ),
        //'capability_type' => array( 'book', 'books' )
        
    );
    
    register_post_type('book' ,$args);
    
},999);

function hm_add_metabox($post){
    add_meta_box('test','testmetabox', function($post){
        print_r($post);
    });
    add_meta_box('tesdt','tesdtmetabox', function($post){
        print_r($post);
    });
}

add_action('init', 'hmpt_register_taxonomy');
function hmpt_register_taxonomy(){
    
    $args = array(
        'show_ui'   => true,
        'labels'    => array(
            'name'                       => 'نویسنده ها',
            'singular_name'              => 'نویسنده',
            'search_items'               => __( 'Search Writers' ),
            'popular_items'              => __( 'Popular Writers' ),
            'all_items'                  => __( 'All Writers' ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'ویرایش نویسنده',
            'update_item'                => __( 'Update Writer' ),
            'add_new_item'               => 'افزودن نویسنده جدید',
            'new_item_name'              => __( 'New Writer Name' ),
            'separate_items_with_commas' => __( 'Separate writers with commas' ),
            'add_or_remove_items'        => __( 'Add or remove writers' ),
            'choose_from_most_used'      => 'از نویسنده هایی که بیشتر استفاده شده',
            'not_found'                  => __( 'No writers found.' ),
            'menu_name'                  => 'نویسنده ها',
        ),
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
//        'hierarchical'      => true,
        'meta_box_cb'       => 'hmps_taxonomy_metabox'
    );
    
    register_taxonomy('book_author', array('book'), $args);
    
}

function hmps_taxonomy_metabox( $post, $box ){
    
    //echo '<pre class="ltr left-align">';
    //print_r( $box );
    //echo '</pre>';
    
    $taxonomy = $box['args']['taxonomy'];
    //echo $taxonomy;
    
    $tax = get_taxonomy($taxonomy);
    
    //print_r( $tax );
    
    $selected = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
    $selected_term_id = isset($selected[0]) ? $selected[0] : 0;
    //print_r($selected);
    
   ?>
<div id="taxonomy-<?php echo $taxonomy;?>">
    <?php if(current_user_can($tax->cap->edit_terms) ):?>
    <?php foreach(get_terms($taxonomy, array('hide_empty' => 0)) as $term): ?>
    <p>
        <input type="radio" id="book_author_<?php echo esc_attr($term->slug) ;?>" name="tax_input[<?php echo $taxonomy;?>][]" value="<?php echo esc_attr($term->slug);?>" <?php checked($term->term_id, $selected_term_id); ?>/>
        <label for="book_author_<?php echo $term->slug ;?>"><?php echo $term->name;?></label>
    </p>
    <?php endforeach;?>
    <?php endif;?>
</div>
    <?php
}

add_filter('the_content', function($content){
    global $post_type;
    
    if( $post_type != 'book' )
        return $content;
    
    $content.= get_the_term_list(get_the_ID(), 'book_author', 'before', 'serp00', 'after');
    return $content;
});